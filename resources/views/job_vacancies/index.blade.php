@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6" data-aos="fade-right">Available Job Vacancies</h1>
    {{-- <!-- Filter Section -->
    <div class="flex gap-4 mb-6" data-aos="fade-up">
        <!-- Filter by Department -->
        <div>
            <label for="department" class="block text-gray-700">Departemen</label>
            <select id="department" class="border border-gray-300 p-2 rounded" onchange="filterJobs()">
                <option value="">Semua Departemen</option>
                <option value="Production">Production</option>
                <option value="Marketing">Marketing</option>
                <option value="Finance">Finance</option>
                <option value="HR">HR</option>
                <option value="IT">IT</option>
            </select>
        </div>

        <!-- Filter by Position -->
        <div>
            <label for="position" class="block text-gray-700">Posisi</label>
            <select id="position" class="border border-gray-300 p-2 rounded" onchange="filterJobs()">
                <option value="">Semua Posisi</option>
                <option value="Manager">Manager</option>
                <option value="Staff">Staff</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Engineer">Engineer</option>
                <option value="Analyst">Analyst</option>
            </select>
        </div>

        <!-- Filter by Location -->
        <div>
            <label for="location" class="block text-gray-700">Lokasi</label>
            <select id="location" class="border border-gray-300 p-2 rounded" onchange="filterJobs()">
                <option value="">Semua Lokasi</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Semarang">Semarang</option>
                <option value="Bali">Bali</option>
                <option value="Jogja">Jogja</option>
            </select>
        </div>
    </div> --}}

    <div id="jobListings">
        @foreach ($jobVacancies as $job)
            <div class="job-item md:hover:shadow-md md:px-6 md:py-8 flex flex-col md:gap-4 md:flex-row md:items-start" 
                 data-department="{{ $job->department->name ?? 'N/A'}}" 
                 data-position="{{ $job->position->title ?? 'N/A' }}" 
                 data-location="{{ $job->location->name ?? 'N/A'}}"
                 data-aos="fade-up" 
                 data-aos-delay="{{ $loop->index * 100 }}">
                
                <div class="flex-grow">
                    <div class="flex flex-col gap-4 md:items-start md:flex-row md:gap-8">
                        <div class="flex-grow">
                            <p class="text-green-800 font-medium underline mb-2">{{ $job->title }}</p>
                            <p class="text-gray-600 mb-4">{{ $job->company_name }}</p>
                            <div class="flex gap-12">
                                <div>
                                    <div class="text-gray-600 flex gap-2 mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <p>Location: {{ $job->location->name }}</p>
                                    </div>
                                    <div class="text-gray-600 flex gap-2 mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <p>Department: {{ $job->department->name }}</p>
                                    </div>
                                    <div class="text-gray-600 flex gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                        <p>Kebutuhan: {{ $job->kebutuhan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="mt-4 md:mt-0 md:w-40 md:flex-grow-0 md:flex-shrink-0 px-8 py-3 text-green-800 border border-green-600 bg-white hover:bg-white hover:text-green-800 hover:border-green-600">
                    <a href="{{ route('job_vacancies.show', $job->id) }}">Selengkapnya</a>
                </button>
            </div>
        @endforeach
    </div>
</div>

<script>
    function filterJobs() {
        // Ambil nilai dari setiap filter
        const departmentFilter = document.getElementById('department').value.toLowerCase();
        const positionFilter = document.getElementById('position').value.toLowerCase();
        const locationFilter = document.getElementById('location').value.toLowerCase();

        // Ambil semua elemen job-item
        const jobs = document.querySelectorAll('.job-item');

        // Loop setiap job-item dan tampilkan/hilangkan berdasarkan filter
        jobs.forEach(job => {
            const jobDepartment = job.getAttribute('data-department').toLowerCase();
            const jobPosition = job.getAttribute('data-position').toLowerCase();
            const jobLocation = job.getAttribute('data-location').toLowerCase();

            // Cek apakah job sesuai dengan filter
            const isDepartmentMatch = !departmentFilter || jobDepartment.includes(departmentFilter);
            const isPositionMatch = !positionFilter || jobPosition.includes(positionFilter);
            const isLocationMatch = !locationFilter || jobLocation.includes(locationFilter);

            // Jika semua filter cocok, tampilkan; jika tidak, sembunyikan
            if (isDepartmentMatch && isPositionMatch && isLocationMatch) {
                job.style.display = 'flex';  // Tampilkan elemen
            } else {
                job.style.display = 'none';  // Sembunyikan elemen
            }
        });
    }
</script>
@endsection
