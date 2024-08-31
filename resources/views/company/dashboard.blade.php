<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center" aria-current="page">
                    <x-heroicon-m-home class="w-5 h-5 text-gray-400 mx-1" />
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Dashboard</span>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-5">
        <!-- Welcome Message -->
        <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6">
            <h1 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="text-lg">"Manage your job postings and keep track of applications seamlessly!"</p>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Job Management -->
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6 flex flex-col">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Manage Jobs</h2>
                    <p class="text-base text-gray-500 dark:text-gray-400">Create, edit, delete, and view your job postings.</p>
                </div>
                <a href="{{ route('job.create') }}" class="btn mt-4 text-blue-500">Create New Job</a>
                <a href="{{ route('jobs') }}" class="text-blue-500 mt-auto inline-block">View All Jobs</a>
            </div>

            <!-- Applications Received -->
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6 flex flex-col">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Applications Received</h2>
                    <p class="text-base text-gray-500 dark:text-gray-400">View applications from job seekers for your posted jobs.</p>
                    <div class="mt-4">
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <x-heroicon-m-envelope class="w-5 h-5 text-blue-500 mr-3" />
                                Total Applications: 15
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-m-check-circle class="w-5 h-5 text-green-500 mr-3" />
                                Accepted: 5
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-m-x-circle class="w-5 h-5 text-red-500 mr-3" />
                                Rejected: 3
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="{{ route('applications') }}" class="text-blue-500 mt-auto inline-block">View All Applications</a>
            </div>

            <!-- Notifications -->
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6 flex flex-col">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Notifications</h2>
                    <ul class="space-y-2 text-gray-700 dark:text-gray-400">
                        <li class="flex items-start">
                            <x-heroicon-m-bell class="w-5 h-5 text-yellow-500 mr-3" />
                            <div class="flex-1">
                                <p class="font-semibold">New Application</p>
                                <p class="text-sm">You have received a new application for "Software Developer".</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <x-heroicon-m-calendar class="w-5 h-5 text-blue-500 mr-3" />
                            <div class="flex-1">
                                <p class="font-semibold">Job Expiry Reminder</p>
                                <p class="text-sm">Your job post "Frontend Developer" is expiring soon.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <a href="#" class="text-blue-500 mt-auto inline-block">View All Notifications</a>
            </div>
        </div>

        <!-- Additional Section for Stats or Charts -->
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6">
            <h2 class="text-xl font-semibold mb-4">Analytics</h2>
            <p class="text-base text-gray-500 dark:text-gray-400">Get insights into your job postings and applications.</p>
            <!-- Example Chart/Graph placeholder -->
            <div class="bg-gray-200 h-64 rounded-lg mt-4 flex items-center justify-center">
                <p class="text-gray-500">Chart/Graph Placeholder</p>
            </div>
        </div>
    </div>
</x-app-layout>
