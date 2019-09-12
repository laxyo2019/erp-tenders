<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('emp_code',191)->nullable();
            $table->integer('comp_id');
            $table->integer('dept_id')->nullable();
            $table->integer('desg_id');
            $table->integer('grade_id')->nullable();
            $table->string('emp_name', 50);
            $table->enum('emp_gender', ['M', 'F', 'O'])->nullable();
            $table->date('emp_dob')->nullable();
            $table->date('join_dt')->nullable();
            $table->integer('status_id')->nullable();
            $table->timestamps();
            $table->softDeletes();			
        });

        Schema::create('desg_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('comp_id');
            $table->string('desg_name', 50);
            $table->string('desg_desc',200)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('emp_grade_mast', function (Blueprint $table) {
            $table->string('grade_code', 2)->primary();
            $table->integer('comp_id');
            $table->decimal('entitled_amt', 15, 4)->default(0.00);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tour_mast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('emp_id');
            $table->unsignedBigInteger('apr_id');
            $table->string('title');
            $table->integer('current_stage')->nullable();
          	$table->decimal('adv_amt', 15, 4)->default(0.00);
          	$table->text('purpose');
            $table->string('start_loc');
            $table->date('start_dt');
            $table->string('end_loc');
            $table->date('end_dt');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tour_approval_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
           	$table->unsignedBigInteger('tour_id');
           	$table->integer('act_id');
           	$table->integer('state_id');
           	$table->string('permits',255);   //Copying permits because in future may be permits get changed so it won't be possible to change history, if we store permits in this table too... then we can preserve the history
           	$table->date('date');
            $table->char('status',1)->nullable();
            $table->text('remark');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_mast');
        Schema::dropIfExists('desg_mast');
        Schema::dropIfExists('tours');
        Schema::dropIfExists('tour_approval_detail');
        Schema::dropIfExists('emp_grade_mast');     
    }
}
