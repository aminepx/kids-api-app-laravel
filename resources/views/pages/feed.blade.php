@extends('layout.app')

@section('content')

<div class="float-end mt-2 me-5">
  <a href="{{route('add')}}"> <button class="btn btn-primary"> Add New Category</button></a>
</div>
@foreach ($categories as $cat)
<table class="table w-75 mt-5 m-auto">
  <thead class="">
    <tr>
      <th scope="col">ID</th>
      <th style="width: 200px" scope="col">Title</th>
      <th scope="col">Image</th>
      <th></th>
    </tr>
  </thead>
  <tbody class="">
  <tr >
      <th scope="row">{{$cat->id}}</th>
      <td style="width: 200px">{{$cat->name}}</td>
      <td><img src="{{asset('images/'.$cat->image) }}" width="100px"  alt=""></td>
      <td> <span class="d-flex">
        <form action="{{route('delete',['id'=>$cat->id])}}"  method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger me-1">Delete</button>
            </form>
        <a href="{{route('update',['id'=>$cat->id])}}" class="profile__button u-fat-text"><button class="btn btn-warning me-1">Update</button></a></td>
    <td>

    </td>
    
  </tr>
   
  </tbody>
</table>
    @endforeach


@endsection