@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee Form
                    <a href="{{route('home')}}" class="btn btn-sm btn-dark float-end">Employee List</a>
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
                    <form action="{{url('update/'.$employee['id'])}}" method="POST" class="p-3">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{$employee['first_name']}}">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$employee['last_name']}}">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Company</label>
                                <select class="form-select" name="company_id">
                                    <option selected>Select Company</option>
                                    @if ($company)
                                        @foreach ($company as $cmp)
                                            @if ($employee['id'] == $cmp['id'])
                                                <option value="{{$cmp['id']}}" selected>{{$cmp['name']}}</option>
                                            @else
                                                <option value="{{$cmp['id']}}">{{$cmp['name']}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{$employee['phone']}}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" value="{{$employee['email']}}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-dark bg-gradient" name="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
