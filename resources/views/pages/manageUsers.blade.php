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
            <h4>Manage Users</h4>
            <ol class="breadcrumb no-bg m-b-1">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Manage Users</li>
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


            <form method="POST" action="{{ route('addUser') }}">
                @csrf
                <div class="box box-block bg-white">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Add New User</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input id="name" placeholder="Name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   value="{{ old('name') }}" required autofocus>


                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input id="email" placeholder="Email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input id="phone" type="text" class="tel-input auto form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone">
                            <input type="hidden" name="country_code" value=""/>
                        </div>
                    </div>
                    <fieldset class="form-group row">
                        <div class="col-sm-8 offset-sm-2">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="two_factor" value="1" checked>
                                    Turn On two factor Verification
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="two_factor" value="0">
                                    Turn Off two factor Verification
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input id="password" placeholder="Password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>

                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input id="password-confirm" placeholder="Confirm Password" type="password"
                                   class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">User Role</label>
                        <div class="col-sm-10">

                            <select name="role" class="form-control" required data-plugin="select2">
                                @foreach($roles as $index => $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
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

            <div class="box box-block bg-white">
                <div class="row">
                    <div class="col-md-12">
                        {{--<h5 class="m-b-1">Exporting Table Data</h5>--}}
                        <table class="table table-hovertable-bordered dataTable" id="table-2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{sizeof($user->getRoleNames()) >= 1 ? $user->getRoleNames()[0]: "No Role"}}</td>
                                        <td>
                                            <div class="btn-group">
                                           {{-- <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Role
                                                </button>
                                                <div class="dropdown-menu filter" aria-labelledby="dropdownMenuButton">
                                                    @foreach($roles as $index => $role)
                                                        <a class="dropdown-item" href="{{route("changeRole",["id"=>$user->id,"role"=>$role->id])}}" >{{$role->name}}</a>

                                                    @endforeach
                                                </div>
                                            </div>--}}
                                            <button class="btn btn-primary edit-data waves-effect waves-light" data-toggle="modal" data-target=".default-modal" data-record="{{base64_encode(json_encode($user))}}">DETAILS</button>
                                            <button class="btn btn-danger confirm waves-effect waves-light" data-url="{{route("deleteUser",["id"=>$user->id])}}" ><i class="ti-trash"></i></button>
                                            <button class="btn btn-success waves-effect waves-light edit-permissions" data-toggle="modal" data-target=".permission-modal" data-user-id={{$user->id}} data-permissions="{{base64_encode(json_encode($user->getAllPermissions()->pluck("name")))}}" > Permissions</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade default-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="{{route("updateUser")}}" method="POST">
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
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input  placeholder="Name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                               value="{{ old('name') }}" required autofocus>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input placeholder="Email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                               value="{{ old('email') }}" required>


                                    </div>
                                </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="tel-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                       name="phone">
                                <input type="hidden" name="country_code" value=""/>
                            </div>
                        </div>
                        <fieldset class="form-group row">
                            <div class="col-sm-8 offset-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="two_factor" value="1" checked>
                                        Turn On two factor Verification
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="two_factor" value="0">
                                        Turn Off two factor Verification
                                    </label>
                                </div>
                            </div>
                        </fieldset>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Update Password</label>
                                    <div class="col-sm-10">
                                        <input placeholder="Password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" >


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input  placeholder="Confirm Password" type="password"
                                               class="form-control" name="password_confirmation" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">User Role</label>
                                    <div class="col-sm-10">

                                        <select name="role" class="select2 w-100" required>
                                            @foreach($roles as $index => $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
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
    <div class="modal fade permission-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="{{route("updatePermission")}}" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"> Permissions </h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="container">
                            @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                            <div class="col-md-4 mt-2">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$permission->name}}">
                                    <span class="custom-control-indicator"></span>
                                    <label class="form-check-label" for="exampleCheck1">{{$permission->name}}</label>
                                </label>

                            </div>
                                @endforeach
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
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