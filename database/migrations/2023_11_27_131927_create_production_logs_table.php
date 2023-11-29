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
        Schema::create('production_logs', function (Blueprint $table) {
            $table->id('ProductionLogID');
            $table->string('BatchNo', 255);
            $table->date('Date')->nullable();
            $table->unsignedBigInteger('WarehouseID')->nullable();
            $table->decimal('TotalQty', 65, 2)->default(0.00);
            $table->decimal('Value', 65, 2)->default(0.00);
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
        Schema::dropIfExists('production_logs');
    }
};
