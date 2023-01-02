<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompany;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::orderBy('id', 'desc')->paginate(1);

        return view('company', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $companyModel = new Company();
        $companyModel->name = $request->name;
        $companyModel->email = $request->email;

        if ($request->hasFile('logo')) {
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = time().'.'.$file->extension();
                $file->storeAs('public/company', $filename);
                $companyModel->logo = $filename;
            }
        } else {
            return back()->with('message', 'No file selected.');
        }

        if ($companyModel->save()) {
            return back()->with('message', 'Company added successfully.');
            // return redirect('some/url')->with('success', 'Employee added successfully.');
        } else {
            return back()->with('message', 'Something went wrong, please check and try again.');
            // return redirect('some/url')->with('success', 'Employee added successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company_edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompany $request, $id)
    {
        $cmnModel = Company::find($id);

        $cmnModel->name = $request->name;
        $cmnModel->email = $request->email;

        if ($request->hasFile('logo')) {
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = time().'.'.$file->extension();
                $file->storeAs('public/company', $filename);

                if ($cmnModel->logo) {
                    Storage::delete('public/company/' . $cmnModel->logo);
                }
                $cmnModel->logo = $filename;
            }
        } else {
            return back()->with('message', 'No file selected.');
        }

        if ($cmnModel->update()) {
            return redirect('company')->with('success', 'Company Updated successfully.');
        } else {
            return back()->with('message', 'Something went wrong, please check and try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companyModel = Company::find($id);

        if ($companyModel) {
            $companyModel->delete();
            Storage::delete('public/company/' . $companyModel->logo);

            return back()->with('message', 'Company deleted successfully.');
        } else {
            return back()->with('message', 'Something went wrong, please check and try again.');
        }
    }
}
