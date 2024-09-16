<x-guest-layout>
    <!-- Search Form -->
    <form method="GET" action="{{ route('find.jobs') }}" class="my-4 md:my-8">
        <div class="flex flex-col md:flex-row items-center gap-4 w-full">
            <!-- Job Title -->
            <div class="relative w-full md:w-1/2">
                <x-heroicon-o-magnifying-glass
                    class="w-6 h-6 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" />
                <input type="text" id="job" name="job" value="{{ $title ?? '' }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                    placeholder="Job" autofocus autocomplete="off" />
            </div>

            <!-- City & Country -->
            <div class="relative w-full md:w-1/2">
                <x-heroicon-o-map-pin
                    class="w-6 h-6 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" />
                <input type="text" id="places" name="location" value="{{ $location ?? '' }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                    placeholder="Location" autocomplete="off" />
                <div id="places-results"
                    class="max-h-[200px] overflow-y-auto absolute z-[1000] mt-1 border border-gray-300 rounded-lg bg-white shadow-lg">
                </div>
            </div>

            <button type="submit"
                class="mt-4 md:mt-0 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-6 py-2 text-center">
                Find
            </button>
        </div>
    </form>

    <!-- Filter Form -->
    <form action="{{ route('filter.jobs') }}" id="filter_jobs" class="mb-8">
        <div>
            <p class="flex gap-1 items-center mb-3 text-lg">
                <x-heroicon-o-funnel class="w-6 h-6 text-gray-500" />
                Filters
            </p>

            <input type="hidden" name="job" value="{{ request('job', $title ?? '') }}" />
            <input type="hidden" name="location" value="{{ request('location', $location ?? '') }}" />

            <!-- Filter by date -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-calendar class="w-8 h-8 text-gray-500" />
                    <select id="date" name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="year" {{ request('date') == 'year' ? 'selected' : '' }}>1 year ago</option>
                        <option value="hour" {{ request('date') == 'hour' ? 'selected' : '' }}>1 hour ago</option>
                        <option value="day" {{ request('date') == 'day' ? 'selected' : '' }}>1 Day ago</option>
                        <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>1 month ago</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <x-heroicon-o-banknotes class="w-8 h-8 text-gray-500" />
                    <select id="salary" name="salary"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="100_5000" {{ request('salary') == '100_5000' ? 'selected' : '' }}>$100 - $5000
                        </option>
                        <option value="100_200" {{ request('salary') == '100_200' ? 'selected' : '' }}>$100 - $200
                        </option>
                        <option value="200_400" {{ request('salary') == '200_400' ? 'selected' : '' }}>$200 - $400
                        </option>
                        <option value="400_1000" {{ request('salary') == '400_1000' ? 'selected' : '' }}>$400 - $1000
                        </option>
                        <option value="1000_5000" {{ request('salary') == '1000_5000' ? 'selected' : '' }}>$1000 -
                            $5000</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <x-heroicon-o-clock class="w-8 h-8 text-gray-500" />
                    <select id="job_type" name="job_type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected' : '' }}>Full time
                        </option>
                        <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part time
                        </option>
                        <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Contract
                        </option>
                        <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>
                            Internship</option>
                    </select>
                </div>
            </div>
        </div>
    </form>

    <!-- Job Listings -->
    @if (!$jobs->isEmpty())
        @foreach ($jobs as $job)
            <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 mb-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="md:w-3/4">
                        <!-- Job Title with Link -->
                        <a href="{{ route('job', ['job' => $job->id]) }}" class="text-lg font-semibold block mb-2">
                            {{ $job->title }}
                        </a>
                        <!-- Truncated Job Description -->
                        <p class="mb-2">
                            {{ Str::limit($job->description, 200) }}
                        </p>
                        <!-- Human-Readable Date -->
                        <time class="text-sm text-gray-500">
                            {{ $job->created_at->diffForHumans() }}
                        </time>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="my-4">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex justify-center items-center">
                <div class="text-center">
                    <p class="mb-3">
                        Sorry, we can't find any job.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <x-slot name="script">
        <script src="{{ asset('assets/js/places.js') }}"></script>
        <script>
            $(document).ready(function() {
                // AJAX call for job filtering
                $('#filter_jobs select').change(function() {
                    $('#filter_jobs').submit();
                });
            });
        </script>
    </x-slot>
</x-guest-layout>
