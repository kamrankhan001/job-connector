<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\JobsListing;


Broadcast::channel('job.{jobId}', function (User $user, JobsListing $jobId) {
    // Authorize the user (company) to listen to the job's channel
    if ($user->isCompany() && $user->company->jobsListing->contains('id'.$jobId)) {
        return true;
    }

    if ($user->isJobSeeker() && (int) $user->id === (int) auth()->user()->id) {
        return true;
    }

    return false;

});
