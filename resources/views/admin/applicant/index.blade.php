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

                    {{--<div class="row">
                        <div class="col-lg-12">
                            <div class="pull-right">
                                <a href="{{ route('admin_user_create') }}" class="btn btn-success"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Add</a>
                            </div>
                        </div>
                    </div>--}}

                    <div class="row">
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
@endsection
