@extends('layouts.app')
@section('title', 'Catalog - Online Florist')

@section('content')
<div class="content">
    <h2>Catalog</h2>
    <div class="content-container">
        <form method="post" action="{{ url('home') }}">
            @csrf
            <div class="form-group row">
                <div class="col-md-6 offset-md-3">
                    <input type="text" class="form-control" name="search">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                </div>
            </div>
        </form>
        <table>
            @foreach($flowers as $flower)
                <tr>
                    <td>{{ $flower->name }}</td>
                    <td><img src="{{ $flower->image }}"></td>
                </tr>
            @endforeach
        </table>
        <div>{{ $flowers->links() }}</div>
    </div>
</div>
@endsection
