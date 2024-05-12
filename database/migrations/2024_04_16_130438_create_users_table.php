<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 60);
            $table->string('prenom', 60);
            $table->string('fname', 60);
            $table->string('email', 60)->unique();
            $table->date('naissance');
            $table->string('password', 60);
            $table->string('tel', 60);
            $table->string('role', 60);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
