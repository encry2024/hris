@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.admin-sidebar')
        <div class="col-lg-10 col-md-9 col-lg-offset-1-1">
            <div class="main">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-1 panel-trans">
                                <div class="panel-heading-1">
                                    <h4><i class="fa fa-users"></i>&nbsp;&nbsp;Manage Users</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pull-right">
                                <a style="cursor: pointer;" class="btn btn-success" data-toggle="modal" data-target="#import-applicant-data-modal"><i class="fa fa-download"></i>&nbsp;&nbsp;Import Applicant Data</a>
                            </div>
                        </div>
                    </div>

                    <br>

                    {{--<div class="row">
                        <div class="col-lg-12">
                            <div class="pull-right">
                                <a href="{{ route('admin_user_create') }}" class="btn btn-success"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Add</a>
                            </div>
                        </div>
                    </div>--}}

                    <div class="row">
                        @if(Session::has('msg'))
                            <div class="col-lg-12">
                                <div class="alert alert-info" role="alert" style="font-size: 14px;">
                                    <i class="fa fa-info-circle"></i> {{ Session::get('msg') }}
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-12">
                            <ul class="nav nav-tabs" role="tablist" style="background-color: white;">
                                <li role="presentation">
                                    <a href="{{ route('admin_user_index') }}">Employees</a>
                                </li>
                                <li role="presentation" class="active">
                                    <a href="{{ route('admin_user_applicant_index') }}" >Applicant</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" style="background-color: white;padding: 20px;border: #ddd solid 1px;">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead style="background-color: #eeeeee; border: #ccc solid 1px;">
                                                        <th><input type="checkbox"></th>
                                                        <th>Applicant ID#</th>
                                                        <th>First Name</th>
                                                        <th>Middle Name/Initial</th>
                                                        <th>Last Name</th>
                                                        <th>E-mail</th>
                                                        <th></th>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($applicants as $applicant)
                                                        <tr style="font-weight: bold;">
                                                            <td><input type="checkbox"></td>
                                                            <td>{{ $applicant->id }}</td>
                                                            <td>{{ $applicant->first_name }}</td>
                                                            <td>{{ $applicant->middle_initial }}</td>
                                                            <td>{{ $applicant->last_name }}</td>
                                                            <td>{{ $applicant->email }}</td>
                                                            {{-- <td>{{ date('F d, Y h:i A', strtotime($applicant->created_at)) }}</td> --}}
                                                            <td><a href="{{ route('admin_user_applicant_show', $applicant->id) }}" class="btn btn-xs btn-info"><i class="fa fa-search"></i></a></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="import-applicant-data-modal">
        <form class="form-horizontal" action="{{ route('admin.import.applicant.data') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Import Applicant Data</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="import-field" class="control-label col-lg-4">Applicant Data</label>
                            <div class="col-lg-6">
                                <input name="import_field" id="import-field" type="file" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
   </div><!-- /.modal -->
@endsection
