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
                          <a href="{{ route('category.edit', $category->id) }}" class="card-link">Edit</a>
                          <form method="POST" action="{{ route('category.destroy', $category->id) }}" >
                            @csrf  
                            @method('DELETE')
                            <button type="submit" class="card-link">Destroy</a>
                          </form>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
