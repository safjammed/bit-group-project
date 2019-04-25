@extends('layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="{{asset("vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
    <link rel="stylesheet" href="/vendor/DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/DataTables/Buttons/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/dropify/dist/css/dropify.min.css">
    <style>
        .fake-row::before {
            content: "";
            display: table;
            clear: both;
        }
        .default-modal .select2-container {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4>Submissions</h4>
            <ol class="breadcrumb no-bg m-b-1">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Submissions</li>
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

            @can('add article and pictures')
            <form method="POST" action="{{route("addSubmission")}}" enctype="multipart/form-data">
                @csrf
                <div class="box box-block bg-white">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Upload New Articles </h4>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Faculty</label>
                        <div class="col-sm-10">
                            <select name="faculty_id" class="form-control" required data-plugin="select2">
                                @foreach( $faculties as $faculty)
                                    <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <input type="file" class="dropify" name="upload" required accept=".doc,.docx,.pdf,.jpg,.png,.jpeg" />
                            <p class="text-info">* Max upload limit of this server is {{ini_get('post_max_size')}} and JPG,PNG,DOCX,DOC or PDF files are accepted</p>
                        </div>
                    </div>
                    <fieldset class="form-group row">
                        <div class="col-sm-8 offset-sm-2">

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="agree" required checked />
                                <label class="form-check-label">I agree to terms and conditions </label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <div class="col-sm-2 offset-md-4">
                            <button type="submit" class="btn btn-info btn-block py-2">
                                <strong>Create</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @endcan
            <div class="box box-block bg-white">
                <div class="row  m-b-3">
                    <div class="col-md-6">
                        <h5 class="m-b-1">Submissions of {{$showing_year}}</h5>
                    </div>
                    <div class="offset-md-3 col-md-1">
                        <p> Academic Year</p>
                    </div>
                    <div class="col-md-2 ">

                        <select name="academic_year" id="academic_year" class="form-control select2 m-b-2">
                            @foreach($academic_years as $academic_year)
                                <option value="{{$academic_year}}"  {{($showing_year == $academic_year)? "selected" : "" }}>{{$academic_year}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">

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
                            @foreach($submissions as $index => $submission)
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
    <script type="text/javascript" src="{{asset("/vendor/dropify/dist/js/dropify.min.js")}}"></script>

    <script>
        $(function () {
            $("#academic_year").change(function (e) {
                var year = $(this).val();
                var url =  window.location.origin + "/submission/of/" + year;

                return window.location.href=url;

            });
        });
    </script>
@endsection