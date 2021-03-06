<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePunchJustificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punch_justifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->integer('in_out');
            $table->integer('grouping');
            $table->integer('visible');
            $table->integer('visibleDashboard');
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
        Schema::dropIfExists('punch_justifications');
    }
}
