@extends('layouts.master')

@section('title','Create Categories')

@section('breadcrump')
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

<form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('admin.categories.form')

</form>

@endsection
