@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        create user
    </div>

    <div class="card-body">
        <form method="POST" action="{{route('admin.store_user')}}" enctype="multipart/form-data">
            @csrf

            

            <div class="form-group">
                <label class="required" for="name"> Name </label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="email"> Email </label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', '') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="password"> Password </label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="password" name="password" id="password" value="{{ old('password', '') }}" required>
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            
            <div class="form-group">
                <label for="role"> Role </label>
                
                <select class="form-control select2 {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role" id="role" required >
                    <option > choose role </option>
                    <option value="admin"> admin </option>
                    <option value="user"> user </option>
                </select>    
            </div>
            @if($errors->has('role'))
                    <span class="text-danger">{{ $errors->first('role') }}</span>
            @endif
            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('sccripts')


@endsection