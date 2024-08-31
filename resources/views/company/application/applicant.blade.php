<x-app-layout>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('applications') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <x-heroicon-m-clipboard-document-list class="w-5 h-5 text-gray-400 mx-1" />
                        Applications
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <x-heroicon-m-chevron-right class="w-6 h-6 text-gray-400 mx-1" />
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Applicant</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-5">
        <div
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mt-5">
            <div>
                <div class="flex justify-between items-center mb-4 text-xl border-b">
                    <p>First Name</p>
                    <p>{{ $applicant->first_name }}</p>
                </div>
                <div class="flex justify-between items-center mb-4 text-xl border-b">
                    <p>Last Name</p>
                    <p>{{ $applicant->last_name }}</p>
                </div>
                <div class="flex justify-between items-center mb-4 text-xl border-b">
                    <p>Phone</p>
                    <p>{{ $applicant->phone }}</p>
                </div>
                <div class="flex justify-between items-center text-xl border-b">
                    <p>Address</p>
                    <address class="not-italic">
                        {{ $applicant->address }}
                    </address>
                </div>
            </div>
        </div>
        <div
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mt-5">
            <iframe src="{{ Storage::url($applicant->resume) }}" class="w-full h-[500px] border rounded-lg"></iframe>
        </div>
    </div>

    </div>
</x-app-layout>
