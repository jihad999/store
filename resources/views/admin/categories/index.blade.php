@extends('layouts.master')

@section('title','Categories')

@section('breadcrump')
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

<div class="mb-2">
    <a href="{{route('admin.categories.create')}}" class="btn btn-sm btn-primary">Create</a>
    <a href="#" class="btn btn-sm btn-info">Trash</a>
</div>

@if (session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td></td>
                <td>{{$category->id??null}}</td>
                <td><img src="{{asset('storage/' . $category->image??null)}}" alt="" width="100px"></td>
                <td>{{$category->name??null}}</td>
                <td>{{$category->parent_id??null}}</td>
                <td>{{$category->status??null}}</td>
                <td>{{$category->created_at??null}}</td>
                <td>
                    <div class="flex justify-center gap-2">
                        <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form action="{{route('admin.categories.destroy',$category->id)}}" method="POST" class="m-0">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="alert('Sure for Delete?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No Categories Defined</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
