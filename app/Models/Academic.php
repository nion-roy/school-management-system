<?php

namespace App\Models;

use App\Models\AcademicType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Academic extends Model
{
	use HasFactory;
	protected $guarded = [];

	/**
	 * Get the typeAcademic that owns the Academic
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function typeAcademic(): BelongsTo
	{
		return $this->belongsTo(AcademicType::class, 'academic_id', 'id');
	}
}
