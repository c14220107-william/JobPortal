<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
        $jobVacancy = JobVacancy::findOrFail($id); // Ambil data job vacancy berdasarkan ID
        $application = Application::where('job_vacancies_id', $id) // Filter berdasarkan job vacancy ID
                                    ->where('user_id', auth()->id()) // Filter berdasarkan ID pengguna yang sedang login
                                    ->first(); // Ambil hanya satu aplikasi jika ada
        return view('job_vacancies.show', compact('jobVacancy', 'application'));
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
        $positions = position::all();
        $locations = Location::all();
        $departments = department::all();

        return view('admin.job_vacancies.edit', compact('jobVacancy', 'positions', 'locations', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'id_position' => 'required|exists:positions,id',
            'id_location' => 'required|exists:locations,id',
            'id_department' => 'required|exists:departments,id',
            'requirement' => 'required|string',
            'description' => 'required|string',
            'benefit' => 'required|string',
            'available_from_date' => 'required|date',
            'available_to_date' => 'required|date',
            'kebutuhan' => 'required|integer|min:1',
        ]);

        $jobVacancy = JobVacancy::findOrFail($id);
        $jobVacancy->update($validated);

        return redirect()->route('admin.job_vacancies.index')->with('success', 'Lowongan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        JobVacancy::destroy($id);
        return redirect()->route('admin.job_vacancies.index');
    }
    public function closeJobVacancy($id)
    {
        JobVacancy::where('id', $id)->update(['is_active' => false]);
        return redirect()->route('admin.job_vacancies.index')->with('success', 'Job vacancy closed successfully.');
    }
    public function showIndex($id)
    {
        $jobVacancy = JobVacancy::with(['position', 'location', 'department'])->findOrFail($id);
        return view('admin.job_vacancies.show', compact('jobVacancy'));
    }

    

}
