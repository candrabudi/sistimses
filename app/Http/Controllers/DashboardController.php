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
use App\Models\PersonResponsible;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
class DashboardController extends Controller
{
    public function index()
    {
        $check = Auth::user();
        if (empty($check)) {
            return redirect()->route('login');
        }
        $role = $check->role;
        $districts = District::select('id', 'province_id', 'city_id', 'district_id', 'district_name as name')
            ->where('city_id', 17)
            ->where('province_id', 33)
            ->get();
        $person_responsible = PersonResponsible::all();
        $chart_data = PopulationData::select(DB::raw("SUM(CASE WHEN gender = 'Laki-laki' THEN 1 ELSE 0 END) AS man,
        SUM(CASE WHEN gender != 'Laki-laki' THEN 1 ELSE 0 END) AS woman"))
            ->get()
            ->toArray();
        return view('admin.dashboard', compact('districts', 'role', 'chart_data', 'person_responsible'));
    }

    public function datatable()
    {
        $fetch = PopulationData::join('person_responsibles as pd', 'pd.id', '=', 'population_data.person_responsible_id')
            ->select('population_data.*', 'pd.name as person_responsible')
            ->get()
            ->toArray();

        $i = 0;
        $reform = array_map(function ($new) use (&$i) {
            $i++;
            return [
                'no' => $i . '.',
                'id' => $new['id'],
                'nik' => $new['nik'],
                'name' => $new['name'],
                'gender' => $new['gender'],
                'phone_number' => $new['phone_number'],
                'district' => $new['district'],
                'sub_district' => $new['sub_district'],
                'address' => $new['address'],
                'person_responsible' => $new['person_responsible'],
                'information' => $new['information'],
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
            $province_id = $district_city_id[0];
            $district_id = $district_city_id[1];
            $city_id = $district_city_id[2];
            $subdistrict = SubDistrict::where('district_id', $district_id)
                ->where('city_id', $city_id)
                ->where('province_id', $province_id)
                ->get();
            return $subdistrict;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        if($request->photo_id != "undefined"){
            $validator = Validator::make($request->all(), [
                'photo_id' => 'image|mimes:jpeg,png,jpg|max:1024',
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'code' => 1001,
                    'message' => 'Please check your image upload.'
                ], 422);
            }
        }
        try {
            if(!$request->nik 
                || !$request->name 
                || !$request->address 
                || !$request->phone_number 
                || !$request->district
                || !$request->sub_district
                || !$request->person_responsible
                || !$request->information
                || !$request->gender){
                    return response()->json([
                        'status' => 'failed', 
                        'code' => 422, 
                        'message' => 'Please Check Your Request!'
                    ], 422);
            }
            $check_nik = PopulationData::join('person_responsibles as pd', 'pd.id', '=', 'population_data.person_responsible_id')
                ->select('population_data.*', 'pd.name as person_responsible')
                ->where('nik', $request->nik)
                ->first();
            if($check_nik){
                return response()->json([
                    'status' => 'failed', 
                    'code' => 400, 
                    'message' => 'Maaf NIK sudah diinput oleh '.$check_nik->person_responsible
                ], 400);
            }
            if ($request->hasFile('photo_id')) {
                $image = $request->file('photo_id');
                $imageName = 'photo_id/photo_id_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload_images/photo_id'), $imageName);
            }

            $district_id = explode(',', $request->district);
            $district = District::where('district_id', $district_id[1])
                ->where('city_id', $district_id['2'])
                ->where('province_id', $district_id[0])
                ->select('district_name')
                ->first();

            $subdistrict = SubDistrict::where('id', $request->sub_district)
                ->select('subdistrict_name')
                ->first();
            $store = new PopulationData();
            $store->nik = $request->nik;
            $store->name = $request->name;
            $store->gender = $request->gender;
            $store->address = $request->address;
            $store->phone_number = $request->phone_number;
            $store->district = $district->district_name;
            $store->sub_district = $subdistrict->subdistrict_name;
            $store->person_responsible_id = $request->person_responsible;
            $store->information = $request->information;
            $store->photo_id = $imageName ?? '';
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
        $population_data = PopulationData::join('person_responsibles as pd', 'pd.id', '=', 'population_data.person_responsible_id')
            ->select('population_data.*', 'pd.name as person_responsible')
            ->where('population_data.id', $id)
            ->first();
        $district = District::where('district_name', $population_data->district)
            ->where('city_id', 17)
            ->where('province_id', 33)
            ->first();
        $sub_district = SubDistrict::where('subdistrict_name', $population_data->sub_district)
            ->where('city_id', $district->city_id)
            ->where('district_id', $district->district_id)
            ->where('province_id', $district->province_id)
            ->first();
        $datas['population_data'] = $population_data;
        $datas['population_data']['data_district'] = $district;
        $datas['population_data']['data_sub_district'] = $sub_district;
        return response()->json($datas);
    }

    public function update(Request $request, $id)
    {
        if($request->e_photo_id != "undefined"){
            $validator = Validator::make($request->all(), [
                'e_photo_id' => 'image|mimes:jpeg,png,jpg|max:1024',
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'code' => 1001,
                    'message' => 'Please check your image upload.'
                ], 422);
            }
        }

        $population_data = PopulationData::find($id);
        if (!$population_data) {
            return response()->json([
                'status' => 'failed',
                'code' => 404,
                'message' => 'No Data Found.'
            ], 404);
        }

        $check_nik = PopulationData::join('person_responsibles as pd', 'pd.id', '=', 'population_data.person_responsible_id')
                ->select('population_data.*', 'pd.name as person_responsible')
                ->where('nik', $request->e_nik)
                ->first();
        if($check_nik){
            if($check_nik->id != $id){
                return response()->json([
                    'status' => 'failed', 
                    'code' => 400, 
                    'message' => 'Maaf NIK sudah diinput oleh '.$check_nik->person_responsible
                ], 400);
            }
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
            'person_responsible_id' => $request->input('e_person_responsible', $population_data->person_responsible_id),
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
