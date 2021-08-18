<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualsCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals_cases', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('individual_id');
            $table->unsignedInteger('pss_case_id');
            $table->timestamps();



            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('cascade');
            $table->foreign('pss_case_id')->references('id')->on('pss_cases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individuals_cases');
    }
}
