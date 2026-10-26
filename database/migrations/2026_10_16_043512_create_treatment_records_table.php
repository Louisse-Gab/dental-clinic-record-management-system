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
    Schema::create('treatment_records', function (Blueprint $table) {
        $table->id('record_id');

        $table->unsignedBigInteger('patient_id');
        $table->unsignedBigInteger('dentist_id');

        $table->string('treatment_type');
        $table->text('treatment_details');
        $table->date('treatment_date');

        $table->timestamps();

        $table->foreign('patient_id')
            ->references('patient_id')
            ->on('patients');

        $table->foreign('dentist_id')
            ->references('dentist_id')
            ->on('dentists');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_records');
    }
};
