<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\PopulationData;
use App\Models\ResidentName;
use App\Models\SubDistrict;
use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;
use App\Exports\PopulationDataExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        $check = Auth::user();
        if (empty($check)) {
            return redirect()->route('login');
        }
        $role = $check->role;
        $districts = District::select('id', 'city_id', 'district_id', 'district_name as name')
            ->whereIn('districts.id', [2975, 2972])
            ->get();
        return view('admin.dashboard', compact('districts', 'role'));
    }

    public function datatable()
    {
        $fetch = PopulationData::get()
            ->toArray();

        $i = 0;
        $reform = array_map(function ($new) use (&$i) {
            $i++;
            return [
                'no' => $i . '.',
                'id' => $new['id'],
                'nik' => $new['nik'],
                'name' => $new['name'],
                'phone_number' => $new['phone_number'],
                'district' => $new['district'],
                'sub_district' => $new['sub_district'],
            ];
        }, $fetch);

        return DataTables::of($reform)->make(true);
    }

    public function getDistrict()
    {
        $districts = District::select('id', 'city_id', 'district_id')
            ->whereIn('districts.id', [2975, 2972])
            ->get();
        return $districts;
    }

    public function getSubDistrict(Request $request)
    {
        try {

            $district_city_id = explode(',', $request->district_city_id);
            $district_id = $district_city_id[0];
            $city_id = $district_city_id[1];
            $subdistrict = SubDistrict::where('district_id', $district_id)
                ->where('city_id', $city_id)
                ->get();
            return $subdistrict;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            if ($request->hasFile('photo_id')) {
                $image = $request->file('photo_id');
                $imageName = 'photo_id/photo_id_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload_images/photo_id'), $imageName);
            } else {
                return response()->json([
                    'status'    => 'failed',
                    'code'      => 400,
                    'message'   => 'Error photo ID!',
                ], 400);
            }

            $district_id = explode(',', $request->district);
            $district = District::where('district_id', $district_id[0])
                ->where('city_id', $district_id['1'])
                ->whereIn('districts.id', [2975, 2972])
                ->select('district_name')
                ->first();

            $subdistrict = SubDistrict::where('id', $request->sub_district)
                ->select('subdistrict_name')
                ->first();

            $store = new PopulationData();
            $store->nik = $request->nik;
            $store->name = $request->name;
            $store->address = $request->address;
            $store->phone_number = $request->phone_number;
            $store->district = $district->district_name;
            $store->sub_district = $subdistrict->subdistrict_name;
            $store->person_responsible = $request->person_responsible;
            $store->information = $request->information;
            $store->photo_id = $imageName;
            $store->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Success Store Data.'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $datas = [];
        $population_data = PopulationData::where('id', $id)
            ->first();
        $district = District::where('district_name', $population_data->district)
            ->whereIn('districts.id', [2975, 2972])
            ->first();
        $sub_district = SubDistrict::where('subdistrict_name', $population_data->sub_district)
            ->where('city_id', $district->city_id)
            ->where('district_id', $district->district_id)
            ->first();
        $datas['population_data'] = $population_data;
        $datas['population_data']['data_district'] = $district;
        $datas['population_data']['data_sub_district'] = $sub_district;
        return response()->json($datas);
    }

    public function update(Request $request, $id)
    {
        $population_data = PopulationData::find($id);
        if (!$population_data) {
            return response()->json([
                'status' => 'failed',
                'code' => 404,
                'message' => 'No Data Found.'
            ], 404);
        }

        if ($request->hasFile('e_photo_id')) {
            $image = $request->file('e_photo_id');
            $image_name = 'photo_id/photo_id_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_images/photo_id'), $image_name);
        } else {
            $image_name = null;
        }
        $district_id = explode(',', $request->e_district);
        $district = District::where('district_id', $district_id[0])
            ->where('city_id', $district_id['1'])
            ->whereIn('districts.id', [2975, 2972])
            ->select('district_name')
            ->first();

        $subdistrict = SubDistrict::where('id', $request->e_sub_district)
            ->select('subdistrict_name')
            ->first();
        $population_data->update([
            'nik' => $request->input('e_nik', $population_data->nik),
            'name' => $request->input('e_name', $population_data->name),
            'phone_number' => $request->input('e_phone_number', $population_data->phone_number),
            'address' => $request->input('e_address', $population_data->address),
            'district' => $district->district_name ?? $population_data->district,
            'sub_district' => $subdistrict->subdistrict_name ?? $population_data->sub_district,
            'person_responsible' => $request->input('e_person_responsible', $population_data->person_responsible),
            'information' => $request->input('e_information', $population_data->information),
            'photo_id' => $image_name ?? $population_data->photo_id,
        ]);

        return response()->json([
            'status'    => 'success',
            'code'  => 200,
            'message'   => 'Success Update Population Data'
        ], 200);
    }

    public function exportToExcel()
    {
        return Excel::download(new PopulationDataExport, 'filename.xlsx');
    }

    public function delete($id)
    {
        PopulationData::where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Success delete population data!'
        ]);
    }
}
