@extends('backEnd.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-lg-4 col-6">
                    <!-- small box -->

                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner" style="margin-bottom:15px;">
                            <h3>{{$data['user']??''}}</h3>
                            <p class="text-center" style="font-size:25px;">Users</p>
                            <p style="float:left;">Supplier: <b>{{$data['supplier']??''}}</b></p>
                            <p style="float:right;">Customer: <b>{{$data['customer']??''}}</b></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
