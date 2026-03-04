<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $companies = Company::withCount('employees')->get();

        $active = Employee::where('is_active',1)->count();
        $inactive = Employee::where('is_active',0)->count();

        return view('dashboard', compact('companies','active','inactive'));
      
    }
}
