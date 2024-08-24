<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobs_listings_id', 'job_seeker_id', 'cover_letter', 'status', 'applied_at',
    ];

    public function jobsListing()
    {
        return $this->belongsTo(JobsListing::class);
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }
}
