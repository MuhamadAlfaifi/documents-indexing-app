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
        Schema::table('users', function (Blueprint $table) {
            // app-level permissions inspired by file permissions
            // rwx = 111 in binary = 7 in decimal
            // rw- = 110 in binary = 6 in decimal
            // r-x = 101 in binary = 5 in decimal
            // r-- = 100 in binary = 4 in decimal
            // --- = 000 in binary = 0 in decimal
            $table->integer('permissions')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('permissions');
        });
    }
};
