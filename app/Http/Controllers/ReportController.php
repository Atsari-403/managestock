<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function attendance()
    {
        return view('reports.attendance');
    }

    public function income()
    {
        return view('reports.income');
    }
}

