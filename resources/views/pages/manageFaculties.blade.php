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
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4>Faculties</h4>
            <ol class="breadcrumb no-bg m-b-1">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Manage Faculties</li>
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

            @can("add faculty")
            <form method="POST" action="{{route("addFaculty")}}">
                @csrf
                <div class="box box-block bg-white">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Add New Faculty</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Faculty Name</label>
                        <div class="col-sm-10">
                            <input id="name" placeholder="Name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   value="{{ old('name') }}" required autofocus>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Faculty Seats</label>
                        <div class="col-sm-10">
                            <input id="seats" placeholder="Seats" type="number" min="1" max="100"
                                   class="form-control{{ $errors->has('seats') ? ' is-invalid' : '' }}" name="seats"
                                   value="{{ old('seats') }}" required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Marketing Coordinator</label>
                        <div class="col-sm-10">
                            <select name="user_id" class="form-control" required data-plugin="select2">
                                @foreach( $marketing_cos as $marketing_co)
                                    <option value="{{$marketing_co->id}}">{{$marketing_co->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>


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
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="m-b-1">Faculties</h5>
                        <table class="table table-hovertable-bordered dataTable" id="table-2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Faculty Name</th>
                                <th>Available Seats</th>
                                <th>Marketing Coordinator</th>
                                <th>actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($faculties as $index => $faculty)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$faculty->name}}</td>
                                <td>{{$faculty->seats}}</td>
                                <td>{{$faculty->marketingCoordinator->name}}</td>
                                <td>
                                    <div class="btn-group">
                                        @can("modify faculty")
                                        <button class="btn btn-primary edit-data waves-effect waves-light" data-toggle="modal" data-target=".default-modal" data-record="{{base64_encode(json_encode($faculty))}}"><i class="ti-pencil"></i></button>
                                        <button class="btn btn-danger confirm waves-effect waves-light" data-url="{{ route("deleteFaculty",["faculty"=>$faculty->id]) }}" ><i class="ti-trash"></i></button>
                                        @endcan
                                        <a class="btn btn-success waves-effect waves-light" href="{{route("facultyDetails",$faculty->id)}}" >DETAILS</a>

                                    </div>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Faculty Name</th>
                                <th>Available Seats</th>
                                <th>Marketing Coordinator</th>
                                <th>actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can("modify faculty")
    <div class="modal fade default-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="{{route("updateFaculty")}}" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Details </h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h4>Add New Faculty</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Faculty Name</label>
                            <div class="col-sm-10">
                                <input id="name" placeholder="Name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ old('name') }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Faculty Seats</label>
                            <div class="col-sm-10">
                                <input id="seats" placeholder="Seats" type="number" min="1" max="100"
                                       class="form-control{{ $errors->has('seats') ? ' is-invalid' : '' }}" name="seats"
                                       value="{{ old('seats') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Marketing Coordinator</label>
                            <div class="col-sm-10">
                                <select name="user_id" class="form-control" required data-plugin="select2">
                                    @foreach( $marketing_cos as $marketing_co)
                                        <option value="{{$marketing_co->id}}">{{$marketing_co->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <input type="hidden" name="id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endcan







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
    <script type="text/javascript">
        $(function () {
            $(document).on("click", ".edit-data", function () {
                var that = $(this);

                var data = JSON.parse(atob(that.data("record")));
                console.log(data);
                $.each(data, function (key, val) {
                    $('.default-modal [name="' + key + '"]:not([type="radio"])').val(val).trigger("change");
                });
                $('.default-modal [name="id"]').val(data.id).trigger("change");
                $('.default-modal [name="role"]').val(data.roles[0].id).trigger("change");
                $(".default-modal [name='two_factor']").map(function () {
                    console.log($(this), $(this).val(), data.two_factor);
                    if ($(this).val() == data.two_factor){
                        $(this).prop("checked", true);
                    }
                });
                var instance = intlTelInputGlobals.getInstance($(".default-modal .tel-input")[0]);
                var number = data.country_code+data.phone;
                if (number){
                    instance.setNumber(number);
                }

                $(".default-modal #del").attr("data-url",window.location.origin+"/users/"+data.id+"/delete");
            });
            $("default-modal .close-modal").click(function () {
                $('.default-modal input[type="text"]').val("");
                $('default-modal .select2').val("").change();
            });
            $(".permission-modal .close-modal").click(function (e) {
                $(".permission-modal input").prop("checked",false);
                $(".permission-modal [name='user_id']").val("");
            });
            $(document).on("click", ".edit-permissions", function (e) {
                var permissions = JSON.parse(atob($(this).data("permissions")));
                var userId = $(this).data("user-id");
                $.each(permissions, function (key, permission) {
                    $(".permission-modal input[value='"+permission+"']").prop("checked",true);
                });
                $(".permission-modal [name='user_id']").val(userId);
                console.log(permissions);
            });

        });
    </script>
@endsection