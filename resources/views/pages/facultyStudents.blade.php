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
                <li class="breadcrumb-item active">Faculty Students</li>
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
                        <h5 class="m-b-1">Students In the Faculties</h5>
                        <div class="card m-b-0">
                            <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                                @foreach($faculties as $i => $faculty)
                                    <li class="nav-item">
                                        <a class="nav-link {{($i == 0) ? "active" : ""}}" data-toggle="tab" href="#tab{{$i}}" role="tab">{{$faculty->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($faculties as $i => $faculty)
                                    <div class="tab-pane {{($i == 0) ? "active" : ""}}" id="tab{{$i}}" role="tabpanel" >
                                        @if(sizeof($faculty->students) < $faculty->seats )
                                            <div class="col-xs-12 m-y-2">
                                                <button type="submit" class="btn btn-primary btn-rounded add-student" data-toggle="modal" data-target=".small-modal" data-faculty-id="{{$faculty->id}}">Add Student</button>
                                            </div>
                                        @endif
                                        @foreach($faculty->students as $student)
                                        <div class="col-xs-11">
                                            <div class="media stream-item">
                                                <div class="media-left">
                                                    <div class="avatar box-48">
                                                        <img class="b-a-radius-circle" src="img/student.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">
                                                        <a class="text-black" href="#">{{$student->name}}</a>
                                                    </h6>
                                                    <span class="font-90 stream-meta capitalize">{{ ($student->getRoleNames())[0] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-1">
                                            <button type="button" class="btn btn-danger btn-square confirm" data-url="{{route("deleteStudent",["faculty" => $faculty->id, "user" => $student->id])}}">
                                                <i class="ti-trash"></i>
                                                Remove
                                            </button>
                                        </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <form action="{{route("addStudent")}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h5 class="modal-title" id="mySmallModalLabel">Add Student</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Student</label>
                            <div class="col-sm-10">
                                <select name="user_id" class="form-control w-100 " data-plugin='select2' data-placeholder="Select Student to add">
                                    @foreach($students as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="faculty_id" value="" id="faculty_id" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection
@section('extra_js')
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