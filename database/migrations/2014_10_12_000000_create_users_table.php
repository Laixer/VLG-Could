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

        Schema::create('project_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
        });

        Schema::create('project_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority')->default(1);
            $table->string('name', 30);
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('number', 30);
            $table->string('reference', 30);
            $table->text('note');
            $table->integer('owner_user_id')->unsigned();
            $table->integer('client_company_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->foreign('field_id')->references('id')->on('project_fields');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('project_statuses');
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

        Schema::create('project_todos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message', 60);
            $table->boolean('done')->default(0);
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('location', 120);
            $table->string('mime', 60);
            $table->boolean('done')->default(0);
            $table->integer('version')->unsigned()->nullable();
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->integer('todo_id')->unsigned()->nullable();
            $table->foreign('todo_id')->references('id')->on('project_todos');
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
        Schema::dropIfExists('reports');
        Schema::dropIfExists('project_todos');
        Schema::dropIfExists('project_threads');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_statuses');
        Schema::dropIfExists('project_fields');
    }
}
