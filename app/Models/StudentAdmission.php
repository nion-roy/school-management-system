<?php

namespace App\Models;

use App\Models\Batch;
use App\Models\Payment;
use App\Models\AdmissionDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAdmission extends Model
{
	use HasFactory;
	protected $guarded = [];

	/**
	 * Get the admission that owns the AdmissionDetails
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function admission_subjects(): BelongsTo
	{
		return $this->belongsTo(AdmissionDetails::class, 'subject_id', 'id');
	}

	/**
	 * Get the payment that owns the StudentAdmission
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function payment(): BelongsTo
	{
		return $this->belongsTo(Payment::class, 'payment_id', 'id');
	}


	/**
	 * Get the batch that owns the StudentAdmission
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function batch(): BelongsTo
	{
		return $this->belongsTo(Batch::class);
	}
}
