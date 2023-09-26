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
		Schema::create('exams', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('class_id');
			$table->string('title');
			$table->string('slug');
			$table->string('type');
			$table->string('pdf')->default('default.pdf');
			$table->integer('view_count')->default(0);
			$table->boolean('status')->default(true);
			$table->foreign('class_id')->references('id')->on('batches')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('exams');
	}
};
