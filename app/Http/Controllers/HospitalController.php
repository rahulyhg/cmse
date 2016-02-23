<?php

namespace App\Http\Controllers;

use App\DataTables\HospitalDT;
use App\DataTables\WardsDT;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HospitalController extends Controller
{
    public function index(HospitalDT $dataTable){

        return $dataTable->render('hospitals.index');
        //return view('users.index');
    }

    public function create()
    {
        return view('hospitals.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'hospital_name' => 'required|min:2',
        ]);

        $input = $request->all();
        $hospital = Hospital::create( $input );

        return \Redirect::route('hospitals.show',$hospital->id)->with('flash_message', 'Hospital successfully created! <a href="'.url('hospitals/create').'">Add More</a>');
    }

    public function show($id, WardsDT $dataTable){

        $dataTable->setHospitalId($id);
        $hospital = Hospital::findOrFail($id);
        //return view('hospitals.show')->withHospital($hospital);
        return $dataTable->render('hospitals.show',compact('hospital'));
    }

    public function destroy($id){

        $wards = Hospital::findOrFail($id)->wards;
        if($wards->count()<=0){
            Hospital::destroy($id);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete hospital when there is wards found in this hospital'
            ], 422);
        }





    }

    public function edit($id){
        $hospital = Hospital::findOrFail($id);

        return view('hospitals.edit')->withHospital($hospital);
    }

    public function update($id, Request $request){
        $hospital = Hospital::findOrFail($id);





        $this->validate($request,[
            'hospital_name' => 'required|min:2',
        ]);

        $input = $request->all();

        $hospital->fill($input)->save();


        return \Redirect::route('hospitals.show',$hospital->id)->with('flash_message', 'Hospital successfully updated!');
    }
}
