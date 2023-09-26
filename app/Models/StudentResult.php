<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentResult extends Model
{
	use HasFactory;
	protected $guarded = [];

	/**
	 * Get the user that owns the StudentResult
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	/**
	 * Get the class that owns the StudentResult
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function class(): BelongsTo
	{
		return $this->belongsTo(Batch::class, 'class_id', 'id');
	}

	/**
	 * Get the subject that owns the StudentResult
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function subject(): BelongsTo
	{
		return $this->belongsTo(Subject::class, 'subject_id', 'id');
	}

	/**
	 * Get the students that owns the StudentResult
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function students(): BelongsTo
	{
		return $this->belongsTo(Student::class, 'student_roll', 'id') ;
	}
}
