@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        create category
    </div>

    <div class="card-body">
        <form method="POST" action="{{route('admin.store_category')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="categories"> parent </label>
                
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="category" id="category" >
                	<option value="0"> choose parent </option>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                @endif
                
            </div>

            <div class="form-group">
                <label class="required" for="title"> title</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">description </label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                
            </div>
           
            <div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
			  </div>
			  <div class="custom-file">
			    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
			    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
			  </div>
			</div>
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