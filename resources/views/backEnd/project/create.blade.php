@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.VISA_ENTRY')</h1>
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
                            <h3 class="card-title">@lang('lang.CREATE_VISA')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        {!!Form::open(['route'=>'project.store','class'=>'form-horizontal','enctype' => 'multipart/form-data'])!!}
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.SUBMIT_AGENCY')</label>
                                        {!!Form::text('submit_agency',$target->account_no??'',['class'=>'form-control','placeholder'=>'Enter submit agency','id'=>'submit_agency'])!!}
                                        @if($errors->has('submit_agency'))
                                        <span class="text-danger">{{$errors->first('submit_agency')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.REF_AGENT')</label>
                                        {!!Form::text('ref_agent',$target->account_no??'',['class'=>'form-control','placeholder'=>'Enter ref agent','id'=>'ref_agent'])!!}
                                        @if($errors->has('ref_agent'))
                                        <span class="text-danger">{{$errors->first('ref_agent')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.OTHER_INFORMATION')</label>
                                        {!! Form::textarea('other_information', null, ['id' => 'other_information', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('other_information'))
                                        <span class="text-danger">{{$errors->first('other_information')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.NOTES')</label>
                                        {!! Form::textarea('note', null, ['id' => 'note', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('note'))
                                        <span class="text-danger">{{$errors->first('note')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

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
                                                <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="numbar">
                                                        <!--<td width='10%'><img id="blah0" class="img-thambnail" src="http://demo.kefuclav.com/assets/dist/img/products/product.png" alt="your image" height="70px" width="70px;"></td>-->
                                                        <td><input type="file" name="doc_name[]"></td>
                                                        <td><input type="text" name="title[]" value="" placeholder="Enter Caption" class="form-control"></td>
                                                        <td><input type="number" name="serial[]" value="1" class="form-control" required></td>
                                                        <td><input type="number" name="status[]" max="1" min="0" value="1" class="form-control" required></td>
                                                        <td><button type ="button" name="add" id="add" class="btn"><i class="fa fa-plus font-red"></i></button></td>
                                                    </tr>
                                                <tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{route('project.index')}}" class="btn btn-default ">Cancel</a>
                                <button type="submit" class="btn btn-info float-right">Save</button>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
        $('#passport_issue_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#passport_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#passport_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#visa_issue_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#visa_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#okala_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#medical_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#medical_card_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#medical_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#police_clearence_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#police_clearence_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#mofa_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#mofa_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#delivery_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#man_power_submit_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#man_power_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#document_sending_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#em_submit_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#stamping_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#stamping_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#training_card_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#finger_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#flying_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $(document).on('change', '#countryId', function () {
        var countryId = $(this).val();
        var typeId = $('#typeId').val();
        var year = $('#year').val();
        if (countryId != '' && typeId != '' && year != '') {
            $.ajax({
                url: "{{route('generateCusCode.create')}}",
                type: "post",
                data: {countryId: countryId, typeId: typeId, year: year},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#customerCode').val(data.data);
                }
            });
        } else {
            $('#customerCode').val('');
        }
    })
    $(document).on('change', '#typeId', function () {
        var typeId = $(this).val();
        var countryId = $('#countryId').val();
        var year = $('#year').val();
        if (countryId != '' && typeId != '' && year != '') {
            $.ajax({
                url: "{{route('generateCusCode.create')}}",
                type: "post",
                data: {countryId: countryId, typeId: typeId, year: year},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#customerCode').val(data.data);
                }
            });
        } else {
            $('#customerCode').val('');
        }
    })
    $(document).on('change', '#year', function () {
        var countryId = $('#countryId').val();
        var typeId = $('#typeId').val();
        var year = $(this).val();
        if (countryId != '' && typeId != '' && year != '') {
            $.ajax({
                url: "{{route('generateCusCode.create')}}",
                type: "post",
                data: {countryId: countryId, typeId: typeId, year: year},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#customerCode').val(data.data);
                }
            });
        } else {
            $('#customerCode').val('');
        }

    })

</script>
<script type="text/javascript">
    var i = 1;
    $(document).on('click', '#add', function () {
        i++;
        $('#dynamic_field').append('<tr id="row' + i + '">' +
                '<td><input type="file" name="doc_name[]"></td>' +
                '<td><input type="text" name="title[]" placeholder="Enter Caption" value="" class="form-control"></td>' +
                '<td><input type="number" name="serial[]" value="' + i + '" class="form-control" required></td>' +
                '<td><input type="number" name="status[]" max="1" min="0" value="1" class="form-control" required></td>' +
                '<td><button type ="button" name="remove" id="' + i + '" class="btn  btn_remove"><i class="fa fa-times font-red"></i></button></td>' +
                '</tr>')
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $(document).on('click', '#addBN', function () {
        $(this).addClass("active");
        $('#addEng').removeClass("active");
    });
    $(document).on('click', '#addEng', function () {
        $(this).addClass("active");
        $('#addBN').removeClass("active");
    });

</script>
@endpush


