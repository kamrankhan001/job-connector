$(document).ready(function() {
    $('#dropzone-file').on('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type === 'application/pdf') {
            const fileURL = URL.createObjectURL(file);
            $('#resume-preview').html(
                `<iframe src="${fileURL}" class="w-full h-full border-none rounded-lg"></iframe>`
            );
            $('#preview-title').hide(); // Hide the "Preview Resume" text
        } else {
            alert('Please upload a valid PDF file.');
            $('#resume-preview').html(''); // Clear the preview if not a PDF
            $('#preview-title')
                .show(); // Show the "Preview Resume" text if no valid PDF is uploaded
        }
    });
});
