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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code');
            $table->foreignId('id_position')->constrained('positions');
            $table->foreignId('id_location')->constrained('locations');
            $table->foreignId('id_department')->constrained('departments');
            $table->text('requirement')->nullable();
            $table->text('description')->nullable();
            $table->text('benefit')->nullable();
            $table->text('additional_info')->nullable();
            $table->date('available_from_date');
            $table->date('available_to_date');
            $table->boolean('is_active')->default(true);
            $table->dateTime('created_date')->useCurrent();
            $table->dateTime('updated_date')->nullable();
            $table->integer('kebutuhan')->nullable();
            $table->string('url_jobstreet')->nullable();
            $table->integer('count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
