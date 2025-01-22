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
        <div
            class="block w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6">
            <h1 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="text-lg">"Keep pushing forward in your job search. The right opportunity is out there waiting for
                you!"</p>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <!-- Profile Summary -->
            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6 flex flex-col">
                <h2 class="text-xl font-semibold mb-4">Portfolio Summary</h2>
                @if (request()->user()->jobseeker)
                    <div>
                        <div>
                            <div class="mb-1 text-base font-medium text-green-700 dark:text-green-500">
                                Profile completion: <span class="font-bold">85%</span>
                            </div>
                            <div class="mt-2">
                                <div class="bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-green-500 h-2.5 rounded-full" style="width: 85%;"></div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('portfolio.edit', ['portfolio' => request()->user()->jobseeker]) }}"
                            class="text-blue-500 mt-auto inline-block">Edit Portfolio</a>

                    </div>
                @else
                    <div class="flex justify-center items-center h-full">
                        <a href="{{ route('portfolio.create') }}"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-2 mb-2">create Portfolio</a>
                    </div>
                @endif
            </div>

            <!-- Job Application Status -->
            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6 flex flex-col">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Job Application Status</h2>
                    <ul class="space-y-2 text-gray-500 dark:text-gray-400">
                        <li class="flex items-center">
                            <x-heroicon-m-clock class="w-5 h-5 text-yellow-500 mr-3" />
                            Pending: {{ $pendingApplications }}
                        </li>
                        <li class="flex items-center">
                            <x-heroicon-m-arrow-trending-up class="w-5 h-5 text-blue-500 mr-3" />
                            In Progress: {{ $progressApplications }}
                        </li>
                        <li class="flex items-center">
                            <x-heroicon-m-check-circle class="w-5 h-5 text-green-500 mr-3" />
                            Accepted: {{ $acceptedApplications }}
                        </li>
                        <li class="flex items-center">
                            <x-heroicon-m-x-circle class="w-5 h-5 text-red-500 mr-3" />
                            Rejected: {{ $rejectedApplications }}
                        </li>
                    </ul>
                </div>
                <a href="{{ route('job-seeker.applications') }}" class="text-blue-500 mt-auto inline-block">View All
                    Applications</a>
            </div>

            <!-- Notification Center -->
            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-6 flex flex-col">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Notification Center</h2>
                    <ul class="space-y-2 text-gray-700 dark:text-gray-400">
                        <li class="flex items-start">
                            <x-heroicon-m-bell class="w-5 h-5 text-yellow-500 mr-3" />
                            <div class="flex-1">
                                <p class="font-semibold">New Job Alert</p>
                                <p class="text-sm">5 new job alerts that match your profile.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <x-heroicon-m-calendar class="w-5 h-5 text-blue-500 mr-3" />
                            <div class="flex-1">
                                <p class="font-semibold">Profile Update Reminder</p>
                                <p class="text-sm">Don’t forget to update your profile.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <x-heroicon-m-clock class="w-5 h-5 text-green-500 mr-3" />
                            <div class="flex-1">
                                <p class="font-semibold">Interview Scheduled</p>
                                <p class="text-sm">Your interview is scheduled for next week.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <a href="#" class="text-blue-500 mt-auto inline-block">View All Notifications</a>
            </div>
        </div>
    </div>
</x-app-layout>
