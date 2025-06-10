<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('matric_number')->nullable();
        $table->string('kulliyah')->nullable();
        $table->string('profile_picture')->nullable(); // stores filename/path
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['matric_number', 'kulliyah', 'profile_picture']);
    });
}
};
