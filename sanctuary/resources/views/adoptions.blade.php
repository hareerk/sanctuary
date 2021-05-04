@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">Display all adoptions</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Adoption ID</th>
                                <th>User ID</th>
                                <th>Animal ID</th>
                                <th colspan="3">Action</th>
                            </tr>
                        </thead>
                    <tbody>
                    @foreach($adoptions as $adoption)
                    <tr>
                    <td>{{$adoption['id']}}</td>
                    <td>{{$adoption['userid']}}</td>   
                    <td>{{$adoption['animalid']}}</td>
                   
                    @can('create-animal', Auth::user())
                    <td><a href="{{route('deny', ['adoption' => $adoption['id']])}}" class="btn btn-warning">Deny</a></td>
                    <td><a href="{{route('approve', ['adoption' => $adoption['id']])}}" class="btn btn-primary">Approve</a></td>
                    
                    @endcan
                    @cannot('create-animal', Auth::user())
                        @if($adoption['approved'])
                        <td>Your adoption is approved for this animal</td>
                        @else
                        <td>Your adoption for this animal is pending approval. If you do not see a request you have made, it has been denied</td>
                        @endif


                    
                    @endcannot
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div> 
@endsection