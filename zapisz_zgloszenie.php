<?php

//to jest plik formularza zgłoszeniowego, który znajduje sie na moim serwerze - załaczony jedynie poglądowo do projektu

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
    $to = 'rnawrot704@gmail.com';

    // Temat wiadomości email dla zgłoszenia
    $subject = 'Nowe zgłoszenie na konferencję';

    // Treść wiadomości email dla zgłoszenia
    $message = "Nowe zgłoszenie na konferencję:\n\n";
    $message .= "Imię i nazwisko: $name\n";
    $message .= "Afiliacja: $affiliation\n";
    $message .= "Tytuł naukowy: $academicTitle\n";
    $message .= "Abstrakt: $abstract\n";
    $message .= "Email: $email\n";
    $message .= "Nr telefonu: $phone\n";

    // Nagłówki wiadomości email dla zgłoszenia
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Wysłanie wiadomości email dla zgłoszenia
    if (mail($to, $subject, $message, $headers)) {
        // Przygotowanie wiadomości potwierdzającej dla zgłaszającego
        $confirmSubject = 'Potwierdzenie zgłoszenia na konferencję';
        $confirmMessage = "Dziękujemy za zgłoszenie na konferencję.\n\n";
        $confirmMessage .= "Otrzymaliśmy następujące dane:\n\n";
        $confirmMessage .= "Imię i nazwisko: $name\n";
        $confirmMessage .= "Afiliacja: $affiliation\n";
        $confirmMessage .= "Tytuł naukowy: $academicTitle\n";
        $confirmMessage .= "Abstrakt: $abstract\n";
        $confirmMessage .= "Email: $email\n";
        $confirmMessage .= "Nr telefonu: $phone\n";

        // Wysłanie wiadomości potwierdzającej do zgłaszającego
        if (mail($email, $confirmSubject, $confirmMessage, $headers)) {
            // Przekierowanie użytkownika po udanym wysłaniu formularza
            header('Location: https://radnaw.pl/podziekowanie');
            exit;
        } else {
            // Obsługa błędu, jeśli nie udało się wysłać wiadomości potwierdzającej
            echo 'Wystąpił problem podczas przetwarzania zgłoszenia. Spróbuj ponownie później.';
        }
    } else {
        // Obsługa błędu, jeśli nie udało się wysłać wiadomości zgłoszenia
        echo 'Wystąpił problem podczas przetwarzania zgłoszenia. Spróbuj ponownie później.';
    }
} else {
    // Obsługa błędu, jeśli żądanie nie zostało wysłane metodą POST
    echo 'Nieprawidłowe żądanie.';
}
?>