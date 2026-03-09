<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string|max:255|unique:companies,name',
            'email' => 'nullable|email|unique:companies,email',
            'website' => 'nullable|url|unique:companies,website',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Company::create($data);

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Company $company, Request $request)
    {
        // Start query for employees of this company
        $query = $company->employees();

        // Search by name/email/full name
        if ($search = trim($request->input('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name,' ',last_name) LIKE ?", ["%{$search}%"])
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        // Paginate employees
        $employees = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // preserves search & filter in pagination links

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
        $request->validate([
            'name' => [
                'required',
                Rule::unique('companies')->ignore($company->id)
            ],

            'email' => [
                'nullable',
                'email',
                Rule::unique('companies', 'email')->ignore($company->id)
            ],

            'website' => [
                'nullable',
                'url',
                Rule::unique('companies', 'website')->ignore($company->id)
            ],

            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($data);

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->employees()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete company with employeess');
        }

        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted');
    }
}
