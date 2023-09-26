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
		Schema::create('settings', function (Blueprint $table) {
			$table->id();
			$table->string('wb_name')->nullable();
			$table->string('wb_logo')->nullable()->default('default.png');
			$table->string('wb_favicon')->nullable()->default('default.png');
			$table->string('number_1')->nullable();
			$table->string('number_2')->nullable();
			$table->string('number_3')->nullable();
			$table->string('facebook')->nullable();
			$table->string('twiter')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('instagram')->nullable();
			$table->string('email')->nullable();
			$table->string('address')->nullable();
			$table->mediumText('iframe')->nullable();
			$table->string('banner')->nullable()->default('default.png');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('settings');
	}
};
