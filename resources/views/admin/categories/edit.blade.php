@extends('layouts.master')

@section('title','Create Categories')

@section('breadcrump')
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<form action="{{route('admin.categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('admin.categories.form',['button_label'=>'Update'])
</form>

@endsection
