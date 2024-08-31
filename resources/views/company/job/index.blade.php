<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center" aria-current="page">
                    <x-heroicon-m-briefcase class="w-5 h-5 text-gray-400 mx-1" />
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Jobs</span>
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
                    <x-heroicon-m-x-mark class="w-5 h-5 text-black" />
                </button>
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ url('/company/job/create') }}"
                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                <x-heroicon-m-plus class="w-5 h-5" />
            </a>
        </div>

        @if(!$jobs->isEmpty())
            @foreach ($jobs as $job)
                <div
                    class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-2">
                    <div class="flex justify-between items-center">
                        <div>
                            <a href="{{ route('job.show', ['job' => $job->id]) }}"
                                class="text-lg font-semibold block">{{ $job->title }}</a>
                            <time
                                class="text-sm text-gray-500 dark:text-gray-400">{{ $job->created_at->format('M d, Y H:i') }}</time>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('job.edit', ['job' => $job->id]) }}"
                                class="text-blue-500 hover:text-blue-700">
                                Edit
                            </a>
                            <button data-job-id="{{ $job->id }}" data-modal-target="delete-modal"
                                data-modal-toggle="delete-modal" class="delete-button text-red-500 hover:text-red-700">
                                Delete
                            </button>
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
                            You don't post any job yet
                        </p>
                        <a href="{{ route('job.create') }}" type="button"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Post Job
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Delete Modal -->
        <div id="delete-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Confirm Deletion
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="delete-modal">
                            <x-heroicon-m-x-mark class="w-5 h-5" />
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Are you sure you want to delete this job?
                        </p>
                        <form id="delete-form" method="POST" action="{{ route('job.destroy', ['job' => '__id__']) }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="job_id" id="job-id-input" value="">
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button id="confirm-delete" type="button"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Yes</button>
                        <button data-modal-hide="delete-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No</button>
                    </div>
                </div>
            </div>
        </div>

        <div>
            {{ $jobs->links() }}
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function() {
                // Automatically disappear after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    $('#success-message').fadeOut('slow');
                }, 2000);

                // Allow manual closing
                $('#close-button').click(function() {
                    $('#success-message').fadeOut('slow');
                });

                // Set job ID in the modal
                $('.delete-button').click(function() {
                    const jobId = $(this).data('job-id');
                    $('#job-id-input').val(jobId);
                    $('#delete-form').attr('action', $('#delete-form').attr('action').replace('__id__', jobId));
                });

                // Confirm delete button click event
                $('#confirm-delete').click(function() {
                    $('#delete-form').submit();
                });
            });
        </script>
    </x-slot>
</x-app-layout>
