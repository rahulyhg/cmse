<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\DataTables\WardsDT;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Ward;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class WardController extends Controller
{
    public function index(WardsDT $dataTable){
        $hospital_id = Input::get('hospital_id');
        $dataTable->setHospitalId($hospital_id);

        $hospital = Hospital::findOrFail($hospital_id);
        return $dataTable->render('wards.index',compact('hospital'));
    }

    public function create(){
        //$hospitals = Hospital::lists('hospital_name','id');
        $hospital_id = Input::get('hospital_id');
        $hospital = Hospital::findOrFail($hospital_id);
        return view('wards.create')->withHospital($hospital);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'ward_name' => 'required|min:3|unique:wards,hospital_id',
            'hospital_id' => 'required'
        ]);

        $input = $request->all();
        $ward = Ward::create( $input );

        return \Redirect::route('wards.show',$ward->id)->with('flash_message', 'Ward successfully created!');
    }

    public function show($id){
        $ward = Ward::with('hospital')->findOrFail($id);

        return view('wards.show')->withWard($ward);
    }

    public function destroy($id){

        try{
            Ward::destroy($id);
        }catch(\Illuminate\Database\QueryException $e){
            return $e->getCode();
        }

    }

    public function edit($id){
        $ward = Ward::findOrFail($id);
        return view('wards.edit',compact('ward'));
    }

    public function update($id, Request $request){
        $ward = Ward::findOrFail($id);


        $this->validate($request,[
            'ward_name' => 'required|min:3|unique:wards,hospital_id',
            'hospital_id' => 'required'
        ]);

        $input = $request->all();

        $ward->fill($input)->save();


        return \Redirect::route('wards.show',$ward->id)->with('flash_message', 'Ward successfully updated!');
    }
}
