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
		Schema::create('academics', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('academic_id');
			$table->string('pdf')->default('default.pdf');
			$table->string('status')->default(true);
			$table->foreign('academic_id')->references('id')->on('academic_types')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('academics');
	}
};
