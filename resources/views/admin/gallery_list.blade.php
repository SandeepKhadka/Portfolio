@extends('layouts.master')

@section('title', 'Admin@portfolio | Gallery')

@section('main-content')
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Gallery List</div>
                    <a href="{{ route('gallery.create') }}" class="btn btn-success float-right"><i
                            class="fa fa-plus">
                            Add Gallery
                        </i>
                    </a>
                </div>
                <div class="ibox-body">
                    <table class="table table-hover">
                        <thead class="table-secondary">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Thumbnail</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($gallery_data))
                                @foreach ($gallery_data as $gallery)
                                    <tr>
                                        <td>{{$gallery->title}}</td>
                                        <td>{{$gallery->desc}}</td>
                                        <td>
                                            <img src="{{ asset('uploads/gallery/Thumb-'. $gallery->image) }}" alt="" class="img img-responsive">
                                        </td>
                                        <td>{{$gallery->cat_id}}</td>
                                        <td>{{ucfirst($gallery->status)}}</td>
                                        <td>
                                            <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-success">
                                                <i class="fa fa-pen">

                                                </i>
                                            </a>
                                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="post" class="d-inline">
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