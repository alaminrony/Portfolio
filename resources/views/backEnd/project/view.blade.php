@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.VISA')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.VIEW_VISA')</h3>
                            <div class="float-right">
                                <a href="{{url('admin/visa-entry/'.$target->id.'/view?view=print')}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/visa-entry/'.$target->id.'/view?view=pdf')}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>
                                <a href="{{url('admin/visa-entry/'.$target->id.'/view?view=excel')}}" class="btn btn-success"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <table class="table table-bordered" id='Target'>
                                    <tbody>

                                        <tr>
                                            <td><strong>@lang('lang.PROJECT_NAME')</strong> </td>
                                            <td>{{$target->name}}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>@lang('lang.DESCRIPTION')</strong> </td>
                                            <td>{!!$target->details !!}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.GIT_LINK')</strong> </td>
                                            <td>{{$target->git_link}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.LIVE_LINK')</strong> </td>
                                            <td>{{$target->live_link}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.SERIAL')</strong> </td>
                                            <td>{{$target->serial}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.PUBLISHED')</strong> </td>
                                            <td>{{$target->published_status == '1' ? "Yes" : "No"}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.CREATED_AT')</strong> </td>
                                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <h4 style="text-align: center;margin-top: 0px;">Document Management</h4>
                                        <div class = "form-group">
                                            <div class ="table-responsive">
                                                <table class ="table table-bordered" id="dynamic_field">
                                                    <thead>
                                                    <th>File</th>
                                                    <th>Caption</th>
                                                    <th>Serial</th>
                                                    <th>Status</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $files = $target->attachments;
                                                        $totalFile = count($files);
                                                        ?>
                                                        @if($totalFile > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach($files as $file)
                                                        <?php
                                                        $i++;
                                                        $fileExt = explode('.', $file->doc_name);
                                                        ?>
                                                        <tr class="numbar">
                                                            @if(!empty($file->doc_name) && end($fileExt) == 'pdf')
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/pdf.png')}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @elseif(!empty($file->doc_name) && end($fileExt) == 'doc')
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/doc.png')}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @else
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah{{$i-1}}" class="img-thambnail" src="{{asset($file->doc_name)}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @endif
                                                            <td>{{$file->title}}</td>
                                                            <td>{{$file->serial}}</td>
                                                            @if($file->status == '1')
                                                            <td><button  class="btn btn-success">Active</button></td>
                                                            @else
                                                            <td><button  class="btn btn-danger">Inactive</button></td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a type="button" href="#" onclick="window.history.back()" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

