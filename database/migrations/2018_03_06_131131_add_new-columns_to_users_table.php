<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
            $table->string('address')->after('email');
            $table->string('history')->nullable();
            $table->string('cond')->nullable();
            $table->string('allergies')->nullable();
            $table->string('sex')->nullable();
            $table->string('marital_stat')->nullable();
            $table->string('diag')->nullable();
            $table->string('vitals')->nullable();
            $table->string('meds')->nullable();
            $table->string('labs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
        });
    }
}
