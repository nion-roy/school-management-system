<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserStudent extends Model
{
	use HasFactory;

	/**
	 * Get the student that owns the UserStudent
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function student(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
