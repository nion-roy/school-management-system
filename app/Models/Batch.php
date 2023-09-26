<?php

namespace App\Models;

use App\Models\StudentAdmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
	use HasFactory;
	protected $guarded = [];


	/**
	 * Get the section that owns the Batch
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function section(): BelongsTo
	{
			return $this->belongsTo(Section::class, 'section_id', 'id');
	}
}
