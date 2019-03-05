<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->string('assigned_to')->nullable();
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->string('subject')->nullable();
            $table->integer('done_ratio')->default(0);
            $table->double('estimated_hours')->default(0.00);
            $table->string('priority')->nullable();
            $table->string('status')->nullable();
            $table->string('tracker')->nullable();
            $table->string('start_date')->nullable();
            $table->string('closed_on')->nullable();
            $table->string('created_on')->nullable();
            $table->string('updated_on')->nullable();
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
        Schema::dropIfExists('issues');
    }
}
