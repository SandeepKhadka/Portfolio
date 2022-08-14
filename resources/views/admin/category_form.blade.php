@extends('layouts.master')

@section('title', 'Admin@portfolio | Category')

@section('main-content')
    <div class="container" style="padding: 10px">
        <div class="ibox-head">
            <div class="ibox-title"><h4>Category {{ isset($category_data) ? 'Update' : 'Add' }}</h4></div>
            <br>
        </div>
        <div class="ibox-body">
            @if (isset($category_data))
                <form action="{{ route('category.update', @$category_data->id) }}" method="post" class="form"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                @else
                    <form action="{{ route('category.store') }}" method="post" class="form" enctype="multipart/form-data">
                        @csrf
            @endif
            <div class="form-group row">
                <label class="col-sm-3">Title:</label>
                <div class="col-sm-9">
                    <input type="text" name="title" required placeholder="Enter Title"
                        value="{{ @$category_data->title }}" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for="">Description:</label>
                <div class="col-sm-9">
                    <textarea name="desc" id="desc" rows="5" class="form-control" placeholder="Enter description.."
                        style="resize: none;">{{ @$category_data->desc }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for="">Image:</label>
                <div class="col-sm-4">
                    <input type="file" name="image" {{ isset($category_data) ? '' : 'required' }}>
                </div>
                <div class="col-sm-4">
                    <img src={{ asset('uploads/gallery_category/Thumb-' . @$category_data->image) }} alt=""
                        class="img img-fluid img-responsive" style="max-width: 10rem">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for="">Status:</label>
                <div class="col-sm-9">
                    <select name="status" id="status" class="form-control form-control-sm">
                        <option {{ @$category_data->status == 'active' ? 'selected' : '' }}>active</option>
                        <option {{ @$category_data->status == 'inactive' ? 'selected' : '' }}>inactive</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for=""></label>
                <div class="col-sm-9">
                    <button type="reset" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        Reset
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-paper-plane"></i>
                        {{ isset($category_data) ? 'Update' : 'Add' }}
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
