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
		Schema::create('students', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('student_id');
			$table->unsignedBigInteger('class_id');
			$table->integer('roll');
			$table->string('register');
			$table->string('session');
			$table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('class_id')->references('id')->on('batches')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('students');
	}
};
