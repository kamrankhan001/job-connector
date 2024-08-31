<x-guest-layout>
    {{-- Success Message --}}
    @if (session()->has('success'))
        <div id="message"
            class="flex items-center justify-between text-green-500 bg-green-100 border border-green-400 p-4 rounded mb-4 relative">
            {{-- Display success message from session --}}
            <span>{{ session()->get('success') }}</span>
            {{-- Close button to manually dismiss the message --}}
            <button type="button" id="close-button" class="text-green-500 hover:text-green-700">
                <x-heroicon-m-x-mark class="w-5 h-5 text-black" />
            </button>
        </div>
    @endif

    {{-- Warning Message (Shown if the user visits the job page again) --}}
    @if ($isApplied && !session()->has('success'))
        <div id="apply"
            class="flex items-center justify-between text-yellow-500 bg-yellow-100 border border-yellow-400 p-4 rounded mb-4 relative">
            {{-- Display a warning if the user has already applied for the job --}}
            <span>You already applied for this job!</span>
            {{-- Close button to manually dismiss the message --}}
            <button type="button" id="close-button" class="text-yellow-500 hover:text-yellow-700">
                <x-heroicon-m-x-mark class="w-5 h-5 text-black" />
            </button>
        </div>
    @endif

    {{-- Breadcrumb Navigation --}}
    <nav class="flex mb-10" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            {{-- Link to the job listings page --}}
            <li class="inline-flex items-center">
                <a href="{{ route('index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <x-heroicon-m-briefcase class="w-5 h-5 text-gray-400 mx-1" />
                    Jobs
                </a>
            </li>
            {{-- Current page indicator --}}
            <li aria-current="page">
                <div class="flex items-center">
                    <x-heroicon-m-chevron-right class="w-6 h-6 text-gray-400 mx-1" />
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">View</span>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Job Details Card --}}
    <div
        class="block w-full p-6 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-2">
        {{-- Job Title and Posting Date --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $job->title }}</h1>
            <div class="flex items-center text-gray-600 dark:text-gray-400">
                <x-heroicon-m-calendar class="w-5 h-5 mr-2" />
                <time datetime="{{ $job->created_at }}">{{ $job->created_at->format('M d, Y') }}</time>
            </div>
        </div>

        {{-- Job Information --}}
        <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                {{-- Salary --}}
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Salary</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $job->salary }}</dd>
                </div>
                {{-- Location --}}
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Location</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $job->location }}</dd>
                </div>
                {{-- Job Type --}}
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Job Type</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white capitalize">
                        {{ str_replace('_', ' ', $job->job_type) }}
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Job Description --}}
        <div class="mt-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Description</h2>
            <p class="mt-2 text-base text-gray-700 dark:text-gray-300">
                {!! $job->description !!}
            </p>
        </div>

        {{-- Job Requirements --}}
        <div class="mt-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Requirements</h2>
            <p class="mt-2 text-base text-gray-700 dark:text-gray-300">
                {!! $job->requirements !!}
            </p>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex justify-end gap-x-2 mt-5">
        {{-- Cancel Button --}}
        <a href="{{ route('index') }}"
            class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            Cancel
        </a>

        {{-- Apply Button Form --}}
        <form action="{{ route('apply.job', ['job' => $job->id]) }}" method="POST">
            @csrf
            {{-- Apply Button --}}
            <button type="submit"
                class="
                    text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2
                    {{ $isApplied ? 'bg-gray-400 cursor-not-allowed' : 'bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800' }}"
                @if ($isApplied) disabled @endif>
                {{-- Button text changes based on whether the user has applied or not --}}
                {{ $isApplied ? 'Already Applied' : 'Apply' }}
            </button>
        </form>
    </div>

    {{-- JavaScript for Success/Warning Message --}}
    <x-slot name="script">
        <script>
            $(document).ready(function() {
                // Automatically hide the success/warning message after 2 seconds
                setTimeout(function() {
                    $('#message').fadeOut('slow');
                }, 2000);

                // Allow the user to manually close the message
                $('#close-button').click(function() {
                    $('#message').fadeOut('slow');
                    $('#apply').fadeOut('slow');
                });
            });
        </script>
    </x-slot>
</x-guest-layout>
