@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @foreach($pages as $page)    
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Name: {{$page->name}}</h5>
                          <p class="card-text">Description: {{$page->description}}</p>
                          <h6 class="card-subtitle mb-2 text-muted">Categories</h6>
                          @foreach($page->categories as $category)
                          <span class="card-link">{{$category->name}}</span>
                          @endforeach
                          @if(auth()->user())
                            <a href="{{ route('page.edit', $page->id) }}" class="card-link">Edit</a>
                            <form method="POST" action="{{ route('page.destroy', $page->id) }}" >
                                @csrf  
                                @method('DELETE')
                                <button type="submit" class="card-link">Destroy</a>
                            </form>
                          @endif
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
