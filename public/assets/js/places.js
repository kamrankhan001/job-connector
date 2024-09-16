// Function to display address autocomplete results
function displayAutocompleteResults(results) {
    let resultsContainer = $('#places-results');
    resultsContainer.empty();

    results.features.forEach(function (feature) {
        let address = feature.properties.formatted;
        resultsContainer.append(`<div class="places px-4 py-2 cursor-pointer hover:bg-gray-100">${address}</div>`);
    });

    $('.places').on('click', function () {
        $('#places').val($(this).text());
        resultsContainer.empty();
    });
}

// Function to fetch autocomplete suggestions from the Laravel controller using async/await
async function fetchAutocomplete(query) {
    try {
        const response = await axios.get('/places', {
            params: {
                text: query
            }
        });
        displayAutocompleteResults(response.data);
    } catch (error) {
        console.error('Failed to fetch address suggestions:', error);
    }
}


// Event listener for the address input field
$('#places').on('input', function () {
    let query = $(this).val();
    if (query.length > 2) {
        fetchAutocomplete(query);
    } else {
        $('#places-results').empty();
    }
});

// Adjust the width of the address-results to match the input
$('#places').on('focus', function () {
    $('#places-results').width($(this).outerWidth());
});
