<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'first_name', 'middle_initial', 'last_name', 'date_of_birth', 'address', 'mobile_number',
      'home_number', 'email', 'gender', 'initial_interview', 'exam_interview', 'final_interview', 'photo_dir',
      'employee_id', 'sss', 'philhealth', 'tin', 'pag_ibig', 'nbi_clearance'
   ];
   //

   public function employee()
   {
      return $this->belongsTo(Employee::class);
   }

   public function getAge($dob)
   {
      if(!empty($dob)){
         $birthdate  = new \DateTime($dob);
         $today      = new \DateTime('today');
         $age        = $birthdate->diff($today)->y;
         return $age;
      }else{
         return 0;
      }
   }

   public function initialInterviewStatus()
   {
      if($this->initial_interview == 0) {
         return "FAILED";
      } else if($this->initial_interview == 1) {
         return "PENDING";
      } else if ($this->initial_interview == 2) {
         return "PASSED";
      }
   }

   public function examInterviewStatus()
   {
      if($this->exam_interview == 0) {
         return "FAILED";
      } else if($this->exam_interview == 1) {
         return "PENDING";
      } else if ($this->exam_interview == 2) {
         return "PASSED";
      }
   }

   public function finalInterviewStatus()
   {
      if($this->final_interview == 0) {
         return "FAILED";
      } else if($this->final_interview == 1) {
         return "PENDING";
      } else if ($this->final_interview == 2) {
         return "PASSED";
      }
   }

   public function exam()
   {
      return $this->hasOne(Exam::class);
   }

   public function fullName()
   {
      if($this->first_name == "") {
         return $this->last_name;
      } elseif ($this->last_name == "") {
         return $this->first_name;
      }

      return $this->first_name . ' ' . $this->last_name;
   }

   public static function storeApplicant($createApplicantRequest)
   {
      if(!$createApplicantRequest->hasFile('resumePath')) {
         $applicantResumeLocation = "N/A";
      } else {
         $applicantResume = $createApplicantRequest->file('resumePath');
         $applicantResume->move(storage_path() . '/applicant_resumes/', $applicantResume->getClientOriginalName());
         $applicantResumeLocation = 'applicant_resumes/'.$applicantResume->getClientOriginalName();
      }

      $imageType = $createApplicantRequest->get('gender') == 0 ? "applicants_picture/null/female-null.jpg" : "applicants_picture/null/male-null.jpg";

      $applicant                      = new Applicant();
      $applicant->first_name          = strtoupper($createApplicantRequest->get('first_name'));
      $applicant->middle_initial      = strtoupper($createApplicantRequest->get('middle_initial'));
      $applicant->last_name           = strtoupper($createApplicantRequest->get('last_name'));
      $applicant->address             = strtoupper($createApplicantRequest->get('address'));
      $applicant->email               = $createApplicantRequest->get('email');
      $applicant->gender              = $createApplicantRequest->get('gender');
      $applicant->date_of_birth       = $createApplicantRequest->get('date_of_birth');
      $applicant->address             = strtoupper($createApplicantRequest->get('address'));
      $applicant->mobile_number       = $createApplicantRequest->get('mobile_number');
      $applicant->home_number         = $createApplicantRequest->get('home_number');
      $applicant->sss                 = $createApplicantRequest->get('sss');
      $applicant->philhealth          = $createApplicantRequest->get('philhealth');
      $applicant->pag_ibig            = $createApplicantRequest->get('pag_ibig');
      $applicant->tin                 = $createApplicantRequest->get('tin');
      $applicant->nbi_clearance       = $createApplicantRequest->get('nbi_clearance');
      $applicant->age                 = $applicant->getAge($createApplicantRequest->get('date_of_birth'));
      $applicant->initial_interview   = 1;
      $applicant->exam_interview      = 1;
      $applicant->final_interview     = 1;
      $applicant->job_position        = strtoupper($createApplicantRequest->get('job_position'));
      $applicant->expected_salary     = strtoupper($createApplicantRequest->get('expected_salary'));
      $applicant->photo_dir           = $imageType;
      $applicant->type_of_employment  = strtoupper($createApplicantRequest->get('type_of_employment'));
      $applicant->employee_id         = 0;
      $applicant->emergency_person    = strtoupper($createApplicantRequest->get('emeregency_person'));
      $applicant->emergency_person_contact = $createApplicantRequest->get('emergency_person_contact');
      $applicant->emergency_person_address = $createApplicantRequest->get('emergency_person_address');
      $applicant->resume_path = $applicantResumeLocation;
      $applicant->save();

      $exam = new Exam();
      $exam->applicant_id = $applicant->id;
      $exam->category = $applicant->job_position;
      $exam->status = "ON-GOING";
      $exam->score = 0;
      $exam->name = $applicant->job_position."-EXAM";
      $exam->save();


      return redirect()->back()->with('msg', 'Applicant "' . $applicant->fullName() . '" was successfully saved to Applicant List.');
   }

   public static function updateApplicant($updateApplicantRequest, $applicant)
   {
      if(!$updateApplicantRequest->hasFile('fileToUpload')) {
         $applicantPhotoLocation = $applicant->photo_dir;
      } else {
         $applicantPhoto = $updateApplicantRequest->file('fileToUpload');
         $applicantPhoto->move(public_path() . '/applicants_picture/', $applicantPhoto->getClientOriginalName());
         $applicantPhotoLocation = 'applicants_picture/'.$applicantPhoto->getClientOriginalName();
      }

      $app = new Applicant();
      Applicant::find($applicant->id)->update([
         'first_name'        => strtoupper($updateApplicantRequest->get('first_name')),
         'middle_initial'    => strtoupper($updateApplicantRequest->get('middle_initial')),
         'last_name'         => strtoupper($updateApplicantRequest->get('last_name')),
         'address'           => strtoupper($updateApplicantRequest->get('address')),
         'date_of_birth'     => strtoupper($updateApplicantRequest->get('date_of_birth')),
         'age'               => $app->getAge($updateApplicantRequest->get('date_of_birth')),
         'email'             => $updateApplicantRequest->get('email'),
         'mobile_number'     => $updateApplicantRequest->get('mobile_number'),
         'home_number'       => $updateApplicantRequest->get('home_number'),
         'gender'            => $updateApplicantRequest->get('gender'),
         'photo_dir'         => $applicantPhotoLocation,
         'sss'               => $updateApplicantRequest->get('sss'),
         'philhealth'        => $updateApplicantRequest->get('philhealth'),
         'pag_ibig'          => $updateApplicantRequest->get('pag_ibig'),
         'tin'               => $updateApplicantRequest->get('tin'),
         'nbi_clearance'     => $updateApplicantRequest->get('nbi_clearance')
      ]);

      return redirect()->back()->with('msg', 'You have successfully updated "' . $applicant->fullName() . '" Information');
   }

   public static function hireApplicant($applicant)
   {
      $employee = new Employee();
      $employee->save();

      $hireApplicant = Applicant::find($applicant->id);
      $hireApplicant->employee_id = $employee->id;

      $hireApplicant->save();

      return redirect()->route('admin_user_employee_show', $employee->id);
   }

   public static function passInitialInterview($applicant)
   {
      $applicant->initial_interview = 2;
      $applicant->save();

      $exams = $applicant->exam()->save(new Exam([
         'score' => 0,
         'category' => $applicant->job_position,
         'status' => 'ON-GOING',
         'name' => $applicant->job_position
      ]));

      return redirect()->back()->with('msg', 'Applicant "' . $applicant->fullName() .'" has passed the Initial Interview.');
   }
}
