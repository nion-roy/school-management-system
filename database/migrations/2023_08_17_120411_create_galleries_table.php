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
		Schema::create('galleries', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug');
			$table->string('gallery_type');
			$table->text('description');
			$table->boolean('status')->default(true);
			$table->string('gallery')->default('default.png');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('galleries');
	}
};