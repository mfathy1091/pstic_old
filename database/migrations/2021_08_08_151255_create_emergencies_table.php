<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('record_id');
            $table->date('emergency_date');
            $table->text('comment');
            $table->unsignedInteger('emergency_type_id');
            $table->timestamps();

            $table->foreign('record_id')->references('id')->on('records')->onDelete('cascade');
            $table->foreign('emergency_type_id')->references('id')->on('emergency_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergencies');
    }
}
