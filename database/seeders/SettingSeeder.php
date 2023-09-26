<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('settings')->insert([
			'wb_name'		=> 'laravel',
			'wb_logo'		=> 'laravel.png',
			'wb_favicon'		=> 'laravel.png',
		]);
	}
}
