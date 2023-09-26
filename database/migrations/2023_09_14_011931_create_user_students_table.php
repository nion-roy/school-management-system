<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('user_students', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->string('father_name')->nullable();
			$table->string('mother_name')->nullable();
			$table->integer('guardian_contact')->nullable();
			$table->string('present_address')->nullable();
			$table->string('parament_address')->nullable();
			$table->enum('student_type', ['runing', 'former', 'achievement'])->default('runing');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('user_students');
	}
};
