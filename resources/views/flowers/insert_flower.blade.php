@extends('layouts.app')
@section('title', 'Insert Flower - Online Florist')

@section('content')
<div class="content">
    <h2>Insert Flower</h2>
    <div class="content-container">
        <!-- form for inserting new flower -->
        <form action="/manage-flowers/insert" method="post" enctype="multipart/form-data">
            @csrf
            <!-- flower name field -->
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Flower Name</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="none" autofocus>
                    <!-- error message if flower name validation fails -->
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- flower price field -->
            <div class="form-group row">
                <label for="price" class="col-md-4 col-form-label text-md-right">Flower Price</label>
                <div class="col-md-6">
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" autocomplete="none" min="0">
                    <!-- error message if flower price validation fails -->
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- flower stock field -->
            <div class="form-group row">
                <label for="stock" class="col-md-4 col-form-label text-md-right">Flower Stock</label>
                <div class="col-md-6">
                    <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" autocomplete="none" min="0">
                    <!-- error message if flower stock validation fails -->
                    @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- flower type dropdown list -->
            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">Flower Type</label>
                <div class="col-md-6">
                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" autocomplete="none">
                        <option>-- Select Type --</option>  <!-- default option -->
                        <!-- iterate over each flower type and print as option -->
                        @foreach ($types as $type)
                        <option>{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                    <!-- error message if flower type validation fails -->
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- flower description textarea -->
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Flower Description</label>
                <div class="col-md-6">
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="none">{{ old('description') }}</textarea>
                    <!-- error message if flower description validation fails -->
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- flower image upload field -->
            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">Flower Image</label>
                <div class="col-md-6">
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                    <!-- error message if flower image validation fails -->
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <!-- insert button to attempt insert -->
            <div class="form-group row mb-3">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">Insert</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection