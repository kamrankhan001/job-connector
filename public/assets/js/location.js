$(document).ready(function() {
    // Track the timer to limit the API calls when typing
    let typingTimer;
    const typingDelay = 300; // Delay in milliseconds

    $('#location').on('keyup', function() {
        clearTimeout(typingTimer);

        const query = $(this).val().trim();
        if (query.length < 3) {
            $('.suggestions-box').empty().addClass('hidden');
            return; // Don't search if less than 3 characters
        }

        typingTimer = setTimeout(() => fetchSuggestions(query), typingDelay);
    });

    function fetchSuggestions(query) {
        $.ajax({
                method: 'GET',
                url: 'https://api.geoapify.com/v1/geocode/autocomplete',
                data: {
                    text: query,
                    apiKey: 'f4d75014a09a496d9fcc493eb5f12c17'
                }
            })
            .done(function(result) {
                displaySuggestions(result.features);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log('Error:', textStatus, errorThrown);
            });
    }

    function displaySuggestions(suggestions) {
        const suggestionsBox = $('.suggestions-box');
        suggestionsBox.empty();

        if (suggestions.length === 0) {
            suggestionsBox.append(
                    '<div class="suggestion-item p-2 text-gray-700">No suggestions found</div>')
                .removeClass('hidden');
            return;
        }

        suggestions.forEach((suggestion) => {
            const suggestionItem = $(
                    '<div class="suggestion-item p-2 text-gray-700 hover:bg-gray-100 cursor-pointer"></div>'
                    )
                .text(suggestion.properties.formatted);
            suggestionItem.on('click', function() {
                $('#location').val(suggestion.properties.formatted);
                suggestionsBox.empty().addClass('hidden');
            });
            suggestionsBox.append(suggestionItem);
        });

        // Show the suggestions box only if there are suggestions
        if (suggestions.length > 0) {
            suggestionsBox.removeClass('hidden');
        } else {
            suggestionsBox.addClass('hidden');
        }
    }

    // Hide suggestions when clicking outside the input
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#location, .suggestions-box').length) {
            $('.suggestions-box').empty().addClass('hidden');
        }
    });
});
