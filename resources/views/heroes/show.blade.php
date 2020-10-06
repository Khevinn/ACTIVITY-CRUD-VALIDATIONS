@extends('layouts.app')
@section('content')


 <div class="row">
        <div class="col">
            <div class="pull-left">
                <h2>Show Heroes</h2>
            </div>
        </div>
    </div>

    <div class="row" >
        <div class="col">
            <div class="form-group">
                <strong>ID:</strong>
                {{ $hero->id }}
            </div> 
        </div>
    </div>    
    <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Heroes:</strong>
                    {{ $hero->name }}
            </div>
        </div>
    </div>     

     <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Author:</strong>
                    {{ $hero->user->name }}
            </div>
        </div>
    </div>  

    <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $hero->description }}
            </div>
        </div>  
    </div>      

     <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Updated:</strong>
                {{ $hero->updated_at }}
            </div>
        </div>  
    </div>      

     <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Created:</strong>
                {{ $hero->created_at }}
            </div>
        </div>  
    </div>      























@endsection