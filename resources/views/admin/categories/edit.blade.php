@extends('layouts.master')

@section('title','Create Categories')

@section('breadcrump')
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<form action="{{route('admin.categories.update',$category->id)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="">Category Name</label>
        <input type="text" name="name" class="form-control" value="{{$category->name??null}}">
    </div>
    <div class="form-group">
        <label for="">Category Parent</label>
        <select name="parent_id" id="" class="form-control form-select">
            <option value="">Primary Category</option>
            @foreach ($parents as $parent)
                <option value="{{$parent->id}}" @selected($category->parent_id == $parent->id)>{{$parent->name??null}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Category Slug</label>
        <input type="text" name="slug" class="form-control" value="{{$category->slug??null}}">
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" class="form-control" id="" cols="30" rows="10">{{$category->description??null}}</textarea>
    </div>
    <div class="form-group">
        <label for="">Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Status</label>
        <div class="form-check">
            <input type="radio" name="status" value="active" id="radio-1" @checked($category->status == 'active')>
            <label for="radio-1">Active</label>
        </div>
        <div class="form-check">
            <input type="radio" name="status" value="archived" id="radio-2" @checked($category->status == 'archived')>
            <label for="radio-2">Archived</label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>

@endsection
