<?php

namespace App\Http\Controllers\Reports;

use App\Models\Hospital;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsageController extends Controller
{
    public function index(){
        $hospitals = Hospital::notHq()->lists('hospital_name', 'id');
        return view('reports.usages.index', compact('hospitals'));
    }
}
