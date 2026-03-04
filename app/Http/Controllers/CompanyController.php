<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::withCount('employees')->paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies',
            'email'=> 'nullable|email',
            'website'=>'nullable|url',
            'logo'=> 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos','public');
        }

        Company::create([
            'name'=> $request->name,
            'email' => $request->email,
            'website'=>$request->website,
            'logo'=> $logoPath,
        ]);
        
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $employees = $company->employees;
        return view('companies.show', compact('company', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name' => 'required|unique:companies,name,'.$company->id,
            'email'=> 'nullable|email',
            'website'=> 'nullable',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        
        $company->update($data);

        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if($company->employees()->count() > 0){
            return redirect()->back()->with('error','Cannot delete company with employeess');
        }

        $company->delete();
        return redirect()->route('companies.index')->with('success','Company deleted');
    }
}
