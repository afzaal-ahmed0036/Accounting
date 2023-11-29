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
        Schema::create('production_log_details', function (Blueprint $table) {
            $table->id('ProductionLogDetailID');
            $table->unsignedBigInteger('ProductionLogID');
            $table->string('BatchNo', 255)->nullable();
            $table->unsignedBigInteger('ProductID');
            $table->unsignedBigInteger('WarehouseID')->nullable();
            $table->decimal('Rate', 65, 2)->default(0.00);
            $table->decimal('Qty', 65, 2)->default(0.00);
            $table->decimal('Total', 65, 2)->default(0.00);
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
        Schema::dropIfExists('production_log_details');
    }
};
