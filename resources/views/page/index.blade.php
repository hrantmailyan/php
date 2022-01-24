@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <a href="/page/create">
            Create Page
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @foreach($pages as $page)    
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Name: {{$page->name}}</h5>
                          <p class="card-text">Description: {{$page->description}}</p>
                          <h6 class="card-subtitle mb-2 text-muted">Category</h6>
                          @foreach($page->categories as $category)
                          <span class="card-link">{{$category->name}}</span>
                          @endforeach
                          <div class="d-flex justify-content-between">
                            @if(auth()->user())
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-secondary" href="{{ route('page.edit', $page->id) }}">Edit</a>
                                <form method="POST" action="{{ route('page.destroy', $page->id) }}" class="ml-2" >
                                    @csrf  
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Destroy</a>
                                </form>
                            </div>
                            @endif
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
