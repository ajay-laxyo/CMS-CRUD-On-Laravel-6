<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        $companys = Company::latest()->paginate(5);

        return view('company.index',compact('companys'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('company.create');
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
            'logo' => 'required',
            'website' => 'required',
        ]);
        
        $path = $request->file('logo')->store('public');

        $form_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $path,
            'website' => $request->website
        );
        
        Company::create($form_data);

        return redirect()->route('company.index')
                        ->with('success','New Record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('company.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required',
            'website' => 'required',
        ]);
        
        $path = $request->file('logo')->store('public');

        $form_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $path,
            'website' => $request->website
        );
        
        //Employee::create($form_data);

        $company->update($form_data);
  
        return redirect()->route('company.index')
                        ->with('success','Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        
        
        return redirect()->route('company.index')
                        ->with('success','Record deleted successfully');
    }
}
