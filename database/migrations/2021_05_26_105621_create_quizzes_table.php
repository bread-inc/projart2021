<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->float('ponderation');
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() !== 'sqlite') {
            Schema::table('quizzes', function(Blueprint $table) {
                $table->dropForeign('quiz_region_id_foreign');
            });
        }
        Schema::dropIfExists('quizzes');
    }
}
