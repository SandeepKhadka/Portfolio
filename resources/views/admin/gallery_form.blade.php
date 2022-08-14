@extends('layouts.master')

@section('title', 'Admin@portfolio | Gallery')

@section('main-content')
    <div class="container" style="padding: 10px">
        <div class="ibox-head">
            <div class="ibox-title"><h4>Gallery {{ isset($gallery_data) ? 'Update' : 'Add' }}</h4></div>
            <br>
        </div>
        <div class="ibox-body">
            @if (isset($gallery_data))
                <form action="{{ route('gallery.update', $gallery_data->id) }}" method="post" class="form"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                @else
                    <form action="{{ route('gallery.store') }}" method="post" class="form" enctype="multipart/form-data">
                        @csrf
            @endif
            <div class="form-group row">
                <label class="col-sm-3">Title:</label>
                <div class="col-sm-9">
                    <input type="text" name="title" required placeholder="Enter Title"
                        value="{{ @$gallery_data->title }}" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for="">Description:</label>
                <div class="col-sm-9">
                    <textarea name="desc" id="desc" rows="5" class="form-control" placeholder="Enter description.."
                        style="resize: none;">{{ @$gallery_data->desc }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for="">Image:</label>
                <div class="col-sm-4">
                    <input type="file" name="image" {{ isset($gallery_data) ? '' : 'required' }}>
                </div>
                <div class="col-sm-4">
                    <img src={{ asset('uploads/gallery/Thumb-' . @$gallery_data->image) }} alt=""
                        class="img img-fluid img-responsive" style="max-width: 10rem">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for="">Image Alternate:</label>
                <div class="col-sm-9">
                    <input type="text" name="img_alt" placeholder="Enter image alternative word"
                        class="form-control form-control-sm" value="{{ @$gallery_data->img_alt }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for="">Category:</label>
                <div class="col-sm-9">
                    <select name="status" id="status" class="form-control form-control-sm">
                        <option value="" disabled selected hidden>Select image category</option>
                        <option>Nature</option>
                        <option>People</option>
                        <option>Architect</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3" for="">Status:</label>
                <div class="col-sm-9">
                    <select name="status" id="status" class="form-control form-control-sm">
                        <option {{ @$gallery_data->status == 'active' ? 'selected' : '' }}>active</option>
                        <option {{ @$gallery_data->status == 'inactive' ? 'selected' : '' }}>inactive</option>
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
                        {{ isset($gallery_data) ? 'Update' : 'Add' }}
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
