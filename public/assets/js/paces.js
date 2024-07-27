// Function to display address autocomplete results
function displayAutocompleteResults(results) {
    let resultsContainer = $('#address-results');
    resultsContainer.empty();

    results.features.forEach(function (feature) {
        let address = feature.properties.formatted;
        resultsContainer.append(`<div class="autocomplete-result px-4 py-2 cursor-pointer hover:bg-gray-100">${address}</div>
    `);
    });

    $('.autocomplete-result').on('click', function () {
        $('#address').val($(this).text());
        resultsContainer.empty();
    });
}

// Function to fetch autocomplete suggestions
function fetchAutocomplete(query) {
    $.ajax({
        url: `https://api.geoapify.com/v1/geocode/autocomplete`,
        data: {
            text: query,
            apiKey: 'f4d75014a09a496d9fcc493eb5f12c17'
        },
        success: function (response) {
            displayAutocompleteResults(response);
        },
        error: function () {
            console.error('Failed to fetch address suggestions.');
        }
    });
}

// Event listener for the address input field
$('#address').on('input', function () {
    let query = $(this).val();
    if (query.length > 2) {
        fetchAutocomplete(query);
    } else {
        $('#address-results').empty();
    }
});

// Adjust the width of the address-results to match the input
$('#address').on('focus', function () {
    $('#address-results').width($(this).outerWidth());
});
