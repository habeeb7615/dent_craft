<?php

use App\Models\Guard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guards', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });

        $data = [
            ['name' => '+'],
            ['name' => 'Extreme Size'],
            ['name' => 'Aluminium'],
            ['name' => 'Panel Crease'],
            ['name' => 'P2P'],
        ];

        foreach ($data as $datum) {
            Guard::create($datum);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guards');
    }
}
