<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartQuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_quote', function (Blueprint $table) {
            $table->foreignId('part_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('quote_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('part_quantity')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_quote');
    }
}
