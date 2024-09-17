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

    /**
     * Get total applications received for the company's job listings.
     *
     * @param  \App\Models\Company  $company
     * @return int
     */
    public static function totalApplicationsByCompany(Company $company): int
    {
        $jobListingsIds = $company->jobsListing()->pluck('id')->toArray();
        return self::whereIn('jobs_listings_id', $jobListingsIds)->count();
    }

    /**
     * Get total approved (hired) applications for the company's job listings.
     *
     * @param  \App\Models\Company  $company
     * @return int
     */
    public static function approvedApplicationsByCompany(Company $company): int
    {
        $jobListingsIds = $company->jobsListing()->pluck('id')->toArray();
        return self::whereIn('jobs_listings_id', $jobListingsIds)->where('status', 'hired')->count();
    }

    /**
     * Get total rejected applications for the company's job listings.
     *
     * @param  \App\Models\Company  $company
     * @return int
     */
    public static function rejectedApplicationsByCompany(Company $company): int
    {
        $jobListingsIds = $company->jobsListing()->pluck('id')->toArray();
        return self::whereIn('jobs_listings_id', $jobListingsIds)->where('status', 'rejected')->count();
    }

    public function jobsListing()
    {
        return $this->belongsTo(JobsListing::class, 'jobs_listings_id', 'id');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'job_seeker_id', 'id');
    }
}
