@extends('layouts.master')

@section('title', 'Admin@portfolio | Service')

@section('main-content')
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Service List</div>
                    <a href="{{ route('service.create') }}" class="btn btn-success float-right"><i
                            class="fa fa-plus">
                            Add Service
                        </i>
                    </a>
                </div>
                <div class="ibox-body">
                    <table class="table table-hover">
                        <thead class="table-secondary">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($service_data))
                                @foreach ($service_data as $service)
                                    <tr>
                                        <td>{{$service->title}}</td>
                                        <td>{{$service->desc}}</td>
                                        <td>
                                            <img src="{{ asset('uploads/service/Thumb-'. $service->image) }}" alt="" class="img img-responsive">
                                        </td>
                                        <td>{{$service->content}}</td>
                                        <td>{{ucfirst($service->status)}}</td>
                                        <td>
                                            <a href="{{ route('service.edit', $service->id) }}" class="btn btn-success">
                                                <i class="fa fa-pen">

                                                </i>
                                            </a>
                                            <form action="{{ route('service.destroy', $service->id) }}" method="post" class="d-inline">
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