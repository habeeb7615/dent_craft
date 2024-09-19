<?php

use App\Models\PreExistingCondition;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreExistingConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_existing_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });

        $data = [
            ['name' => 'Windows Chips'],
            ['name' => 'Cracks'],
            ['name' => 'Rust'],
            ['name' => 'Scratches'],
            ['name' => 'Paint Damage'],
            ['name' => 'Ripples'],
            ['name' => 'Dents Not Included'],
        ];

        foreach ($data as $datum) {
            PreExistingCondition::create($datum);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_existing_conditions');
    }
}
