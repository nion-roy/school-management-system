<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeed extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('users')->insert([
			[
				// Admin seeder
				'name'			=> 'Admin',
				'email'			=> 'admin@gmail.com',
				'role'			=> 'admin',
				'status'    => 	true,
				'password'	=> Hash::make('12345678'),
			],
			[
				// User seeder
				'name'			=> 'Teacher',
				'email'			=> 'teacher@gmail.com',
				'role'			=> 'teacher',
				'status'    => 	true,
				'password'	=> Hash::make('12345678'),
			],
			[
				// User seeder
				'name'			=> 'User',
				'email'			=> 'user@gmail.com',
				'role'			=> 'user',
				'status'    => 	true,
				'password'	=> Hash::make('12345678'),
			],
		]);
	}
}
