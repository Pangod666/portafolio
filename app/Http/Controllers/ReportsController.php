<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moving;

class ReportsController extends Controller
{
    public function index(){
        $movings = Moving::orderBy('id', 'desc')->paginate(10);
        return view('reports.index')->with('movings',$movings);
    }
}
