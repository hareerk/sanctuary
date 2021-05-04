@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card"><div class="card-header">Display all animals</div>
            <div class="card-body">
                <table class="table table-striped" border="1" >
                    <tr> <td> <b>Name </th> <td> {{$animal['name']}}</td></tr>
                        <tr> <th>Animal gender </th> <td>{{$animal->gender}}</td></tr>
                        <tr> <th>Animal species </th><td>{{$animal->species}}</td></tr>
                        <tr> <td>Date of birth </th><td>{{$animal->date_of_birth}}</td></tr>
                        <tr> <th>Notes </th> <td style="max-width:150px;" >{{$animal->description}}</td></tr>
                        <tr> <td colspan='2' ><img style="width:100%;height:100%" src="{{ asset('storage/images/'.$animal->image)}}"></td></tr>
                </table>
                
                <table><tr>
                    <td><a href="{{route('animals.index')}}" class="btn btn-primary" role="button">Back to the list</a></td>
                    @can('create-animal', Auth::user())
                    <td><a href="{{route('animals.edit', ['animal' => $animal['id']])}}" class="btn btn-warning">Edit</a></td>
                    <td><form action="{{route('animals.destroy', ['animal' => $animal['id']])}}" method="post"> @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
                        </form></td>
                    @endcan
                    @cannot('create-animal', Auth::user())
                    <td><form action="{{route('request',['animal' => $animal['id']])}}" method="post"> 
                    @csrf
                    <input type="hidden" value="{{$animal->id}}" name="animal_id" />
                    
                    <button class="btn btn-danger" type="submit">Adopt?</button>
                    </form>
                    @endcannot
                </tr></table>
                
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection