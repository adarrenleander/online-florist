@extends('layouts.app')
@section('title', 'Update Flower - Online Florist')

@section('content')
<div class="content">
    <h2>Update Flower</h2>
    <div class="content-container">
        <form action="/manage-flowers/update/{{ $flower->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Flower Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ $flower->name }}" value="{{ old('name') }}" autocomplete="none" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Flower Price') }}</label>
                <div class="col-md-6">
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="{{ $flower->price }}" value="{{ old('price') }}" autocomplete="none" min="0">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('Flower Stock') }}</label>
                <div class="col-md-6">
                    <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="{{ $flower->stock }}" value="{{ old('stock') }}" autocomplete="none" min="0">
                    @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Flower Type') }}</label>
                <div class="col-md-6">
                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" autocomplete="none">
                        <option>-- Select Type --</option>
                        @foreach ($types as $type)
                            @if ($flower->type_id == $type->id)
                        <option selected>{{ $type->type_name }}</option>
                            @else
                        <option>{{ $type->type_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Flower Description') }}</label>
                <div class="col-md-6">
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="{{ $flower->description }}" autocomplete="none">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Flower Image') }}</label>
                <div class="col-md-6">
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-3">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection