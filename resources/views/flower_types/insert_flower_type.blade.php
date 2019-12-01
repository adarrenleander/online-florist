@extends('layouts.app')
@section('title', 'Insert Flower Type - Online Florist')

@section('content')
<div class="content">
    <h2>Insert Flower Type</h2>
    <div class="content-container">
        <form action="/manage-flower-types/insert" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="type-name" class="col-md-4 col-form-label text-md-right">Flower Type Name</label>
                <div class="col-md-6">
                    <input id="type-name" type="text" class="form-control @error('type_name') is-invalid @enderror" name="type_name" value="{{ old('type_name') }}" autocomplete="none" autofocus>
                    @error('type_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-3">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">Insert</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection