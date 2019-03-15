@extends('layouts.master')

@section('extra_css')
    <style>
        .fake-row::before {
            content: "";
            display: table;
            clear: both;
        }
        .default-modal .select2-container {
            width: 100% !important;
        }
        .doc-viewer{
            height:75vh
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4>Manage Users</h4>
            <ol class="breadcrumb no-bg m-b-1">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">View Submission</li>
            </ol>
            <div class="box box-block bg-white">
                <div class="row">
                    <div class="col-md-12">

                        <div class="w-100">
                            <h4>Showing <span class="orange-text">{{$file}}</span></h4>
                            <p>Submitted by <span class="orange-text"> {{$submission->submitter->name}}</span> <br>
                            Upload Date : {{$submission->created_at}} <br>
                            Last Update : {{$submission->updated_at}}</p>
                        </div>
                        <hr>
                        <div class="m-b-1">
                            <div class="clearfix">
                                <button type="button" class="btn btn-success pull-left m-r-0-5 label-left waves-effect waves-light">
                                    <span class="btn-label"><i class="ti-pencil"></i></span>
                                    Compose
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-icon pull-left m-r-0-5"><i class="ti-reload"></i></button>
                                <button type="button" class="btn btn-outline-primary btn-icon pull-left m-r-0-5"><i class="ti-trash"></i></button>
                                <div class="btn-group pull-right" role="group">
                                    <button type="button" class="btn btn-outline-primary waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Filter
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">time</a>
                                        <a class="dropdown-item" href="#">importance</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container">

                        @if($type == "document")
                            <iframe src="{{route("loadDocument")}}" frameborder="0" class="w-100 doc-viewer b-a b-a-primary b-a-dashed m-b-0-5"></iframe>
                        @elseif($type == "picture")
                            <img src="{{route("loadDocument",[$file])}}" class="w-100" alt="">
                        @else
                            <h1 class="red-text">Invalid Document Format. Looks like you've come to the wrong place 🤷‍♀️</h1>
                        @endif
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('extra_js')



@endsection