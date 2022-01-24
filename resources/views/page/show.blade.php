@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center">Name: {{$page->name}}</h3>
            <h4 class="text-center">Description: {{$page->description}}</h4>
            <example-component page-comments="{{ json_encode($page->comments) }}" user_id="{{Auth::user() ? Auth::user()->id  : ''}}"></example-component>
        </div>
    </div>
</div>
@endsection
