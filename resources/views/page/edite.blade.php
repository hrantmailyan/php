@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Page</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('page.update', $page->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" />

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name: </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $page->name }}" required  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Description: </label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $page->description }}" required >

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="sequance" class="col-md-4 col-form-label text-md-end">Sequance: </label>

                            <div class="col-md-6">
                                <input id="sequance" type="number" class="form-control @error('sequance') is-invalid @enderror" name="sequance" value="{{$page->sequance}}" required >

                                @error('sequance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="published" class="col-md-4 col-form-label text-md-end">Published: </label>

                            <div class="col-md-6">
                                <input class="form-check-input" type="checkbox" name="published" value="true" id="published"{{  ($page->published == 1 ? ' checked' : '') }} >

                                @error('published')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Categories: </label>

                            <div class="col-md-6">
                            <select class="selectpicker" name="categories[]" multiple data-live-search="true">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                    @foreach($page->categories as $selected_category)
                                         @if($category->id == $selected_category->id)selected="selected"@endif 
                                    @endforeach
                                    >{{$category->name}}</option>
                                @endforeach
                            </select>

                                @error('description')
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
