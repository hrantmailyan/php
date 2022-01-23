@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Category</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('category.update', $category->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" />

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name: </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" required  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="sequance" class="col-md-4 col-form-label text-md-end">Sequance: </label>

                            <div class="col-md-6">
                                <input id="sequance" type="number" class="form-control @error('sequance') is-invalid @enderror" value="{{ $category->sequance }}" name="sequance" required >

                                @error('sequance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
