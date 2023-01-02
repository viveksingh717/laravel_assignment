@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company Form
                    <a href="{{route('company')}}" class="btn btn-sm btn-dark float-end">Company List</a>
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
                    <form action="{{url('company_update/'.$company['id'])}}" method="POST" class="p-3" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$company['name']}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$company['email']}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company Logo</label>
                            <input type="file" class="form-control" name="logo" id="inpFile" onchange="$('.preview__image')[0].src = window.URL.createObjectURL(this.files[0])">
                            
                            <img src="" alt="previewImage" class="mt-2 preview__image" height="50px" width="50px">
                            

                            @if ($errors->has('logo'))
                                <span class="text-danger">{{ $errors->first('logo') }}</span>
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

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.preview__image').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#inpFile").change(function(){
        readURL(this);
    });
</script>
