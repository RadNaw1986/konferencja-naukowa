<?php
// Sprawdzenie czy dane zostały wysłane metodą POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Pobranie danych z formularza
    $name = $_POST['name'] ?? '';
    $affiliation = $_POST['affiliation'] ?? '';
    $academicTitle = $_POST['academic-title'] ?? '';
    $abstract = $_POST['abstract'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Adres email, na który będą wysyłane zgłoszenia
    $to = 'twoja@skrzynka.pocztowa';

    // Temat wiadomości email
    $subject = 'Nowe zgłoszenie na konferencję';

    // Treść wiadomości email
    $message = "Nowe zgłoszenie na konferencję:\n\n";
    $message .= "Imię i nazwisko: $name\n";
    $message .= "Afiliacja: $affiliation\n";
    $message .= "Tytuł naukowy: $academicTitle\n";
    $message .= "Abstrakt: $abstract\n";
    $message .= "Email: $email\n";
    $message .= "Nr telefonu: $phone\n";

    // Nagłówki wiadomości email
    $headers = "From: $email";

    // Wysłanie wiadomości email
    if (mail($to, $subject, $message, $headers)) {
        // Przekierowanie użytkownika po udanym wysłaniu formularza
        header('Location: https://radnaw.pl/podziekowanie.html');
        exit;
    } else {
        // Obsługa błędu, jeśli nie udało się wysłać wiadomości
        echo 'Wystąpił problem podczas przetwarzania zgłoszenia. Spróbuj ponownie później.';
    }
} else {
    // Obsługa błędu, jeśli żądanie nie zostało wysłane metodą POST
    echo 'Nieprawidłowe żądanie.';
}
?>
