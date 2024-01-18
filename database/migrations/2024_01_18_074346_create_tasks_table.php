<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_title');
            $table->string('subject');
            $table->string('professor');;
            $table->text('description')->nullable();
            $table->dateTime('deadline');
            $table->dateTime('completed_at')->nullable();
            $table->softDeletes();
            $table->enum('status', [0, 1, 2, 3])->default(1); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
