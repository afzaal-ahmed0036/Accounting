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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("title", 255);
            $table->bigInteger("team_lead_id")->nullable();
            $table->bigInteger("client_id")->nullable();
            $table->string("task_view", 255)->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->text('overview')->nullable();
            $table->string("location", 255)->nullable();
            $table->double('budget')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
