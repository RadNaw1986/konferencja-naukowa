// Skrypt do obsługi formularza zgłoszeniowego
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#registration-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Pobierz wartości z pól formularza
        const formData = new FormData(form);

        // Wysłanie danych za pomocą Fetch API
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Wystąpił problem podczas wysyłania zgłoszenia.');
            }
            return response.text(); // Zmieniono na `response.text()` dla obsługi zwykłych odpowiedzi
        })
        .then(data => {
            console.log('Odpowiedź serwera:', data);
            alert('Zgłoszenie zostało pomyślnie wysłane!');
            form.reset(); // Wyczyść formularz po wysłaniu
        })
        .catch(error => {
            console.error('Błąd:', error);
            alert('Wystąpił problem podczas wysyłania zgłoszenia. Spróbuj ponownie później.');
        });
    });
});
