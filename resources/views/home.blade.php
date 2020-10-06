@extends('layouts.app')

@section('content')


@foreach ($heroes as $hero)


<div class="card">
    <div class="card-header">
        <h1>{{$hero->name}}</h1>
    </div>
    <div class="card-body">
        <h5 class="card-title">Author: {{$hero->user->name}} </h5>

        <p class="card-text"> {{ $hero->description}}</p>  
    </div>
    <div class="card-footer text-muted">
        <div class="row">
            <div class="col-6">Updated: {{$hero->created_at}} </div>
            <div class="col-6">Created: {{$hero->updated_at}} </div>
        </div>
    </div>
</div>

@endforeach

{{ $heroes->links() }}

        

    








@endsection
