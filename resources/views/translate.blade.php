<div class="container">
    <h1>{{ translate('Translate Text') }}</h1>
    <form id="translationForm">
        <div class="form-group">
            <label for="languageSelect">{{ translate('Select language to translate:') }}</label>
            <select class="form-control" id="languageSelect" required>
                <option value="ar">{{ translate('Arabic') }}</option>
                <option value="en">{{ translate('English') }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ translate('Translate') }}</button>
    </form>
    <h3>{{ translate('Translated Text:') }}</h3>
    <div id="translatedText" class="alert alert-info" style="display:none;"></div>
</div>

<script>
    document.getElementById('translationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        const selectedLanguage = document.getElementById('languageSelect').value;

        // Send AJAX request to translate the text
        fetch('/translate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                },
                body: JSON.stringify({
                    text: '{{ translate('Your text here') }}', // Replace with the text you want to translate
                    targetLanguage: selectedLanguage
                }) // Set target language based on dropdown selection
            })
            .then(response => response.json())
            .then(data => {
                // Display translated text
                const translatedTextDiv = document.getElementById('translatedText');
                translatedTextDiv.innerText = data.translatedText;
                translatedTextDiv.style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
    });
</script>
