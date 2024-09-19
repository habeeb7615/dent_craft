<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('company_name', 50)->nullable();
            $table->string('company_image', 50)->nullable();
            $table->string('abn', 50)->nullable();
            $table->string('mobile_number', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('po_box', 100)->nullable();
            $table->integer('gst')->nullable();
            $table->boolean('check_gst')->default(0);
            $table->text('email_template')->nullable();
            $table->string('timezone', 25);
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
        Schema::dropIfExists('company_details');
    }
}
