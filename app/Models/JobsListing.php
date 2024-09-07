<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JobsListing extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'description', 'requirements', 'location', 'salary', 'job_type'];

    // Scope for filtering by location
    public function scopeByLocation(Builder $query, ?string $location): Builder
    {
        if ($location) {
            return $query->where('location', 'like', '%' . $location . '%');
        }
        return $query;
    }

    // Scope for filtering by job title
    public function scopeByTitle(Builder $query, ?string $title): Builder
    {
        if ($title) {
            return $query->where('title', 'like', '%' . $title . '%');
        }
        return $query;
    }

    // Scope for filtering by job type
    public function scopeByJobType(Builder $query, ?string $jobType): Builder
    {
        if ($jobType) {
            return $query->where('job_type', $jobType);
        }
        return $query;
    }

    // Scope for filtering by posted date
    // Scope for filtering by posted date
    // Scope for filtering by posted date relative to the current time
    public function scopeByPostedDate(Builder $query, ?string $postedDate): Builder
    {
        if (!empty($postedDate)) {
            switch ($postedDate) {
                case 'hour':
                    $query->where('created_at', '>=', Carbon::now()->subHour());
                    break;
                case 'day':
                    $query->where('created_at', '>=', Carbon::now()->subDay());
                    break;
                case 'month':
                    $query->where('created_at', '>=', Carbon::now()->subMonth());
                    break;
                case 'year':
                    $query->where('created_at', '>=', Carbon::now()->subYear());
                    break;
            }
        }
        return $query;
    }

    public function scopeBySalary(Builder $query, string $start, string $end): Builder
    {
        return $query->whereBetween('salary', [$start, $end]);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'jobs_listings_id', 'id');
    }
}
