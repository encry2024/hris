<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\Http\Requests\UpdateApplicantRequest;
use Excel;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        return view('admin.applicant.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        return view('admin.applicant.edit', compact('applicant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicantRequest $updateApplicantRequest, Applicant $applicant)
    {
        $updateApplicant = Applicant::updateApplicant($updateApplicantRequest, $applicant);

        return $updateApplicant;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hireApplicant(Applicant $applicant)
    {
        $hire_applicant = Applicant::hireApplicant($applicant);

        return $hire_applicant;
    }

    public function passInitialInterview(Applicant $applicant)
    {
        $passInitialInterview = Applicant::passInitialInterview($applicant);

        return $passInitialInterview;
    }

    public function importApplicantData(Request $request)
    {
        // dd($request->all());
        $import_applicant_data = Applicant::importApplicantData($request);

        return $import_applicant_data;
    }
}
