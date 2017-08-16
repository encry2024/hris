@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.admin-sidebar')
        <div class="col-lg-10 col-md-9 col-lg-offset-1-1">

            <div class="main">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('admin_user_applicant_index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a>
                            <div class="dropdown pull-right" >
                                <a class="btn btn-default-action dropdown-toggle" style="text-shadow: none !important;" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Actions <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu" style="margin-top: 0.55rem; margin-right: -4rem;">
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#HireApplicantModal"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;Hire Applicant</a></li>
                                    <li><a href="{{ route('admin_applicant_edit', $applicant->id) }}"><i class="fa fa-edit"></i>&nbsp;Edit Information</a></li>
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#UploadResumeModal"><i class="fa fa-upload"></i>&nbsp;Upload Resume</a></li>
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#AddCommentModal"><i class="fa fa-ban"></i>&nbsp;Cancel Application</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-1 panel-trans">
                                <div class="panel-heading-1">
                                    <h4><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $applicant->fullName() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="{{ route('view_interview', $applicant->id) }}" class="btn btn-primary">View Initial Interview Question</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--<div class="row">
                        <div class="col-lg-12">
                            <div class="pull-right">
                                <a href="{{ route('admin_user_create') }}" class="btn btn-success"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Add</a>
                                <a href="" class="btn btn-danger"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;Delete</a>
                            </div>
                        </div>
                    </div>--}}

                    <div class="row">
                       <div class="col-lg-3">
                           <form action="" class="form-horizontal">
                              <div class="form-group">
                                   <div class="col-md-8">
                                       <div class="thumbnail" style="border-radius: 0px;">
                                           <img src="{{ URL::to('/') }}/{{ $applicant->photo_dir }}" alt="..." id="output" style="width: 160px; height: 150px;">
                                       </div>
                                   </div>
                              </div>
                           </form>
                       </div>
                        <div class="col-lg-9">
                            <ul class="nav nav-tabs" role="tablist" style="background-color: white;">
                                <li role="presentation" class="active"><a href="#information" aria-controls="information" role="tab" data-toggle="tab">Profile</a></li>
                                <li role="presentation"><a href="#interview_status" aria-controls="interview_status" role="tab" data-toggle="tab">Prequalification Status</a></li>
                                <li role="presentation"><a href="#job_information" aria-controls="job_information" role="tab" data-toggle="tab">Job Information</a></li>
                                <li role="presentation"><a href="#other_details" aria-controls="other_details" role="tab" data-toggle="tab">Other Details</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" style="background-color: white;padding: 20px;border: #ddd solid 1px;">
                                <div role="tabpanel" class="tab-pane fade in active" id="information">
                                    <div class="row">
                                        <div class="col-lg-offset-1">

                                            <div class="col-lg-6">
                                                <form class="form-horizontal">

                                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                        <label for="first_name" class="col-md-5 control-label">First Name:</label>

                                                        <div class="col-md-7">
                                                            <input style="width: 400px; resize: none;" id="first_name" class="form-control" value="{{ $applicant->first_name }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('middle_initial') ? ' has-error' : '' }}">
                                                        <label for="middle_initial" class="col-md-5 control-label">Middle Initial:</label>

                                                        <div class="col-md-7">
                                                            <input style="width: 400px; resize: none;" id="middle_initial" class="form-control" value="{{ $applicant->middle_initial }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                        <label for="last_name" class="col-md-5 control-label">Last Name:</label>

                                                        <div class="col-md-7">
                                                            <input style="width: 400px; resize: none;" id="last_name" class="form-control" value="{{ $applicant->last_name }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                                                        <label for="date_of_birth" class="col-md-5 control-label">Date of Birth:</label>

                                                        <div class="col-md-7">
                                                            <input style="width: 400px; resize: none;" id="date_of_birth" class="form-control" value="{{ date('F d, Y', strtotime($applicant->date_of_birth)) }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="age" class="col-md-5 control-label">Age:</label>

                                                        <div class="col-md-7">
                                                            <input style="width: 400px; resize: none;" id="age" class="form-control" value="{{ $applicant->age }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label for="email" class="col-md-5 control-label">E-mail:</label>

                                                        <div class="col-md-7">
                                                            <input style="width: 400px; resize: none;" id="email" class="form-control" value="{{ $applicant->email }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                                                        <label for="mobile_number" class="col-md-5 control-label">Mobile Number:</label>

                                                        <div class="col-md-7">
                                                            <input style="width: 400px; resize: none;" id="mobile_number" class="form-control" value="{{ $applicant->mobile_number }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('home_number') ? ' has-error' : '' }}">
                                                        <label for="home_number" class="col-md-5 control-label">Home Number:</label>

                                                        <div class="col-md-7">
                                                            <input style="width: 400px; resize: none;" id="home_number" class="form-control" value="{{ $applicant->home_number }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                        <label for="address" class="col-md-5 control-label">Address:</label>

                                                        <div class="col-md-7">
                                                            <textarea id="address" class="form-control" style="width: 400px; resize: none;" disabled>{{ $applicant->address }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                       <hr>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('sss') ? ' has-error' : '' }}">
                                                      <label for="sss" class="col-md-5 control-label">SSS:</label>

                                                      <div class="col-md-6">
                                                         <input style="width: 400px;" id="sss" class="form-control" disabled   value="{{ $applicant->sss }}">
                                                      </div>
                                                   </div>

                                                   <div class="form-group{{ $errors->has('philhealth') ? ' has-error' : '' }}">
                                                      <label for="philhealth" class="col-md-5 control-label">Phil Health:</label>

                                                      <div class="col-md-6">
                                                         <input style="width: 400px;" id="philhealth" class="form-control" disabled  value="{{ $applicant->philhealth }}">
                                                      </div>
                                                   </div>

                                                   <div class="form-group{{ $errors->has('pag_ibig') ? ' has-error' : '' }}">
                                                      <label for="pag_ibig" class="col-md-5 control-label">Pag-ibig:</label>

                                                      <div class="col-md-6">
                                                         <input style="width: 400px;" id="pag_ibig" class="form-control" disabled value="{{ $applicant->pag_ibig }}">
                                                      </div>
                                                   </div>

                                                   <div class="form-group{{ $errors->has('nbi_clearance') ? ' has-error' : '' }}">
                                                       <label for="nbi_clearance" class="col-md-5 control-label">NBI Clearance:</label>

                                                       <div class="col-md-6">
                                                           <input style="width: 400px;" id="nbi_clearance" class="form-control" disabled value="{{ $applicant->nbi_clearance }}">
                                                       </div>
                                                   </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="interview_status">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label for="initial_interview" class="col-md-4 control-label">Initial Interview:</label>

                                                    <div class="col-md-6">
                                                        <button type="button" id="initial_interview" class="btn btn-sm btn-@if($applicant->initial_interview == 0)danger @elseif($applicant->initial_interview == 1)warning @elseif($applicant->initial_interview == 2)success @endif
                                                        "
                                                        data-toggle="modal" data-target="#ModalPassInitialInterviewApplicant">{{ $applicant->initialInterviewStatus() }}</button>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exam_interview" class="col-md-4 control-label">Exam Interview:</label>

                                                    <div class="col-md-6">
                                                        <button type="button" data-toggle="modal" data-target="#ModalPassExamInterviewApplicant" id="exam_interview" class="btn btn-sm btn-@if($applicant->exam_interview == 0)danger @elseif($applicant->exam_interview == 1)warning @elseif($applicant->exam_interview == 2)success @endif">{{ $applicant->examInterviewStatus() }}</button>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="final_interview" class="col-md-4 control-label">Final Interview:</label>

                                                    <div class="col-md-6">
                                                        <button id="final_interview" class="btn btn-sm btn-@if($applicant->final_interview == 0)danger @elseif($applicant->final_interview == 1)warning @elseif($applicant->final_interview == 2)success @endif">{{ $applicant->finalInterviewStatus() }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="other_details">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label for="InformationLastUpdate" class="col-md-4 control-label">Profile Last Update:</label>

                                                    <div class="col-md-8">
                                                        <input style="width: 400px; text-align: left;" id="InformationLastUpdate" class="form-control" value="{{ date('F d, Y h:i A', strtotime($applicant->updated_at)) }}" disabled>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="job_information">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label for="job_position" class="col-md-4 control-label">Expected Salary:</label>

                                                    <div class="col-md-6">
                                                        <label id="job_position" class="control-label">PHP {{ $applicant->expected_salary }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="job_position" class="col-md-4 control-label">Job Position:</label>

                                                    <div class="col-md-6">
                                                        <label id="job_position" class="control-label">{{ $applicant->job_position }}</label>
                                                    </div>
                                                </div>
                                            </form>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="HireApplicantModal">
        <form action="{{ route('admin_hire_applicant', $applicant->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Are you sure you want to hire this Applicant?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to hire this Applicant?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i> Hire</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="ModalPassInitialInterviewApplicant">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pass Initial Interview</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to update this applicant's Initial Interview status. Continue?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i> FAIL</button>
                    <button class="btn btn-success" onclick="document.getElementById('passInitialInterviewForm').submit();">
                    <i class="fa fa-thumbs-o-up"></i> PASS</button>

                    <form action="{{ route('admin_pass_initial_applicant', $applicant->id) }}" method="POST" id="passInitialInterviewForm">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="ModalPassExamInterviewApplicant">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pass Examination</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to update this applicant's Examination status to pass. Continue?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i> FAIL</button>
                    <button class="btn btn-success" onclick="document.getElementById('passExaminationInterviewForm').submit();">
                    <i class="fa fa-thumbs-o-up"></i> PASS</button>

                    <form action="{{ route('admin_pass_examination_applicant', $applicant->id) }}" method="POST" id="passExaminationInterviewForm">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
