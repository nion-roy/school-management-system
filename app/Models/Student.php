<?php

namespace App\Models;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
	use HasFactory;
	protected $guarded = [];

	/**
	 * Get the class that owns the Student
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function class(): BelongsTo
	{
		return $this->belongsTo(Batch::class, 'class_id', 'id');
	}

	/**
	 * Get the student that owns the Student
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function student(): BelongsTo
	{
		return $this->belongsTo(User::class, 'student_id', 'id');
	}
}
