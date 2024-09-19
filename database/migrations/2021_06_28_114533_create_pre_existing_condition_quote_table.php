<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreExistingConditionQuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_existing_condition_quote', function (Blueprint $table) {
            $table->foreignId('quote_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pre_existing_condition_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_existing_condition_quote');
    }
}
