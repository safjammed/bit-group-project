@extends('layouts.master')

@section('extra_css')@endsection

@section('content')
    <div class="row row-md">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 m-b-2">
                <div class="t-icon right"><span class="bg-danger"></span><i class="ti-shopping-cart-full"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase m-b-1">Orders</h6>
                    <h1 class="m-b-1">1,325</h1>
                    <span class="tag tag-danger m-r-0-5">+17%</span>
                    <span class="text-muted font-90">from previous period</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 m-b-2">
                <div class="t-icon right"><span class="bg-success"></span><i class="ti-bar-chart"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase m-b-1">Revenue</h6>
                    <h1 class="m-b-1">$ 47,855</h1>
                    <i class="fa fa-caret-up text-success m-r-0-5"></i><span>12,350</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 m-b-2">
                <div class="t-icon right"><span class="bg-primary"></span><i class="ti-package"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase m-b-1">Products</h6>
                    <h1 class="m-b-1">6,800</h1>
                    <span class="tag tag-primary m-r-0-5">+125</span>
                    <span class="text-muted font-90">arraving today</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 m-b-2">
                <div class="t-icon right"><span class="bg-warning"></span><i class="ti-receipt"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase m-b-1">Sold</h6>
                    <h1 class="m-b-1">1,682</h1>
                    <div id="sparkline1"></div>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#">Activity</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Projects monitor</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted" href="#">Memory usage</a>
        </li>
    </ul>
    <div class="box box-block bg-white b-t-0 m-b-2">
        <div class="text-muted m-b-1">Calculated in last 10 days</div>
        <div class="chart-container demo-chart">
            <div id="main-chart" class="chart-placeholder"></div>
        </div>
    </div>
    <div class="row row-md m-b-2">
        <div class="col-md-4">
            <div class="box bg-white text-xs-center">
                <div class="box-block p-b-1">
                    <h5 class="m-b-2">Open projects</h5>
                    <div class="btn-group m-b-1">
                        <button type="button" class="btn btn-secondary active waves-effect waves-light">Week</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light">Month</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light">Year</button>
                    </div>
                    <div id="donut" class="chart-container demo-chart-2"></div>
                </div>
                <div class="box-block b-t">
                    <span class="text-muted">last contract signed</span> <a class="text-primary" href="#"><span class="underline">today at 14:57</span></a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box bg-white">
                <table class="table table-grey-head m-md-b-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Project</th>
                        <th>Last update</th>
                        <th>Progress</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Jonathan Mel</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">First project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">5 minutes ago</span>
                        </td>
                        <td>
                            <progress class="progress progress-success progress-sm d-inline-block m-b-0" value="44" max="100">100%</progress>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Larry Hal</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">Second project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">3 days ago</span>
                        </td>
                        <td>
                            <progress class="progress progress-danger progress-sm d-inline-block m-b-0" value="75" max="100">100%</progress>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Ron Carran</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">Third project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">Last monday</span>
                        </td>
                        <td>
                            <progress class="progress progress-warning progress-sm d-inline-block m-b-0" value="20" max="100">100%</progress>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Carleton Josiah</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">Another project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">5 minutes ago</span>
                        </td>
                        <td>
                            <progress class="progress progress-primary progress-sm d-inline-block m-b-0" value="10" max="100">100%</progress>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Wolfe Stevie</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">Old project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">3 days ago</span>
                        </td>
                        <td>
                            <progress class="progress progress-info progress-sm d-inline-block m-b-0" value="90" max="100">100%</progress>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Vance Osborn</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">Important project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">Last monday</span>
                        </td>
                        <td>
                            <progress class="progress progress-warning progress-sm d-inline-block m-b-0" value="35" max="100">100%</progress>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>Jonathan Mel</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">First project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">5 minutes ago</span>
                        </td>
                        <td>
                            <progress class="progress progress-success progress-sm d-inline-block m-b-0" value="44" max="100">100%</progress>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>Larry Hal</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">Second project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">3 days ago</span>
                        </td>
                        <td>
                            <progress class="progress progress-danger progress-sm d-inline-block m-b-0" value="75" max="100">100%</progress>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">9</th>
                        <td>Ron Carran</td>
                        <td>
                            <a class="text-primary" href="#"><span class="underline">Third project</span></a>
                        </td>
                        <td>
                            <span class="text-muted">Last monday</span>
                        </td>
                        <td>
                            <progress class="progress progress-warning progress-sm d-inline-block m-b-0" value="20" max="100">100%</progress>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-block bg-white">
        <div class="clearfix m-b-1">
            <h5 class="pull-xs-left">Sales statistics</h5>
            <div class="pull-xs-right">
                <button class="btn btn-link btn-sm text-muted" type="button"><i class="ti-angle-down"></i></button>
                <button class="btn btn-link btn-sm text-muted" type="button"><i class="ti-reload"></i></button>
                <button class="btn btn-link btn-sm text-muted" type="button"><i class="ti-close"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div id="world" style="height: 400px;"></div>
            </div>
            <div class="col-md-4 demo-progress">
                <p class="m-b-0-5">New York City <span class="pull-xs-right">25%</span></p>
                <progress class="progress progress-success progress-sm" value="25" max="100">100%</progress>
                <p class="m-b-0-5">Singapore <span class="pull-xs-right">15%</span></p>
                <progress class="progress progress-info progress-sm" value="15" max="100">100%</progress>
                <p class="m-b-0-5">Tokyo <span class="pull-xs-right">30%</span></p>
                <progress class="progress progress-warning progress-sm m-b-2" value="30" max="100">100%</progress>
                <p class="m-b-0-5">Hong Kong <span class="pull-xs-right">5%</span></p>
                <progress class="progress progress-danger progress-sm m-b-2" value="5" max="100">100%</progress>
                <a class="btn btn-outline-primary" href="#">Detail statistics</a>
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
    <script type="text/javascript" src="js/index.js"></script>
@endsection