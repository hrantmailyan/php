@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <a href="/category/create">
            Create Category
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @foreach($categories as $category)    
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Name: {{$category->name}}</h5>
                          <div class="d-flex justify-content-end">

                              <a class="btn btn-secondary" href="{{ route('category.edit', $category->id) }}" >Edit</a>
                              <form method="POST" action="{{ route('category.destroy', $category->id) }}" class="ml-2" >
                                @csrf  
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Destroy</a>
                              </form>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
