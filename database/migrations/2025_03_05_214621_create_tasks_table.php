<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['Pending', 'Completed', 'Overdue']);
            $table->date('due_date')->nullable(); // Due date
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium'); // Priority
            $table->unsignedBigInteger('user_id');
            $table->integer('position')->default(0); // For ordering
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
