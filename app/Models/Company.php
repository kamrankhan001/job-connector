<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'company_name', 'website', 'address', 'phone'];

    /**
     * Create a new company profile.
     *
     * @param  int  $userId
     * @param  array  $profile
     * @return self
     */
    public static function createProfile(int $userId, array $profile): self
    {
        return self::create([
            'user_id' => $userId,
            'company_name' => $profile['name'],
            'phone' => $profile['phone'],
            'website' => $profile['website'],
            'address' => $profile['address'],
        ]);
    }

    /**
     * Update the existing company profile.
     *
     * @param  array  $profile
     * @return bool
     */
    public function updateProfile(array $profile): bool
    {
        return $this->update([
            'company_name' => $profile['name'],
            'phone' => $profile['phone'],
            'website' => $profile['website'],
            'address' => $profile['address'],
        ]);
    }

    /**
     * Get all applications for the company's job listings.
     *
     * @return Collection>
     */
    public function getAllApplications(): Collection
    {
        return $this->jobsListing()
            ->with(['applications.jobSeeker', 'applications.jobsListing'])
            ->get()
            ->pluck('applications')
            ->flatten();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobsListing()
    {
        return $this->hasMany(JobsListing::class);
    }
}
