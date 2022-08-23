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
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('hijri_day')->default(1);
            $table->integer('hijri_month')->default(10);
            $table->integer('hijri_year')->default(1400);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('hijri_day');
            $table->dropColumn('hijri_month');
            $table->dropColumn('hijri_year');
        });
    }
};
