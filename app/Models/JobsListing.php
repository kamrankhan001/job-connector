<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsListing extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'description', 'requirements', 'location', 'salary', 'job_type'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'jobs_listings_id', 'id');
    }
}
