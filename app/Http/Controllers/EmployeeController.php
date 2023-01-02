<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::orderBy('id', 'desc')->paginate(2);

        return view('home', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::get();
        return view('add_employee', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        // $input = $request->validated();
        $input = $request->all();    
        $employee = Employee::create($input);

        if ($employee) {
            return back()->with('message', 'Employee added successfully.');
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
        $employee = Employee::find($id);
        $company = Company::get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $company = Company::get();
        return view('edit_employee', compact('employee', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, $id)
    {
        $employModel = Employee::find($id);

        $employModel->company_id = $request->company_id;
        $employModel->first_name = $request->first_name;      
        $employModel->last_name = $request->last_name;   
        $employModel->email = $request->email;
        $employModel->phone = $request->phone; 

        $employModel->update();

        if ($employModel) {
            return redirect('home')->with('success', 'Employee added successfully.');
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
        $employModel = Employee::find($id);

        if ($employModel) {
            $employModel->delete();

            return back()->with('message', 'Employee deleted successfully.');
        } else {
            return back()->with('message', 'Something went wrong, please check and try again.');
        }
    }
}
