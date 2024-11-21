<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();  // Jika ingin auto-increment
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('job_vacancies_id')->constrained('job_vacancies')->onDelete('cascade');
            $table->date('application_date');
            $table->string('status');
            $table->string('resume_link')->nullable();
            $table->text('cover_letter')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null'); // Menandakan siapa yang meninjau
            $table->date('interview_date')->nullable(); // Tanggal wawancara
            $table->text('interview_notes')->nullable(); // Catatan wawancara
            $table->string('final_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
