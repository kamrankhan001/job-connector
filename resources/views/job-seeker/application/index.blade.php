<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center" aria-current="page">
                    <x-heroicon-m-clipboard-document-list class="w-5 h-5 text-gray-400 mx-1" />
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Applications</span>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-5">
        <div class="relative overflow-x-auto">
            @if ($applications->isEmpty())
                <p class="text-gray-500">You have not applied for any jobs yet.</p>
            @else
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Job
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Company
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Applied Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($application->jobsListing->title)
                                        <a href="{{route('job', ['job'=>$application->jobsListing->id])}}"
                                            class="hover:text-blue-500"
                                            >
                                            {{ $application->jobsListing->title }}
                                        </a>
                                    @else
                                        Job Listing Removed
                                    @endif
                                </th>
                                <td class="px-6 py-4">
                                    {{ $application->jobsListing->company->company_name ?? 'Company Information Unavailable' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center">
                                        @if ($application->status == 'pending')
                                            <x-heroicon-m-clock class="w-5 h-5 text-yellow-500 mr-2" />
                                        @elseif($application->status == 'in_progress')
                                            <x-heroicon-m-arrow-trending-up class="w-5 h-5 text-blue-500 mr-2" />
                                        @elseif($application->status == 'accepted')
                                            <x-heroicon-m-check-circle class="w-5 h-5 text-green-500 mr-2" />
                                        @elseif($application->status == 'rejected')
                                            <x-heroicon-m-x-circle class="w-5 h-5 text-red-500 mr-2" />
                                        @endif
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $application->applied_at->format('M, d Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
