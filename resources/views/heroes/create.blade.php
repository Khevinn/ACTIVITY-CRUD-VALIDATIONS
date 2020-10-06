@extends('layouts.app')
@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">   
                <h2>Create a new hero</h2>
            </div>
        </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>WOOOPA!</strong> Temos um problema com dados inseridos:<br></br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach 
        </ul>
    </div>
@endif   

        <form action="{{ route('heroes.store') }} " method="POST">
@csrf

    <div class="row" >
        <div class="col">
            <div class="form-group">
                <strong>Heroes:</strong>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" 
                required maxlength="255">
            </div>
        </div>
    </div>    

    <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description" value="{{ old('name') }}" required> </textarea>
            </div>
        </div>
    </div>    

    <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Photo:</strong>
                <input type="file" class="form-control" name="photo" value="{{ old('name') }}" required> </input>
            </div>
        </div>
    </div>    


    <div class="row">
        <div class="col text-center">
            <button type="submit" class="btn col btn-primary" required >CREATE</button>
            </div>
        </div>  
    </div>      


</form>




@endsection

