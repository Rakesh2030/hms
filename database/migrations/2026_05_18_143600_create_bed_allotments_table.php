<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bed_allotments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bed_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->date('allotment_date');
            $table->date('discharge_date')->nullable();
            $table->string('status')->default('admitted');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bed_allotments');
    }
};
