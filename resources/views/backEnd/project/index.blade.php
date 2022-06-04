@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.PROJECT_LIST')</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right mr-2">
                        <a href="{{route('project.create')}}" class="btn btn-success"  title="@lang('lang.CREATE_VISA')"><i class="fa fa-plus-square"></i> @lang('lang.CREATE_PROJECT')</a>
                    </div>
                </div>
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>'project.filter','method'=>'GET'])!!}
            <input type="hidden" name='filter' value="true">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">

                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.TEXT'):</label>
                                {!!Form::text('search_value',Request::get('search_value'),['class'=>'form-control','id'=>'search_value','width'=>'100%','placeholder'=>'Enter search keywords']) !!}
                                @if($errors->has('search_value'))
                                <span class="text-danger">{{$errors->first('search_value')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label></label>
                                <div class="input-group">
                                    <div class="float-right mt-2">
                                        <button type="submit" class="btn btn-warning" title="submit" ><i class="fa fa fa-search"></i> @lang('lang.SUBMIT')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.PROJECT_LIST')</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body" id="tableData">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.PROJECT_NAME')</th>
                                        <th>@lang('lang.DESCRIPTION')</th>
                                        <th>@lang('lang.GIT_LINK')</th>
                                        <th>@lang('lang.LIVE_LINK')</th>
                                        <th>@lang('lang.CREATED_AT')</th>
                                        <th>@lang('lang.ACTION')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($targets->isNotEmpty())
                                    <?php $i = 0; ?>
                                    @foreach($targets as $target)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$target->project_name}}</td>
                                        <td>{!!Str::limit($target->details,60) !!}</td>
                                        <td>{{$target->git_link}}</td>
                                        <td>{{$target->live_link}}</td>
                                        <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        <td width="20%">
                                            <div style="float: left;margin-right:4px;">
                                                <a class="btn btn-success btn-sm" title="@lang('lang.VIEW_VISA')" href="{{route('project.view',$target->id)}}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-warning btn-sm"  title="@lang('lang.EDIT_VISA')" href="{{route('project.edit',$target->id)}}"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <div style="float: left;">
                                                {!!Form::open(['route'=>['project.destroy',$target->id]])!!}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm deleteBtn" title="@lang('lang.DELETE_VISA')"><i class="fa fa-trash"></i></button>
                                                {!!Form::close()!!}
                                            </div>  
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>No Data Found</tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {!!$targets->links('pagination::bootstrap-4')!!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection


