@extends('layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="{{asset("vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
    <link rel="stylesheet" href="/vendor/DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/DataTables/Buttons/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css">
    <style>
        .fake-row::before {
            content: "";
            display: table;
            clear: both;
        }
        .default-modal .select2-container {
            width: 100% !important;
        }
        .select2-container{
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4>Faculty Students</h4>
            <ol class="breadcrumb no-bg m-b-1">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Faculty Details</li>
            </ol>


            @if ($errors->any())
                <div class="box box-block bg-white">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="box box-block bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="m-b-1">Faculty Details</h5>
                        <div class="card m-b-0">
                            <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Basic Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Students</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">Submission History</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                    <div class="tab-pane active" id="tab1" role="tabpanel" >
                                            <div class="col-xs-12">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <div class="media stream-item">
                                                            <div class="media-left">
                                                                <div class="avatar box-48 icon-area">
                                                                    <span class="ti-info-alt font-"></span>
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="media-heading">
                                                                    Name :
                                                                    <br>
                                                                   <div class="purple-text">{{$faculty->name}}</div>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="media stream-item">
                                                            <div class="media-left">
                                                                <div class="avatar box-48 icon-area">
                                                                    <span class=" ti-user"></span>
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="media-heading">
                                                                    Managed By :<br><a class="purple-text" href="#"> <b>{{$faculty->marketingCoordinator->name}}</b></a>
                                                                    <br>
                                                                    <span class="font-90 stream-meta capitalize">{{($faculty->marketingCoordinator->getRoleNames())[0]}}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="media stream-item">
                                                            <div class="media-left">
                                                                <div class="avatar box-48 icon-area">
                                                                    <span class="ti-info-alt font-"></span>
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="media-heading">
                                                                    Total Seats :
                                                                    <br>
                                                                    <div class="purple-text">{{$faculty->seats}}</div>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="media stream-item">
                                                            <div class="media-left">
                                                                <div class="avatar box-48 icon-area">
                                                                    <span class="ti-info-alt font-"></span>
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="media-heading">
                                                                    Occupied Seats :
                                                                    <br>
                                                                    <div class="purple-text">{{$faculty->students()->count()}}</div>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                    </div>
                                <div class="tab-pane " id="tab2" role="tabpanel" >
                                    <div class="col-xs-12">
                                        <ul class="list-unstyled">
                                            @foreach($faculty->students()->get() as $index => $student)
                                            <li>
                                                <div class="media stream-item">
                                                    <div class="media-left">
                                                        <div class="avatar box-48">
                                                            <img class="b-a-radius-circle" src="/img/student.png" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">
                                                            <a class="green-text" href="#"> <b>{{$student->name}}</b></a>
                                                            <br>
                                                            <span class="font-90 stream-meta capitalize">{{($student->getRoleNames())[0]}}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-pane " id="tab3" role="tabpanel" >
                                    <div class="col-xs-12">
                                        <table class="table table-hovertable-bordered dataTable" id="table-2">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Year</th>
                                                <th>File</th>
                                                <th>Type</th>
                                                <th>Submitted By</th>
                                                <th>Uploaded At</th>
                                                <th>Last Modified</th>
                                                <th>Status</th>
                                                <th>actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($faculty->submissions as $index => $submission)
                                                <tr>
                                                    <td><img src="/img/{{$submission->type}}.png" class="submission-icon"></td>
                                                    <th>{{$submission->closure->academic_year}}</th>
                                                    <td>{{$submission->name}}</td>
                                                    <td>{{$submission->type}}</td>
                                                    <td>{{$submission->submitter->name}}</td>
                                                    <td>{{$submission->created_at}}</td>
                                                    <td>{{$submission->updated_at}}</td>
                                                    <th>{{($submission->getStatus())->status}}</th>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Actions
                                                                </button>
                                                                <div class="dropdown-menu filter" aria-labelledby="dropdownMenuButton">
                                                                    @can('view articles and pictures')
                                                                        <a class="dropdown-item" href="{{route("submissionView",["submission_id"=>$submission->id])}}" ><i class="ti-eye"></i> View Submission</a>
                                                                    @endcan
                                                                    @can('modify articles and pictures')
                                                                        <a class="dropdown-item" href="{{route("deleteSubmission",["submission"=>$submission->id])}}" > <i class="ti-trash"></i> Delete</a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Year</th>
                                                <th>File</th>
                                                <th>Type</th>
                                                <th>Submitted By</th>
                                                <th>Uploaded At</th>
                                                <th>Last Modified</th>
                                                <th>Status</th>
                                                <th>actions</th>
                                            </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
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
    <script type="text/javascript" src="/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{asset("/vendor/select2/dist/js/select2.min.js")}}"></script>

    <script>
        $(function(){
            $(document).on("click" ,".add-student", function (e) {
                var that = $(this);
                var modal = $(".small-modal");
                var faculty_id =that.data("faculty-id");
                console.log(faculty_id);
                $('#faculty_id').val(faculty_id);
            });

            $('[data-dismiss="modal"]').click(function (e) {
                ($(".small-modal form")[0]).reset();
                $(".small-modal form select").val(1).trigger("change")
            });
        });
    </script>

@endsection