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
        <div id="success-message"
            class="hidden items-center justify-between text-green-500 bg-green-100 border border-green-400 p-4 rounded mb-4 relative">
            <span id="success-text"></span>
            <button type="button" id="close-button" class="text-green-500 hover:text-green-700">
                <x-heroicon-m-x-mark class="w-5 h-5 text-black" />
            </button>
        </div>

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
                                <select id="application_status" name="application_status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    onchange="changeStatus({{ $application->id }})">
                                    <option value="applied" {{ $application->status == 'applied' ? 'selected' : '' }}>
                                        Applied</option>
                                    <option value="reviewed" {{ $application->status == 'reviewed' ? 'selected' : '' }}>
                                        Reviewed</option>
                                    <option value="interviewed"
                                        {{ $application->status == 'interviewed' ? 'selected' : '' }}>Interviewed
                                    </option>
                                    <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired
                                    </option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                </select>
                            </td>
                            <!-- Applied At Column -->
                            <td class="px-6 py-4">
                                {{ $application->applied_at->format('M d, Y') }}
                            </td>
                            <!-- Actions Column -->
                            <td class="px-6 py-4">
                                <a href="{{ route('applicant.portfolio', ['applicant' => $application->jobSeeker->id]) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-slot name="script">
        {{-- <script src="{{ asset('assets/js/showMessages.js') }}"></script> --}}
        <script>
            async function changeStatus(applicationId) {
                // Get the selected status
                const status = $(`#application_status`).val();

                try {
                    // Use a URL generation approach in JavaScript
                    const url = `{{ route('application.status.change', ['application' => ':applicationId']) }}`.replace(
                        ':applicationId', applicationId);

                    // Send the Axios request using async/await
                    const response = await axios.get(url, {
                        params: {
                            status: status
                        }
                    });

                    // Handle success
                    if (response.data.success) {
                        // Reset visibility state: remove hidden and add flex before showing the message
                        $("#success-message").removeClass('hidden').addClass('flex').show();

                        // Update the text with the success message
                        $("#success-text").text(response.data.message);

                        // Fade out after 2 seconds
                        setTimeout(function() {
                            $('#success-message').fadeOut('slow', function() {
                                // After fade out, hide the element and adjust classes
                                $(this).addClass('hidden').removeClass('flex');
                            });
                        }, 2000);

                        // Allow manual closing
                        $('#close-button').click(function() {
                            $('#success-message').fadeOut('slow');
                            $("#success-message").addClass('flex').removeClass('hidden');
                        });
                    }


                } catch (error) {
                    // Handle error
                    alert('Failed to update application status.');
                    console.error(error.response.data); // Optional: For debugging purposes
                }
            }
        </script>
    </x-slot>

</x-app-layout>
