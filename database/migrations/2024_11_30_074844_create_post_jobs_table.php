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
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_categories_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->string('location');
            $table->string('job_type'); //Full-time, Part-time
            $table->string('salary_range')->nullable();
            $table->timestamp('posted_at');
            $table->timestamp('application_deadline');
            $table->enum('acitve', ['1', '0'])->default('1');
            $table->enum('status', ['online', 'pending','offline','draft'])->default('online');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_jobs');
    }
};
