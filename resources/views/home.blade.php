@extends('layouts.app')

@section('content')
    <section class="content">
      {{--   <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">No of trainings</span>
                        <span class="info-box-number">{{$total_training}}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Partipants</span>
                        <span class="info-box-number">{{$total_parts}}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-people"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Participants registered this month</span>
                        <span class="info-box-number">2</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New participants</span>
                        <span class="info-box-number">3</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
 --}}
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-active">
                    <div class="inner">
                        <h3>
                            {{$total_training}}
                        </h3>
                        <p>
                          Total Trainings this quarter
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-cart-outline"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        view all Trainings <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            {{$mentorship->count()}}
                        </h3>
                        <p>
                           Total Mentorships this quarter
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-pricetag-outline"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            {{$total_training}}
                       
                        </h3>
                        <p>
                           Total trainings this year
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion icon-eye-open"></i>
                    </div>
                    <a href="" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple-gradient">
                    <div class="inner">
                        <h3>
                            {{$mentorship->count()}}
                        </h3>
                        <p>
                           Total Mentorships This year
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-alarm-outline"></i>
                    </div>
                    <a href="" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Analysis</h3>
                    </div>
                    <div class="box-body">
                        {!! Charts::styles() !!}

                        <div class="app">
                            <center>
                                {!! $chart3->html() !!}
                            </center>
                        </div>
                        <!-- End Of Main Application -->
                        {!! Charts::scripts() !!}
                        {!! $chart3->script() !!}
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Analysis</h3>
                    </div>
                    <div class="box-body">
                        {!! Charts::styles() !!}

                        <div class="app">
                            <center>
                                {!! $mentortorchip_chart->html() !!}
                            </center>
                        </div>
                        <!-- End Of Main Application -->
                        {!! Charts::scripts() !!}
                        {!! $mentortorchip_chart->script() !!}
                    </div><!-- /.box-body -->
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Analysis</h3>
                    </div>
                    <div class="box-body">
                        {!! Charts::styles() !!}

                        <div class="app">
                            <center>
                                {!! $chart4->html() !!}
                            </center>
                        </div>
                        <!-- End Of Main Application -->
                        {!! Charts::scripts() !!}
                        {!! $chart4->script() !!}
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Analysis</h3>
                    </div>
                    <div class="box-body">
                        {!! Charts::styles() !!}

                        <div class="app">
                            <center>
                                {!! $training_chart->html() !!}
                            </center>
                        </div>
                        <!-- End Of Main Application -->
                        {!! Charts::scripts() !!}
                        {!! $training_chart->script() !!}
                    </div><!-- /.box-body -->
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Analysis</h3>
                    </div>
                    <div class="box-body">
                        {!! Charts::styles() !!}

                        <div class="app">
                            <center>
                                {!! $participant_chart->html() !!}
                            </center>
                        </div>
                        <!-- End Of Main Application -->
                        {!! Charts::scripts() !!}
                        {!! $participant_chart->script() !!}
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Analysis</h3>
                    </div>
                    <div class="box-body">
                        {!! Charts::styles() !!}

                        <div class="app">
                            <center>
                                {!! $participant_sex->html() !!}
                            </center>
                        </div>
                        <!-- End Of Main Application -->
                        {!! Charts::scripts() !!}
                        {!! $participant_sex->script() !!}
                    </div><!-- /.box-body -->
                </div>
            </div>

        </div>

        {{-- <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Training Report</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <div class="btn-group">
                                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Trainings: 1 Jan, 2019 - 30 Jul, 2019</strong>
                                </p>
                                <div class="chart-responsive">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" height="180"></canvas>
                                </div><!-- /.chart-responsive -->
                            </div><!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>No of Participants</strong>
                                </p>
                                <div class="progress-group">
                                    <span class="progress-text">Kasese District</span>
                                    <span class="progress-number"><b>3</b>/8</span>
                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                    </div>
                                </div><!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Kyenjojo District</span>
                                    <span class="progress-number"><b>2</b>/8</span>
                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                                    </div>
                                </div><!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Bunyangabu District</span>
                                    <span class="progress-number"><b>2</b>/8</span>
                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                                    </div>
                                </div><!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Kyenjonjo District</span>
                                    <span class="progress-number"><b>2</b>/8</span>
                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                                    </div>
                                </div><!-- /.progress-group -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div><!-- /.description-block -->
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- / --}}.row -->

        

        <!-- Main row -->
      {{--   <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- MAP & BOX PANE -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Visitors Report</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-md-9 col-sm-8">
                                <div class="pad">
                                    <!-- Map will be created here -->
                                    <div id="world-map-markers" style="height: 325px;"></div>
                                </div>
                            </div><!-- /.col -->
                            <div class="col-md-3 col-sm-4">
                                <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                    <div class="description-block margin-bottom">
                                        <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                                        <h5 class="description-header">8390</h5>
                                        <span class="description-text">Visits</span>
                                    </div><!-- /.description-block -->
                                    <div class="description-block margin-bottom">
                                        <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                        <h5 class="description-header">30%</h5>
                                        <span class="description-text">Referrals</span>
                                    </div><!-- /.description-block -->
                                    <div class="description-block">
                                        <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                        <h5 class="description-header">70%</h5>
                                        <span class="description-text">Organic</span>
                                    </div><!-- /.description-block -->
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div><!-- /.col -->

            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"></span>
                        <span class="info-box-number"></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                    50% Increase in 30 Days
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Mentions</span>
                        <span class="info-box-number">92,050</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 20%"></div>
                        </div>
                        <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Downloads</span>
                        <span class="info-box-number">114,381</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Direct Messages</span>
                        <span class="info-box-number">163,921</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 40%"></div>
                        </div>
                        <span class="progress-description">
                    40% Increase in 30 Days
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
 --}}
      

       {{--  <div class="row">
            <div class="col-md-8">
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Orders</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Popularity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-info">Processing</span></td>
                                    <td><div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                        <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-4">
                <!-- PRODUCT LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recently Added Products</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <li class="item">
                                <div class="product-img">
                                    <img src="http://placehold.it/50x50/d2d6de/ffffff" alt="Product Image"/>
                                </div>
                                <div class="product-info">
                                    <a href="javascript::;" class="product-title">Samsung TV <span class="label label-warning pull-right">$1800</span></a>
                                    <span class="product-description">
                          Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span>
                                </div>
                            </li><!-- /.item -->
                            <li class="item">
                                <div class="product-img">
                                    <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                                </div>
                                <div class="product-info">
                                    <a href="javascript::;" class="product-title">Bicycle <span class="label label-info pull-right">$700</span></a>
                                    <span class="product-description">
                          26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                        </span>
                                </div>
                            </li><!-- /.item -->
                            <li class="item">
                                <div class="product-img">
                                    <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                                </div>
                                <div class="product-info">
                                    <a href="javascript::;" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                                    <span class="product-description">
                          Xbox One Console Bundle with Halo Master Chief Collection.
                        </span>
                                </div>
                            </li><!-- /.item -->
                            <li class="item">
                                <div class="product-img">
                                    <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                                </div>
                                <div class="product-info">
                                    <a href="javascript::;" class="product-title">PlayStation 4 <span class="label label-success pull-right">$399</span></a>
                                    <span class="product-description">
                          PlayStation 4 500GB Console (PS4)
                        </span>
                                </div>
                            </li><!-- /.item -->
                        </ul>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="javascript::;" class="uppercase">View All Products</a>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
 --}}
    </section><!-
@endsection
