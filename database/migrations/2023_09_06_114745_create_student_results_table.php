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
		Schema::create('student_results', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('class_id');
			$table->unsignedBigInteger('subject_id');
			$table->unsignedBigInteger('student_roll');
			$table->integer('mark');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('class_id')->references('id')->on('batches')->onDelete('cascade');
			$table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
			$table->foreign('student_roll')->references('id')->on('students')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('student_results');
	}
};
