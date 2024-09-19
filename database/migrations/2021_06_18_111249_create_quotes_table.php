<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')->constrained('users');
            $table->string('quote_id', 50);
            $table->enum('quote_status', ['draft', 'submitted', 'finished', 'completed'])->default('draft');
            $table->string('current_step', 5)->default('1');
            $table->boolean('car_search_type')->default(1);
            $table->boolean('attach_images_in_email')->default(0);
            $table->text('image_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
