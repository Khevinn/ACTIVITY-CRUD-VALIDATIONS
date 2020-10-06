@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col">
        <div class="pull-left">
            <h2>Heroes Index</h2>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">
         {{ session('success')}}
     </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
         {{ session('error')}}
     </div>
@endif


<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Heroes</th>
        <th>Author</th>
        <th>Created</th>
        <th>Updated</th>
        <!-- <th>Actions</th> -->
        <th width="200px">Actions</th>
    </tr>
    @foreach ($heroes as $hero)
    <tr>
        <td>{{ $hero->id }}</td>
        <td>
            <a href="{{ url("/heroes/{$hero->id}")  }}">    
               {{$hero->name}} 
           </a>
        </td>

        <td>{{ $hero->user->name }}</td>
        <td>{{ $hero->created_at }}</td>
        <td>{{ $hero->updated_at }}</td>
        
        <td>
        
            <form action="{{ route('heroes.destroy', $hero->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('heroes.show',$hero->id) }}" >Show</a>
                <a class="btn btn-primary" href="{{ route('heroes.edit',$hero->id) }}" >Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>




{{ $heroes->links() }}






@endsection