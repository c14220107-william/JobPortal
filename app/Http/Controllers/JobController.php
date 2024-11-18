<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\JobVacancy;
use App\Models\Location;
use App\Models\position;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobVacancies = JobVacancy::with(['position', 'location', 'department'])->get();
        return view('job_vacancies.index', compact('jobVacancies'));
    }

    public function show($id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        return view('job_vacancies.show', compact('jobVacancy'));
    }

    public function adminIndex()
    {
        $jobVacancies = JobVacancy::all();
        return view('admin.job_vacancies.index', compact('jobVacancies'));
    }

    public function create()
    {
        
        $positions = position::all();
        $locations = Location::all();
        $departments = department::all();
        return view('admin.job_vacancies.create', compact( 'positions', 'locations', 'departments'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'location' => 'required',
        //     'department' => 'required',
        // ]);

        JobVacancy::create($request->all());
        return redirect()->route('admin.job_vacancies.index');
    }

    public function edit($id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        return view('admin.job_vacancies.edit', compact('jobVacancy'));
    }

    public function update(Request $request, $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $jobVacancy->update($request->all());
        return redirect()->route('admin.job_vacancies.index');
    }

    public function destroy($id)
    {
        JobVacancy::destroy($id);
        return redirect()->route('admin.job_vacancies.index');
    }
}
