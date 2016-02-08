<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority')->default(1);
            $table->string('name', 30);
        });

        Schema::create('report_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('number', 30);
            $table->string('reference', 30);
            $table->text('note');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('project_statuses');
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('location', 120);
            $table->boolean('done')->default(0);
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('report_types');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('project_threads', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->integer('user_id')->unsigned();
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('project_threads');
        Schema::dropIfExists('project_user');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('report_types');
        Schema::dropIfExists('project_statuses');
    }
}
