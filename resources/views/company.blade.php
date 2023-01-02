@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company List
                    <a href="{{route('add_company')}}" class="btn btn-sm btn-primary float-end">Add Company</a>
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
                                  <th>Email</th>
                                  <th>Logo</th>
                                  <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($company)
                                @php
                                    $id = 1;
                                @endphp
                                    @foreach ($company as $cmp)
                                        <tr>
                                            <th>{{$id++}}</th>
                                            <td>{{$cmp['name']}}</td>
                                            <td>{{$cmp['email']}}</td>
                                            <td><img src="{{'storage/company/'.$cmp['logo']}}" alt="Logo" height="40px" width="40px"></td>

                                            <td><a href="{{url('company_edit/'.$cmp['id'])}}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                                            <td><a href="{{url('company_delete/'.$cmp['id'])}}" class="btn btn-sm btn-outline-danger">Delete</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p class="text-danger fw-bold">No data</p>
                                @endif
                            </tbody>
                        </table>
                        {{ $company->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
