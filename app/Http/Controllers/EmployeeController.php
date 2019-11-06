<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */

    public function __construct()
    {
        $this->middleware('auth');
    }   
     
    public function index()
    {
        $employees = Employee::latest()->paginate(5);

         //$company = Company::get();

        return view('employee.index',compact('employees'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::get();
        return view('employee.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'company' => 'required',
            'profile' => 'required',
        ]);
        
        $path = $request->file('profile')->store('public');

        $form_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company' => $request->company,
            'profile' => $path
        );
        
        Employee::create($form_data);

        return redirect()->route('employee.index')
                        ->with('success','New Record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $company = Company::get();
        return view('employee.edit',compact('employee','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'company' => 'required',
            'profile' => 'required',
        ]);
        
        $path = $request->file('profile')->store('public');

        $form_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company' => $request->company,
            'profile' => $path
        );
        

        $employee->update($form_data);
  
        return redirect()->route('employee.index')
                        ->with('success','Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        

        return redirect()->route('employee.index')
                        ->with('success','Record deleted successfully');
    }
}
