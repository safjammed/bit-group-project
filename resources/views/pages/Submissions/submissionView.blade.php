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
            height:80vh
        }
        .dataTable thead{
            display: none;
        }
        .dataTables_filter {
            float: right;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4>View Submission</h4>
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
                            Last Update : {{$submission->updated_at}} <br>
                            Status : {!! ( ($status->status == "waiting") ? "<span class='red-text'>Waiting For Comment</span>" :
                            (($status->status == "approved")? "<span class='green-text'>Commented at ".$submission->commented_at."</span>" :
                               (($status->status == "selected")? "<span class='green-text'>SELECTED FOR PUBLICATION</span>" :
                                "<span class='red-text'>Expired</span>"
                                )
                            )
                             );!!}
                            </p>
                        </div>
                        <hr>
                        <div class="m-b-1">
                            <div class="clearfix">
                                @can("select articles for publication")
                                    @if($status->status != "expired")
                                        <button type="button" class="btn btn-success pull-right m-r-0-5 label-left waves-effect waves-light">
                                            <span class="btn-label"><i class="ti-pencil"></i></span>
                                            Select For Publication
                                        </button>
                                    @endif
                                @endcan


                                @can("modify articles and pictures")
                                    @if($status->update && $status->status != "expired")
                                        <button type="button" class="btn btn-outline-primary btn-icon pull-right m-r-0-5"><i class="ti-reload"></i> Update</button>
                                    @endif
                                @endcan

                                @can("modify articles and pictures")
                                    @if($status->status != "expired")
                                        <button type="button" class="btn btn-outline-danger btn-icon pull-right m-r-0-5 confirm"><i class="ti-trash"></i></button>
                                    @endif
                                @endcan
                                {{--<div class="btn-group pull-right" role="group">
                                    <button type="button" class="btn btn-outline-primary waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Filter
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">time</a>
                                        <a class="dropdown-item" href="#">importance</a>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                        <hr>
                        <div class="container">

                        @if($type == "document")
                            <iframe src="{{route("loadDocument")}}" frameborder="0" class="w-100 doc-viewer b-a b-a-primary b-a-dashed m-b-0-5"></iframe>
                        @elseif($type == "picture")
                            <img src="{{route("loadPicture",[$file])}}" class="w-100" alt="">
                        @else
                            <h1 class="red-text">Invalid Document Format. Looks like you've come to the wrong place 🤷‍♀️</h1>
                        @endif
                        </div>

                        
                    </div>
                </div>
            </div>

            <div class="box box-block bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hovertable-bordered dataTable">
                            <thead>
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($submission->comments() as $comment)
                                <tr>
                                    <td>
                                        <div class="media stream-item">
                                            <div class="media-left">
                                                <div class="avatar box-64">
                                                    <img class="b-a-radius-circle" src="/img/teacher.png" alt="">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">
                                                    <a class="text-black" href="#">John Doe</a>
                                                    <span class="font-90 text-muted">Marketing Coordinator</span>
                                                </h6>
                                                <span class="font-90 stream-meta">14 minute ago</span>
                                                <div class="stream-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae neque incidunt cumque, dolore eveniet porro asperiores itaque! Eligendi minus cupiditate molestiae praesentium, facilis, neque saepe, soluta sapiente aliquid modi sunt.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach

                                {{--<tr>--}}
                                    {{--<td>--}}
                                        {{--<div class="media stream-item">--}}
                                            {{--<div class="media-left">--}}
                                                {{--<div class="avatar box-64">--}}
                                                    {{--<img class="b-a-radius-circle" src="/img/student.png" alt="">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="media-body">--}}
                                                {{--<h6 class="media-heading">--}}
                                                    {{--<a class="text-black" href="#">John Doe</a>--}}
                                                    {{--<span class="font-90 text-muted">Marketing Coordinator</span>--}}
                                                {{--</h6>--}}
                                                {{--<span class="font-90 stream-meta">14 minute ago</span>--}}
                                                {{--<div class="stream-body">--}}
                                                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae neque incidunt cumque, dolore eveniet porro asperiores itaque! Eligendi minus cupiditate molestiae praesentium, facilis, neque saepe, soluta sapiente aliquid modi sunt.</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}

                                {{--</tr>--}}




                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>

                            </tr>
                            </tfoot>
                        </table>


                        <div class="media stream-item">
                            <div class="media-left">
                                <div class="avatar box-64">

                                </div>
                            </div>
                            <div class="media-body">
                                <form action="{{route("addComment")}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleTextarea">Post a Comment</label>
                                        <textarea class="form-control" id="exampleTextarea" name="content" rows="3"></textarea>
                                    </div>
                                    <input type="hidden" name="submission_id" value="{{$submission->id}}"/>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('extra_js')
    <script type="text/javascript" src="/vendor/DataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/Responsive/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/Responsive/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/Buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/Buttons/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/JSZip/jszip.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/pdfmake/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/pdfmake/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/Buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/Buttons/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="/vendor/DataTables/Buttons/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="/js/tables-datatable.js"></script>
    <script>
        $(".dataTable").DataTable({
            "order": [],
            "aaSorting": []
        });
    </script>


@endsection