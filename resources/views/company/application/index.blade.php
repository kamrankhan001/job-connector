<x-app-layout>
    <x-slot name="header">
        <!-- Breadcrumb Navigation -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <!-- Current Page Indicator -->
                <li class="inline-flex items-center" aria-current="page">
                    <x-heroicon-m-clipboard-document-list class="w-5 h-5 text-gray-400 mx-1" />
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Applications</span>
                </li>
            </ol>
        </nav>
    </x-slot>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-5">
        <div class="relative overflow-x-auto">
            <!-- Applications Table -->
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <!-- Table Header -->
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Job Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Applicant Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Applied At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <!-- Loop through each application and display details -->
                    @foreach ($applications as $application)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <!-- Job Title Column -->
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $application->jobsListing->title }}
                            </th>
                            <!-- Applicant Name Column -->
                            <td class="px-6 py-4">
                                {{ $application->jobSeeker->first_name }} {{ $application->jobSeeker->last_name }}
                            </td>
                            <!-- Application Status Column -->
                            <td class="px-6 py-4">
                                {{ ucfirst($application->status) }}
                            </td>
                            <!-- Applied At Column -->
                            <td class="px-6 py-4">
                                {{ $application->applied_at->format('M d, Y') }}
                            </td>
                            <!-- Actions Column -->
                            <td class="px-6 py-4">
                                <a href="{{ route('applicant.portfolio' , ['applicant'=>$application->jobSeeker->id]) }}" class="text-blue-500 hover:text-blue-700">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
