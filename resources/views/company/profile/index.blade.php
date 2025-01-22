<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center" aria-current="page">
                    <x-heroicon-m-building-office class="w-5 h-5 text-gray-400 mx-1" />
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Company</span>
                </li>
            </ol>
        </nav>

    </x-slot>


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-5">
        @if (session()->has('success'))
            <div id="success-message"
                class="flex items-center justify-between text-green-500 bg-green-100 border border-green-400 p-4 rounded mb-4 relative">
                <span>{{ session()->get('success') }}</span>
                <button type="button" id="close-button" class="text-green-500 hover:text-green-700">
                    <x-heroicon-m-x-mark class="w-5 h-5 text-black"/>
                </button>
            </div>
        @endif
        @if (session()->has('warning'))
            <div
                class="flex items-center justify-between text-yellow-500 bg-yellow-100 border border-red-400 p-4 rounded mb-4 relative">
                <span>{{ session()->get('warning') }}</span>
            </div>
        @endif

        @if (Auth::user()->company)
            <div class="flex justify-end mb-4">
                <a href="{{ route('company.profile.edit', ['company' => Auth::user()->company->id]) }}" type="button"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    <x-heroicon-m-pencil-square class="w-5 h-5"/>
                </a>
            </div>
            <div
                class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex justify-between items-center mb-10 text-xl border-b">
                    <p>Company Name</p>
                    <p>{{ $company->company_name }}</p>
                </div>
                <div class="flex justify-between items-center mb-10 text-xl border-b">
                    <p>Company Website</p>
                    <a href="{{ $company->website }}" class="text-blue-500 hover:underline">{{ $company->website }}</a>
                </div>
                <div class="flex justify-between items-center mb-10 text-xl border-b">
                    <p>Company Phone</p>
                    <p>{{ $company->phone }}</p>
                </div>
                <div class="flex justify-between items-center text-xl border-b">
                    <p>Company Address</p>
                    <address class="not-italic">
                        {{ $company->address }}
                    </address>
                </div>
            </div>
        @else
            <div
                class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex justify-center items-center">
                    <div class="text-center">
                        <p class="mb-3">
                            You don't have any profile
                        </p>
                        <a href="{{ route('company.profile.create') }}" type="button"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Create Profile
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function() {
                // Automatically disappear after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    $('#success-message').fadeOut('slow');
                }, 5000);

                // Allow manual closing
                $('#close-button').click(function() {
                    $('#success-message').fadeOut('slow');
                });
            });
        </script>
    </x-slot>

</x-app-layout>
