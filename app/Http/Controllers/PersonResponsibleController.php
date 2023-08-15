<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\PersonResponsible;
use App\Models\PopulationData;
use App\Models\SubDistrict;
use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;

class PersonResponsibleController extends Controller
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
        return view('admin.person_responsible.index',compact('districts', 'role'));
    }

    public function datatable()
    {
        $fetch = PersonResponsible::get()
            ->toArray();

        $i = 0;
        $reform = array_map(function ($new) use (&$i) {
            $i++;
            return [
                'no' => $i . '.',
                'id' => $new['id'],
                'name' => $new['name'],
                'phone_number' => $new['phone_number'],
                'district' => $new['district'],
                'sub_district' => $new['sub_district'],
                'address' => $new['address'],
            ];
        }, $fetch);

        return DataTables::of($reform)->make(true);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if(!$request->name 
                || !$request->address 
                || !$request->district
                || !$request->sub_district
                ){
                    return response()->json([
                        'status' => 'failed', 
                        'code' => 422, 
                        'message' => 'Please Check Your Request!'
                    ], 422);
            }
            $check_nik = PersonResponsible::where('name', $request->name)
                ->first();
            if($check_nik){
                return response()->json([
                    'status' => 'failed', 
                    'code' => 400, 
                    'message' => 'Duplicate Data Name!'
                ], 400);
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

            $store = new PersonResponsible();
            $store->name = $request->name;
            $store->address = $request->address;
            $store->phone_number = $request->phone_number ?? "-";
            $store->district = $district->district_name;
            $store->sub_district = $subdistrict->subdistrict_name;
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
        $population_data = PersonResponsible::where('id', $id)
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

        $population_data = PersonResponsible::find($id);
        if (!$population_data) {
            return response()->json([
                'status' => 'failed',
                'code' => 404,
                'message' => 'No Data Found.'
            ], 404);
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
            'name' => $request->input('e_name', $population_data->name),
            'phone_number' => $request->input('e_phone_number', $population_data->phone_number),
            'address' => $request->input('e_address', $population_data->address),
            'district' => $district->district_name ?? $population_data->district,
            'sub_district' => $subdistrict->subdistrict_name ?? $population_data->sub_district,
        ]);

        return response()->json([
            'status'    => 'success',
            'code'  => 200,
            'message'   => 'Success Update Person Responsible Data'
        ], 200);
    }

    public function delete($id)
    {
        $check = PersonResponsible::find($id);
        if(!$check){
            return response()->json([
                'status' => 'failed',
                'code' => 404,
                'message' => 'No Data Found.'
            ], 404);
        }

        $check_population_data = PopulationData::where('person_responsible_id', $check->id)
            ->first();
        if($check_population_data){
            return response()->json([
                'status' => 'failed',
                'code' => 400,
                'message' => 'Can`t Delet Data.'
            ], 400);
        }
        PersonResponsible::where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Success delete population data!'
        ]);
    }
}
