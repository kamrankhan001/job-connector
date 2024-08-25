<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['jobs_listings_id', 'job_seeker_id', 'cover_letter', 'status', 'applied_at'];

    // Cast the applied_at attribute to a Carbon instance
    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function jobsListing()
    {
        return $this->belongsTo(JobsListing::class, 'jobs_listings_id', 'id');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'job_seeker_id', 'id');
    }
}
