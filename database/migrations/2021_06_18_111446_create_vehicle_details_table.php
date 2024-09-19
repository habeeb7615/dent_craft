<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('state_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('make', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('colour', 100)->nullable();
            $table->string('vin_number', 100)->nullable();
            $table->string('reg_number', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('chassis', 100)->nullable();
            $table->string('year_of_manufacture', 100)->nullable();
            $table->string('vehicle_type', 100)->nullable();
            $table->string('compliance_plate', 100)->nullable();
            $table->string('body_type', 100)->nullable();
            $table->string('engine_number', 100)->nullable();
            $table->string('registration_status', 100)->nullable();
            $table->string('registration_expiry_date', 100)->nullable();
            $table->string('wov_type_code', 100)->nullable();
            $table->string('wov_jurisdiction', 100)->nullable();
            $table->string('wov_damage_codes', 100)->nullable();
            $table->string('wov_incident_date', 100)->nullable();
            $table->string('wov_incident_code', 100)->nullable();
            $table->string('insurance', 100)->nullable();
            $table->string('claim_number', 100)->nullable();
            $table->string('sunroof', 100)->nullable();
            $table->boolean('if_stolen')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_details');
    }
}
