<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIgnoredStartedCompletedColumnToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `tasks` ADD `ignored` TINYINT(1) DEFAULT NULL AFTER `description`');
        DB::statement('ALTER TABLE `tasks` ADD `started` TINYINT(1) DEFAULT NULL AFTER `description`');
        DB::statement('ALTER TABLE `tasks` ADD `completed` TINYINT(1) DEFAULT NULL AFTER `description`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks',function($table){
            $table->dropColumn('ignored');
            $table->dropColumn('started');
            $table->dropColumn('completed');
        });
    }
}
