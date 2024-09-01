<x-app-layout>
    <!-- Breadcrumb navigation for job creation -->
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <!-- Link to Jobs page -->
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
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Create</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-5">
        <!-- Form container with styling for dark and light modes -->
        <div
            class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <!-- Form for creating a job -->
            <form action="{{ route('job.store') }}" method="POST">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <!-- Job Title input field -->
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job Title</label>
                        <input type="text" id="title" name="title" placeholder="e.g., Graphic Designer" value="{{ old('title') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Salary input field -->
                    <div>
                        <label for="salary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                        <input type="number" id="salary" name="salary" placeholder="e.g., 50000.00" value="{{ old('salary') }}" step="0.01"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                        @error('salary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location input field with autocomplete feature -->
                    <div class="relative">
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                        <input type="text" id="location" name="location" placeholder="Type a location..." autocomplete="off"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div class="suggestions-box hidden absolute w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1 z-10">
                            <!-- Suggestions will be displayed here -->
                        </div>
                    </div>

                    <!-- Job Type selection -->
                    <div>
                        <label for="job_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job Type</label>
                        <select id="job_type" name="job_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="full_time" {{ old('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('job_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Description text area -->
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" name="description" rows="5" placeholder="Provide a detailed job description..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Requirements text area -->
                    <div>
                        <label for="requirements" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Requirements</label>
                        <textarea id="requirements" name="requirements" rows="5" placeholder="List required skills and qualifications..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>{{ old('requirements') }}</textarea>
                        @error('requirements')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Back button to company jobs and Submit button -->
                <div class="flex justify-end gap-x-2">
                    <!-- Back button to Company Jobs -->
                    <a href="{{ route('jobs') }}"
                        class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancel
                    </a>
                    <!-- Create Job button -->
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Additional scripts -->
    <x-slot name="script">
        <script src="{{ asset('assets/js/location.js') }}"></script>
    </x-slot>
</x-app-layout>
