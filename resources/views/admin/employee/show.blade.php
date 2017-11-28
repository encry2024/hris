@extends('layouts.app')

@section('content')
   <div class="row">
      @include('layouts.admin-sidebar')
      <div class="col-lg-10 col-md-9 col-lg-offset-1-1">

         <div class="main">
            <div class="col-lg-12">
               <div class="row">
                  <div class="col-lg-12">
                     <a href="{{ route('admin_user_index') }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a>
                     <div class="dropdown pull-right">
                        <a class="btn btn-default-action dropdown-toggle" style="text-shadow: none !important;" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Actions <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu" style="margin-top: 0.55rem; margin-right: -4rem;">
                           <li><a href="{{ route('admin_user_employee_edit', $employee->id) }}"><i class="fa fa-edit"></i>&nbsp;Edit Information</a></li>
                           <li><a style="cursor: pointer;" data-toggle="modal" data-target="#EmployeeCreateTrainingModal"><i class="fa fa-plus"></i>&nbsp;Add Training</a></li>
                           <li><a style="cursor: pointer;" data-toggle="modal" data-target="#ChangeLeaveRemainingModal"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;Update Leaves</a></li>
                           <li><a style="cursor: pointer;" data-toggle="modal" data-target="#FileVacationLeaveModal"><i class="fa fa-plane" aria-hidden="true"></i>&nbsp;File Vacation Leave</a></li>
                           <li><a href="javascript:void(0)" data-toggle="modal" data-target="#UploadResumeModal"><i class="fa fa-stethoscope" aria-hidden="true"></i>&nbsp;File Sick Leave</a></li>
                           <li><a style="cursor: pointer;" data-toggle="modal" data-target="#UploadResumeModal"><i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;Emergency Leave</a></li>
                        </ul>

                     </div>
                  </div>
               </div>

               <br>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="panel-1 panel-trans">
                        <div class="panel-heading-1">
                           <h4><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $employee->applicant->fullName() }}</h4>
                        </div>
                     </div>
                  </div>

                  @if(Session::has('msg'))
                  <div class="col-lg-12">
                     <div class="alert alert-info" role="alert">
                        {{ Session::get('msg') }}
                     </div>
                  </div>
                  @endif
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
                                 <img src="{{ URL::to('/') }}/{{ $employee->applicant->photo_dir }}" alt="..." id="output" style="width: 160px; height: 150px;">
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>

                  <div class="col-lg-9">
                     <ul class="nav nav-tabs" role="tablist" style="background-color: white;">
                        <li role="presentation" class="active"><a href="#profile" aria-controls="information" role="tab" data-toggle="tab">Employee Information</a></li>
                        <li role="presentation"><a href="#information" aria-controls="information" role="tab" data-toggle="tab">Personal Information</a></li>
                        <li role="presentation"><a href="#leave_counts" aria-controls="leave_counts" role="tab" data-toggle="tab">Leave Counts</a></li>
                        <li role="presentation"><a href="#job_information" aria-controls="job_information" role="tab" data-toggle="tab">Job Information</a></li>
                        <li role="presentation"><a href="#other_details" aria-controls="other_details" role="tab" data-toggle="tab">Other Details</a></li>
                     </ul>

                     <!-- Tab panes -->
                     <div class="tab-content" style="background-color: white;padding: 20px;border: #ddd solid 1px;">
                        <div role="tabpanel" class="tab-pane fade in active" id="profile">
                           <div class="row">
                              <div class="col-lg-offset-1">

                                 <div class="col-lg-6">
                                    <form class="form-horizontal">

                                       <div class="row">
                                          <fieldset disabled>
                                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                             <label for="email" class="col-md-5 control-label">Company E-mail:</label>

                                             <div class="col-md-6">
                                                <input style="width: 400px;" id="email" class="form-control" value="{{ $employee->email }}">
                                             </div>
                                          </div>

                                          <div class="form-group{{ $errors->has('Position') ? ' has-error' : '' }}">
                                             <label for="Position" class="col-md-5 control-label">Position:</label>

                                             <div class="col-md-6">
                                                <input style="width: 400px;" id="Position" class="form-control" value="{{ $employee->applicant->job_position }}">
                                             </div>
                                          </div>

                                          <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                                             <label for="salary" class="col-md-5 control-label">Salary:</label>

                                             <div class="col-md-6">
                                                <div class="input-group">
                                                   <div class="input-group-addon">PHP</div>
                                                   <input style="width: 347px;" id="salary" class="form-control" value="{{ $employee->applicant->expected_salary }}">
                                                </div>
                                             </div>
                                          </div>

                                          <div class="form-group{{ $errors->has('sss') ? ' has-error' : '' }}">
                                             <label for="sss" class="col-md-5 control-label">SSS:</label>

                                             <div class="col-md-6">
                                                <input style="width: 400px;" id="sss" class="form-control" value="{{ $employee->sss == "" ? $employee->applicant->sss : $employee->sss }}">
                                             </div>
                                          </div>

                                          <div class="form-group{{ $errors->has('philhealth') ? ' has-error' : '' }}">
                                             <label for="philhealth" class="col-md-5 control-label">Phil Health:</label>

                                             <div class="col-md-6">
                                                <input style="width: 400px;" id="philhealth" class="form-control" value="{{ $employee->philhealth == "" ? $employee->applicant->philhealth : $employee->philhealth }}">
                                             </div>
                                          </div>

                                          <div class="form-group{{ $errors->has('pag_ibig') ? ' has-error' : '' }}">
                                             <label for="pag_ibig" class="col-md-5 control-label">Pag-ibig:</label>

                                             <div class="col-md-6">
                                                <input style="width: 400px;" id="pag_ibig" class="form-control" value="{{ $employee->pag_ibig == "" ? $employee->applicant->pag_ibig : $employee->pag_ibig }}">
                                             </div>
                                          </div>

                                          <div class="form-group{{ $errors->has('nbi_clearance') ? ' has-error' : '' }}">
                                             <label for="nbi_clearance" class="col-md-5 control-label">NBI Clearance:</label>

                                             <div class="col-md-6">
                                                <input style="width: 400px;" id="nbi_clearance" class="form-control" value="{{ $employee->nbi_clearance == "" ? $employee->applicant->nbi_clearance : $employee->nbi_clearance }}">
                                             </div>
                                          </div>

                                          <div class="form-group{{ $errors->has('annual_physical_exam') ? ' has-error' : '' }}">
                                             <label for="annual_physical_exam" class="col-md-5 control-label">Annual Physical Exam:</label>

                                             <div class="col-md-6">
                                                <input style="width: 400px;" id="nbi_clearance" class="form-control" value="{{ $employee->annual_physical_exam }}">
                                             </div>
                                          </div>

                                          <div class="form-group{{ $errors->has('tin') ? ' has-error' : '' }}">
                                             <label for="tin" class="col-md-5 control-label">Tax Identification Number (TIN):</label>

                                             <div class="col-md-6">
                                                <input style="width: 400px;" id="tin" class="form-control" value="{{ $employee->tin == "" ? $employee->applicant->tin : $employee->tin }}">
                                             </div>
                                          </div>
                                          </fieldset>
                                       </div>

                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="information">
                           <div class="row">
                              <div class="col-lg-offset-1">

                                 <div class="col-lg-6">
                                    <form class="form-horizontal">

                                       <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                          <label for="first_name" class="col-md-5 control-label">First Name:</label>

                                          <div class="col-md-7">
                                             <input style="width: 400px; resize: none;" id="first_name" class="form-control" value="{{ $employee->applicant->first_name }}" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group{{ $errors->has('middle_initial') ? ' has-error' : '' }}">
                                          <label for="middle_initial" class="col-md-5 control-label">Middle Initial:</label>

                                          <div class="col-md-7">
                                             <input style="width: 400px; resize: none;" id="middle_initial" class="form-control" value="{{ $employee->applicant->middle_initial }}" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                          <label for="last_name" class="col-md-5 control-label">Last Name:</label>

                                          <div class="col-md-7">
                                             <input style="width: 400px; resize: none;" id="last_name" class="form-control" value="{{ $employee->applicant->last_name }}" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                                          <label for="date_of_birth" class="col-md-5 control-label">Date of Birth:</label>

                                          <div class="col-md-7">
                                             <input style="width: 400px; resize: none;" id="date_of_birth" class="form-control" value="{{ date('F d, Y', strtotime($employee->applicant->date_of_birth)) }}" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group">
                                          <label for="age" class="col-md-5 control-label">Age:</label>

                                          <div class="col-md-7">
                                             <input style="width: 400px; resize: none;" id="age" class="form-control" value="{{ $employee->applicant->age }}" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                          <label for="email" class="col-md-5 control-label">E-mail:</label>

                                          <div class="col-md-7">
                                             <input style="width: 400px; resize: none;" id="email" class="form-control" value="{{ $employee->applicant->email }}" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                                          <label for="mobile_number" class="col-md-5 control-label">Mobile Number:</label>

                                          <div class="col-md-7">
                                             <input style="width: 400px; resize: none;" id="mobile_number" class="form-control" value="{{ $employee->applicant->mobile_number }}" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group{{ $errors->has('home_number') ? ' has-error' : '' }}">
                                          <label for="home_number" class="col-md-5 control-label">Home Number:</label>

                                          <div class="col-md-7">
                                             <input style="width: 400px; resize: none;" id="home_number" class="form-control" value="{{ $employee->applicant->home_number }}" disabled>
                                          </div>
                                       </div>

                                       <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                          <label for="address" class="col-md-5 control-label">Address:</label>

                                          <div class="col-md-7">
                                             <textarea id="address" class="form-control" style="width: 400px; resize: none;" disabled>{{ $employee->applicant->address }}</textarea>
                                          </div>
                                       </div>

                                       <div class="row">
                                          <hr>
                                       </div>

                                       <div class="form-group{{ $errors->has('sss') ? ' has-error' : '' }}">
                                         <label for="sss" class="col-md-5 control-label">SSS:</label>

                                         <div class="col-md-6">
                                            <input style="width: 400px;" id="sss" class="form-control" disabled   value="{{ $employee->applicant->sss }}">
                                         </div>
                                      </div>

                                      <div class="form-group{{ $errors->has('philhealth') ? ' has-error' : '' }}">
                                         <label for="philhealth" class="col-md-5 control-label">Phil Health:</label>

                                         <div class="col-md-6">
                                            <input style="width: 400px;" id="philhealth" class="form-control" disabled  value="{{ $employee->applicant->philhealth }}">
                                         </div>
                                      </div>

                                      <div class="form-group{{ $errors->has('pag_ibig') ? ' has-error' : '' }}">
                                         <label for="pag_ibig" class="col-md-5 control-label">Pag-ibig:</label>

                                         <div class="col-md-6">
                                            <input style="width: 400px;" id="pag_ibig" class="form-control" disabled value="{{ $employee->applicant->pag_ibig }}">
                                         </div>
                                      </div>

                                      <div class="form-group{{ $errors->has('nbi_clearance') ? ' has-error' : '' }}">
                                          <label for="nbi_clearance" class="col-md-5 control-label">NBI Clearance:</label>

                                          <div class="col-md-6">
                                              <input style="width: 400px;" id="nbi_clearance" class="form-control" disabled value="{{ $employee->applicant->nbi_clearance }}">
                                          </div>
                                      </div>

                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="leave_counts">
                           <div class="row">
                              <div class="col-lg-12">
                                 <form class="form-horizontal">

                                    <div class="form-group{{ $errors->has('vl_remaining') ? ' has-error' : '' }}">
                                       <label for="vl_remaining" class="col-md-4 control-label">Vacation Leave Remaining:</label>

                                       <div class="col-md-6">
                                          <label id="vl_remaining" class="control-label">{{ $employee->vl_remaining }}</label>
                                       </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('el_remaining') ? ' has-error' : '' }}">
                                       <label for="el_remaining" class="col-md-4 control-label">Emergency Leave Remaning:</label>

                                       <div class="col-md-6">
                                          <label id="el_remaining" class="control-label">{{ $employee->el_remaining }}</label>
                                       </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('sl_remaining') ? ' has-error' : '' }}">
                                       <label for="sl_remaining" class="col-md-4 control-label">Sick Leave Remaning:</label>

                                       <div class="col-md-6">
                                          <label id="sl_remaining" class="control-label">{{ $employee->sl_remaining }}</label>
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

                                       <div class="col-md-6">
                                          <label id="InformationLastUpdate" class="control-label">{{ date('F d, Y h:i A', strtotime($employee->applicant->updated_at)) }}</label>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label for="InformationLastUpdate" class="col-md-4 control-label">Date Accepted as Employee:</label>

                                       <div class="col-md-6">
                                          <label id="InformationLastUpdate" class="control-label">{{ date('F d, Y h:i A', strtotime($employee->created_at)) }}</label>
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
                                       <label for="salary" class="col-md-4 control-label">Salary:</label>

                                       <div class="col-md-6">
                                          <label id="salary" class="control-label">PHP {{ $employee->applicant->expected_salary}}</label>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label for="job_position" class="col-md-4 control-label">Job Position:</label>

                                       <div class="col-md-6">
                                          <label id="job_position" class="control-label">{{ $employee->applicant->job_position }}</label>
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

   <div class="modal fade" tabindex="-1" role="dialog" id="ChangeLeaveRemainingModal">
      <form class="form-horizontal" action="{{ route('admin_user_employee_update_leaves', $employee->id) }}" method="POST">
         {{ csrf_field() }}
         {{ method_field('PATCH') }}

         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Change Remaining Leaves</h4>
               </div>

               <div class="modal-body">
                  <div class="form-group">
                     <label for="vl_remaining" class="control-label col-lg-4">Vacation Leave</label>
                     <div class="col-lg-6">
                        <input name="vl_remaining" id="vl_remaining" type="text" class="form-control" value="{{ $employee->vl_remaining }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="sl_remaining" class="control-label col-lg-4">Sick Leave</label>
                     <div class="col-lg-6">
                        <input name="sl_remaining" id="sl_remaining" type="text" class="form-control" value="{{ $employee->sl_remaining }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="el_remaining" class="control-label col-lg-4">Emergency Leave</label>
                     <div class="col-lg-6">
                        <input name="el_remaining" id="el_remaining" type="text" class="form-control" value="{{ $employee->el_remaining }}">
                     </div>
                  </div>
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Update</button>
               </div>
            </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
      </form>
   </div><!-- /.modal -->

   <div class="modal fade" tabindex="-1" role="dialog" id="EmployeeCreateTrainingModal">
      <form class="form-horizontal" action="{{ route('admin_add_training_to_employee', $employee->id) }}" method="POST">
         {{ csrf_field() }}

         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Add Employee Training</h4>
               </div>

               <div class="modal-body">
                  <div class="form-group">
                     <label for="TrainingTitle" class="control-label col-lg-4">Training Title</label>
                     <div class="col-lg-6">
                        <input name="title" id="title" type="text" class="form-control" value="{{ old('title') }}">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="lesson" class="control-label col-lg-4">Topic</label>
                     <div class="col-lg-6">
                        <input name="lesson" id="lesson" type="text" class="form-control" value="{{ old('lesson') }}">
                     </div>
                  </div>
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Save</button>
               </div>
            </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
      </form>
   </div><!-- /.modal -->

   <div class="modal fade" tabindex="-1" role="dialog" id="FileVacationLeaveModal">
      <form class="form-horizontal" action="{{ route('admin_user_employee_file_vacation_leaves', $employee->id) }}" method="POST">
      {{ csrf_field() }}

         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">File Vacation Leave</h4>
               </div>

               <div class="modal-body">
                  <div class="form-group">
                     <label for="datepicker" class="control-label col-lg-4">Date Range of Leave</label>
                     <div class="col-lg-6">
                        <div class="input-daterange input-group" id="datepicker">
                           <input type="text" class="input-sm form-control" name="start_date" />
                           <span class="input-group-addon">to</span>
                           <input type="text" class="input-sm form-control" name="end_date" />
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="reason" class="control-label col-lg-4">Reason</label>
                     <div class="col-lg-6">
                        <input name="reason" id="reason" type="text" class="form-control">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="description" class="control-label col-lg-4">Description</label>
                     <div class="col-lg-6">
                        <input name="description" id="description" type="text" class="form-control">
                     </div>
                  </div>
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Submit</button>
               </div>
            </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
      </form>
   </div><!-- /.modal -->

   <script>
      $('.input-daterange.input-group').datepicker({
         format: "yyyy-mm-dd"
      });
   </script>
@endsection
