<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\department;
use App\Models\JobVacancy;
use App\Models\Location;
use App\Models\position;
use App\Http\Requests\JobVacancyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $application = Application::where('job_vacancies_id', $id)
                                    ->where('user_id', auth()->id())
                                    ->first();
        return view('job_vacancies.show', compact('jobVacancy', 'application'));
    }

    public function adminIndex()
    {
        $jobVacancies = JobVacancy::with(['position', 'location', 'department'])->get();
        return view('admin.job_vacancies.index', compact('jobVacancies'));
    }

    public function create()
    {
        $positions = position::all();
        Log::info('Positions data:', ['positions' => $positions->toArray()]);
        
        $locations = Location::all();
        $departments = department::all();
        
        return view('admin.job_vacancies.create', compact('positions', 'locations', 'departments'));
    }

    public function store(JobVacancyRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = true; // Set default to active
        
        JobVacancy::create($validated);
        return redirect()
            ->route('admin.job_vacancies.index')
            ->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $positions = position::all();
        $locations = Location::all();
        $departments = department::all();

        return view('admin.job_vacancies.edit', compact('jobVacancy', 'positions', 'locations', 'departments'));
    }

    public function update(JobVacancyRequest $request, $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $validated = $request->validated();
        
        $jobVacancy->update($validated);
        return redirect()
            ->route('admin.job_vacancies.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $jobVacancy->delete();
        
        return redirect()
            ->route('admin.job_vacancies.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }

    public function closeJobVacancy($id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $jobVacancy->update(['is_active' => false]);
        
        return redirect()
            ->route('admin.job_vacancies.index')
            ->with('success', 'Lowongan berhasil ditutup.');
    }

    public function showIndex($id)
    {
        $jobVacancy = JobVacancy::with(['position', 'location', 'department'])->findOrFail($id);
        return view('admin.job_vacancies.show', compact('jobVacancy'));
    }
}
