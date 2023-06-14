<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('fullName');
            $table->string('course')->nullable();
            $table->string('password');
            $table->string('phoneNo')->nullable();
            $table->string('matricId')->nullable();
            $table->longText('address')->nullable();
            $table->timestamp('dateOfBirth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('qualification')->nullable();
            $table->string('roomLocation')->nullable();
            $table->string('position')->nullable();
            $table->string('faculty')->nullable();
            $table->string('department')->nullable();
            $table->string('icNo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('role')->default(0); // 0 = User; 1 = Counsellor; 2 = Admin;
            $table->string('imagePath')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
