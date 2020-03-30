<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeptHeadToTblDept extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_dept', function (Blueprint $table) {
            $table->string('department_head',10)->nullable();
            $table->string('assistant_department_head',10)->nullable();
            $table->integer('division_id',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_dept', function (Blueprint $table) {
            //
        });
    }
}
