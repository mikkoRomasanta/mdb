<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_id')->unique();
            $table->boolean('gsis')->default(0); //remove after full implementation
            $table->boolean('ldb')->default(0); //remove after full implementation
            $table->boolean('umdb')->default(0); //remove after full implementation
            // $table->timestamps(); //add on deployment + remove no default timestamps in model
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
