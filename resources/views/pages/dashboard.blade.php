@extends('layouts.master')

@section('extra_css')@endsection

@section('content')
    <div class="row row-md">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 m-b-2">
                <div class="t-icon right"><span class="bg-danger"></span><i class="ti-shopping-cart-full"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase m-b-1">Students</h6>
                    <h1 class="m-b-1">{{\App\User::role('student')->count()}}</h1>
                    <span class="tag tag-danger m-r-0-5"><i class="ti-face-smile"></i></span>
                    <span class="text-muted font-90"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 m-b-2">
                <div class="t-icon right"><span class="bg-success"></span><i class="ti-bar-chart"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase m-b-1">Submissions</h6>
                    <h1 class="m-b-1">{{\App\Models\Submission::all()->count()}}</h1>
                    <i class="fa fa-caret-up text-success m-r-0-5 invisible"></i><span class="invisible">12,350</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 m-b-2">
                <div class="t-icon right"><span class="bg-primary"></span><i class="ti-package"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase m-b-1">Faculties</h6>
                    <h1 class="m-b-1">{{\App\Models\Faculty::all()->count()}}</h1>
                    <span class="tag tag-primary m-r-0-5 invisible"></span>
                    <span class="text-muted font-90 invisible">arraving today</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 m-b-2">
                <div class="t-icon right"><span class="bg-warning"></span><i class="ti-receipt"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase m-b-1">Current Academic Year</h6>
                    <h1 class="m-b-1">{{date("Y")}}</h1>
                    <div id="sparkline1"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-block bg-white">
        <div class="clearfix m-b-1">
            <h5 class="pull-xs-left">Submissions</h5>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class=" text-xs-center">
                    <div class=" p-b-1">

                        <div class="btn-group m-b-1 invisible">
                            <button type="button" class="btn btn-secondary active waves-effect waves-light">Week</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light">Month</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light">Year</button>
                        </div>
                        <div id="donut" class="chart-container demo-chart-2"></div>
                    </div>
                    <div class="box-block b-t">
                        <span class="text-muted">Total Uploads</span> <a class="text-primary" href="#"><span class="underline total-update"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 demo-progress">
                <?php
                    $classes = ['progress-success','progress-info','progress-warning','progress-danger'];
                ?>
                @foreach(\App\Models\Faculty::all() as $index => $faculty)
                    <p class="m-b-0-5 capitalize">{{$faculty->name}} <span class="pull-xs-right" id="{{$faculty->name}}-count">loading...</span></p>
                    <progress class="progress {{$classes[($index+1) % sizeof($classes)]}} progress-sm" value="0" max="100" id="{{$faculty->name}}-progress" >100%</progress>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("dialoges")
    <div class="modal fade" id="modal-thanks" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-center margin-bottom-20"><img src="assets/images/smile.png" alt="Thank you" style="width: 100px"></p><h3 id="modal-thanks-heading" class="text-uppercase text-bold text-lg heading-line-below heading-line-below-short text-center"></h3>
                    <p class="text-muted text-center margin-bottom-10">Thank you so much for likes</p>
                    <p class="text-muted text-center">We will do our best to make<br>Boooya template perfect</p>
                    <p class="text-center"><button class="btn btn-success btn-clean" data-dismiss="modal">Continue</button></p>
                </div>
            </div>
        </div>
    </div><!-- IMPORTANT SCRIPTS -->
@endsection
@section('extra_js')
    {{--<script type="text/javascript" src="js/index.js"></script>--}}
    <script>
        $(function () {
            $('#sparkline1').sparkline([0, 16, 30, 70, 30, 40, 67, 23, 44], {
                type: 'line',
                width: '60',
                height: '20',
                chartRangeMax: 50,
                lineColor: '#999',
                spotRadius: 2,
                fillColor: 'transparent',
                highlightLineColor: 'rgba(0,0,0,0.1)',
                highlightSpotColor: 'rgba(0,0,0,0.1)'
            });


        });
        //get reports
        $.get("/reports").done(function (resp) {
            var data = [];
            $.each(resp.faculty_total, function (facultyName, count) {
                $("#"+facultyName+"-progress").val(count).attr("max",resp.submission_total);
                $("#"+facultyName+"-count").text(count);
                data.push({
                    label: facultyName,
                    value: count,
                });
            });

            /* Morris Chart */
            Morris.Donut({
                element: 'donut',
                data: data,
                resize: true,
                colors:['#20b9ad', '#f59344', '#f44136', '#43b968' ]
            });
            $(".total-update").text(resp.submission_total);
        });


    </script>
@endsection