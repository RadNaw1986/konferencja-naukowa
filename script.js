// Skrypt do obsługi formularza zgłoszeniowego

const form = document.querySelector('#registration-form');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Pobierz wartości z pól formularza
    const name = document.querySelector('#name').value;
    const affiliation = document.querySelector('#affiliation').value;
    const academicTitle = document.querySelector('#academic-title').value;
    const abstract = document.querySelector('#abstract').value;
    const email = document.querySelector('#email').value;
    const phone = document.querySelector('#phone').value;
    
    // Obiekt z danymi do wysłania
    const formData = {
        name: name,
        affiliation: affiliation,
        academicTitle: academicTitle,
        abstract: abstract,
        email: email,
        phone: phone
    };
git add index.html script.js style.css

        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Wystąpił problem podczas wysyłania zgłoszenia.');
        }
        return response.json();
    })
    .then(data => {
        console.log('Odpowiedź serwera:', data);
        alert('Zgłoszenie zostało pomyślnie wysłane!');
        form.reset(); // Opcjonalnie: Wyczyść formularz po wysłaniu
    })
    .catch(error => {
        console.error('Błąd:', error);
        alert('Wystąpił problem podczas wysyłania zgłoszenia. Spróbuj ponownie później.');
    });
});
