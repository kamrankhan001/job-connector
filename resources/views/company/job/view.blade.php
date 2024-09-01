<x-app-layout>
    <!-- Header slot defining breadcrumb navigation -->
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <!-- Breadcrumb link to the Jobs index page -->
                <li class="inline-flex items-center">
                    <a href="{{ route('jobs') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <x-heroicon-m-briefcase class="w-5 h-5 text-gray-400 mx-1" />
                        Job
                    </a>
                </li>
                <!-- Current page indicator -->
                <li aria-current="page">
                    <div class="flex items-center">
                        <x-heroicon-m-chevron-right class="w-6 h-6 text-gray-400 mx-1" />
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">View</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Job details card -->
        <div
            class="block w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-2">
            <!-- Job title and creation date -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $job->title }}</h1>
                <div class="flex items-center text-gray-600 dark:text-gray-400">
                    <x-heroicon-m-calendar class="w-5 h-5 mr-2" />
                    <time datetime="{{ $job->created_at }}">{{ $job->created_at->format('M d, Y') }}</time>
                </div>
            </div>

            <!-- Job details section with salary, location, and job type -->
            <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                    <!-- Salary -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Salary</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $job->salary }}</dd>
                    </div>
                    <!-- Location -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Location</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $job->location }}</dd>
                    </div>
                    <!-- Job type -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Job Type</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white capitalize">
                            {{ str_replace('_', ' ', $job->job_type) }}
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Job description section -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Description</h2>
                <p class="mt-2 text-base text-gray-700 dark:text-gray-300">
                    {{ $job->description }}
                </p>
            </div>

            <!-- Job requirements section -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Requirements</h2>
                <p class="mt-2 text-base text-gray-700 dark:text-gray-300">
                    {{ $job->requirements }}
                </p>
            </div>
        </div>
        <!-- Back button linking to the company.jobs route -->
        <div class="flex justify-end">
            <a href="{{ route('jobs') }}"
                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Back
            </a>
        </div>
    </div>
</x-app-layout>
