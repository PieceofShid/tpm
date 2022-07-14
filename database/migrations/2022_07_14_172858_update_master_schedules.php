<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_schedules', function(Blueprint $table){
            $table->foreignId('kanban_id')->after('machine_id')->references('id')->on('kanbans')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_schedules', function (Blueprint $table) {
            $table->dropColumn('kanban_id');
        });
    }
};
