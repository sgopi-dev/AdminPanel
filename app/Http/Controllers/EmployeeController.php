<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Employee::with('company');

        if (request('name')) {

            $name = request('name');

            $query->where(function ($q) use ($name) {

                $q->where('first_name', 'like', "%$name%")
                    ->orWhere('last_name', 'like', "%$name%")
                    ->orWhereRaw("CONCAT(first_name,' ',last_name) LIKE ?", ["%$name%"]);
            });
        }

        if (request('company')) {
            $query->where('company_id', request('company'));
        }

        if (request('status') !== null && request('status') !== '') {
            $query->where('is_active', request('status'));
        }

        $employees = $query->paginate(10)->withQueryString();
        $companies = Company::all();

        return view('employees.index', compact('employees', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required',
            'email' => 'nullable|email|unique:employees,email',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $photo = null;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('employees', 'public');
        }

        Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_id' => $request->company_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => $request->is_active ?? 1,
            'photo' => $photo
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'company_id' => 'required|exists:companies,id',
            'email'      => 'nullable|email|unique:employees,email,' . $employee->id,
            'phone'      => 'nullable',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active'  => 'nullable|boolean'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('employees', 'public');
        }

        $employee->update($data);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee Deleted Successfully');
    }
}
