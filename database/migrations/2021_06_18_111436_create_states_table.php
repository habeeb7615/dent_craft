<?php

use App\Models\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('state_name', 100);
            $table->string('state_code', 25);
            $table->timestamps();
        });

        $data = [
            ['state_name' => 'New South Wales', 'state_code' => 'NSW'],
            ['state_name' => 'Victoria', 'state_code' => 'VIC'],
            ['state_name' => 'Queensland', 'state_code' => 'QLD'],
            ['state_name' => 'Tasmania', 'state_code' => 'TAS'],
            ['state_name' => 'South Australia', 'state_code' => 'SA'],
            ['state_name' => 'West Australia', 'state_code' => 'WA'],
            ['state_name' => 'Northern Territory', 'state_code' => 'NT'],
            ['state_name' => 'Australian Capital Territory', 'state_code' => 'ACT'],
        ];

        foreach ($data as $datum) {
            State::create($datum);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
