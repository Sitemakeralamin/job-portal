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
        Schema::create('job_applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('job_id')->constrained()->cascadeOnDelete();
        $table->string('name');
        $table->string('phone');
        $table->string('email');
        $table->string('gender');
        $table->date('date_of_birth')->nullable();
        $table->text('address')->nullable();
        $table->string('passport_no')->nullable();
        $table->string('nationality')->nullable();
        $table->string('current_country')->nullable();
        $table->boolean('english_certificate')->default(0);
        $table->integer('experience_year')->nullable();
        $table->string('video_link')->nullable();
        $table->text('photo')->nullable();
        $table->integer('created_by')->nullable();
        $table->tinyInteger('status')->default(1);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
