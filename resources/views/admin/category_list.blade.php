@extends('layouts.master')

@section('title', 'Admin@portfolio | Category')

@section('main-content')
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Category List</div>
                    <a href="{{ route('category.create') }}" class="btn btn-success float-right"><i
                            class="fa fa-plus">
                            Add Category
                        </i>
                    </a>
                </div>
                <div class="ibox-body">
                    <table class="table table-hover">
                        <thead class="table-secondary">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($category_data))
                                @foreach ($category_data as $category)
                                    <tr>
                                        <td>{{$category->title}}</td>
                                        <td>{{$category->desc}}</td>
                                        <td>
                                            <img src="{{ asset('uploads/gallery_category/Thumb-'. $category->image) }}" alt="" class="img img-responsive">
                                        </td>
                                        <td>{{ucfirst($category->status)}}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success">
                                                <i class="fa fa-pen">

                                                </i>
                                            </a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection