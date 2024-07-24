<x-guest-layout>
    <form method="GET" action="#" class="my-20">
        @csrf
        <div class="flex items-center gap-4 w-full">
            <!-- Job Title -->
            <div class="relative w-full">
                <x-heroicon-m-magnifying-glass
                    class="w-6 h-6 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" />
                <input type="text" id="job" name="job"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Job Title, Keyword & Company" required autofocus autocomplete="off"/>
            </div>

            <!-- City & Country -->
            <div class="relative w-full">
                <x-heroicon-m-map-pin
                    class="w-6 h-6 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" />
                <input type="text" id="location" name="location"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Country & City" required autofocus autocomplete="off"/>
            </div>

            <button type="button"
                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-lg px-6 py-2 text-center">
                Find
            </button>
        </div>
    </form>

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
