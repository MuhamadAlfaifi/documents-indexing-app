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
            $table->integer('hijri_day');
            $table->integer('hijri_month');
            $table->integer('hijri_year');
            $table->timestamp('doc_date');
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
            $table->dropColumn('doc_date');
        });
    }
};
