<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacation_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('title')->nullable();
            $table->string('leave_date_start')->nullable();
            $table->string('leave_date_end')->nullable();
            $table->string('description')->nullable();
            $table->string('c_year')->nullable();
            $table->string('allow_leave')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('vacation_leaves');
    }
}
