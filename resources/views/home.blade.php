@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee List
                    <a href="{{route('add_emp')}}" class="btn btn-sm btn-primary float-end">Add Employee</a>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                        @php
                            Session::forget('message');
                        @endphp
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                  <th>Id</th>
                                  <th>company</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($employee)
                                @php
                                    $id = 1;
                                @endphp
                                    @foreach ($employee as $emp)
                                        <tr>
                                            <th>{{$id++}}</th>
                                            <td>{{$emp['company']['name']}}</td>
                                            <td>{{$emp['first_name']}}</td>
                                            <td>{{$emp['last_name']}}</td>
                                            <td>{{$emp['email']}}</td>
                                            <td>{{$emp['phone']}}</td>
                                            <td><a href="{{url('edit/'.$emp['id'])}}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                                            <td><a href="{{url('delete/'.$emp['id'])}}" class="btn btn-sm btn-outline-danger">Delete</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p class="text-danger fw-bold">No data</p>
                                @endif
                            </tbody>
                        </table>
                        {{ $employee->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
