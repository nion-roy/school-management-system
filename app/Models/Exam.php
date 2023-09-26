<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
	use HasFactory;
	protected $guarded = [];

	/**
	 * Get the class that owns the Result
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function class(): BelongsTo
	{
		return $this->belongsTo(Batch::class, 'class_id', 'id');
	}
}
