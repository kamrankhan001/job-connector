<x-guest-layout>
    <form method="GET" action="{{ route('find.job') }}" class="my-20">
        <div class="flex items-center gap-4 w-full">
            <!-- Job Title -->
            <div class="relative w-full">
                <x-heroicon-m-magnifying-glass
                    class="w-6 h-6 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" />
                <input type="text" id="job" name="job" value="{{ $job ?? ''}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Job Title, Keyword & Company" required autofocus autocomplete="off" />
            </div>

            <!-- City & Country -->
            <div class="relative w-full">
                <x-heroicon-m-map-pin
                    class="w-6 h-6 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" />
                <input type="text" id="location" name="location" value="{{ $location ?? '' }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Country & City" required autofocus autocomplete="off" />
            </div>

            <button type="submit"
                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-lg px-6 py-2 text-center">
                Find
            </button>
        </div>
    </form>

    <nav class="flex mb-10" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li aria-current="page">
                <div class="flex items-center">
                    <x-heroicon-m-briefcase class="w-5 h-5 text-gray-400 mx-1" />
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Jobs</span>
                </div>
            </li>
        </ol>
    </nav>

    @if (!$jobs->isEmpty())
        @foreach ($jobs as $job)
            <div
                class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-2">
                <div class="flex justify-between items-center">
                    <div>
                        <!-- Job Title with Link -->
                        <a href="{{ route('job', ['job' => $job->id]) }}" class="text-lg font-semibold block">
                            {{ $job->title }}
                        </a>
                        <!-- Truncated Job Description -->
                        <p>
                            {{ Str::limit($job->description, 200) }}
                        </p>
                        <!-- Human-Readable Date -->
                        <time class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $job->created_at->diffForHumans() }}
                        </time>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div
            class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
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
        <script>
            $(document).ready(function() {
                $("#location").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "{{ route('autocomplete.locations') }}",
                            method: "GET",
                            data: {
                                term: request.term
                            },
                            success: function(data) {
                                let cities = typeof data === "string" ? JSON.parse(data) : data;
                                response($.map(cities, function(city) {
                                    return {
                                        label: city.city + ", " + city.country,
                                        value: city.city
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        console.log("Selected: " + ui.item.label);
                    }
                });
            });
        </script>
    </x-slot>
</x-guest-layout>
