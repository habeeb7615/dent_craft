<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuoteIdColumnInDamagedAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('damaged_areas', function (Blueprint $table) {
            $table->foreignId('quote_id')->nullable()->after('added_by')->constrained('quotes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('damaged_areas', function (Blueprint $table) {
            $table->dropForeign('parts_quote_id_foreign');
            $table->dropColumn(['quote_id']);
        });
    }
}
