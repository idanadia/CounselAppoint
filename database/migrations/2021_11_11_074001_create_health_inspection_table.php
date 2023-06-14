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
        Schema::create('inspections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('symptom1')->default(false);
            $table->boolean('symptom2')->default(false);
            $table->boolean('symptom3')->default(false);
            $table->boolean('symptom4')->default(false);
            $table->boolean('symptom5')->default(false);
            $table->boolean('symptom6')->default(false);
            $table->boolean('symptom7')->default(false);
            $table->boolean('symptom8')->default(false);
            $table->boolean('symptom9')->default(false);
            $table->boolean('symptom10')->default(false);
            $table->boolean('symptom11')->default(false);
            $table->boolean('symptom12')->default(false);
            $table->boolean('symptom13')->default(false);
            $table->boolean('symptom14')->default(false);
            $table->integer('noOfSymptoms')->default(0);
            $table->string('result')->default("Negative");
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
        Schema::dropIfExists('inspections');
    }
};
