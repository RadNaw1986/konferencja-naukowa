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
    $toOrganizer = 'rnawrot704@gmail.com';
    $toParticipant = $email;

    // Temat wiadomości email dla zgłoszenia do organizatora
    $subjectToOrganizer = 'Nowe zgłoszenie na konferencję';

    // Treść wiadomości email dla zgłoszenia do organizatora
    $messageToOrganizer = "Nowe zgłoszenie na konferencję:\n\n";
    $messageToOrganizer .= "Imię i nazwisko: $name\n";
    $messageToOrganizer .= "Afiliacja: $affiliation\n";
    $messageToOrganizer .= "Tytuł naukowy: $academicTitle\n";
    $messageToOrganizer .= "Abstrakt: $abstract\n";
    $messageToOrganizer .= "Email: $email\n";
    $messageToOrganizer .= "Nr telefonu: $phone\n";

    // Nagłówki wiadomości email dla zgłoszenia do organizatora
    $headersToOrganizer = "From: $email\r\n";
    $headersToOrganizer .= "Reply-To: $email\r\n";
    $headersToOrganizer .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Wysłanie wiadomości email dla zgłoszenia do organizatora
    $mailToOrganizer = mail($toOrganizer, $subjectToOrganizer, $messageToOrganizer, $headersToOrganizer);

    // Temat wiadomości email dla potwierdzenia zgłoszenia dla uczestnika
    $subjectToParticipant = 'Potwierdzenie zgłoszenia na konferencję';

    // Treść wiadomości email dla potwierdzenia zgłoszenia dla uczestnika
    $messageToParticipant = "Dziękujemy za zgłoszenie na konferencję.\n\n";
    $messageToParticipant .= "Otrzymaliśmy następujące dane:\n\n";
    $messageToParticipant .= "Imię i nazwisko: $name\n";
    $messageToParticipant .= "Afiliacja: $affiliation\n";
    $messageToParticipant .= "Tytuł naukowy: $academicTitle\n";
    $messageToParticipant .= "Abstrakt: $abstract\n";
    $messageToParticipant .= "Email: $email\n";
    $messageToParticipant .= "Nr telefonu: $phone\n";

    // Nagłówki wiadomości email dla potwierdzenia zgłoszenia dla uczestnika
    $headersToParticipant = "From: $toOrganizer\r\n"; // Możesz użyć swojego adresu jako nadawcy
    $headersToParticipant .= "Reply-To: $toOrganizer\r\n"; // Możesz użyć swojego adresu jako nadawcy
    $headersToParticipant .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Wysłanie wiadomości email dla potwierdzenia zgłoszenia dla uczestnika
    $mailToParticipant = mail($toParticipant, $subjectToParticipant, $messageToParticipant, $headersToParticipant);

    // Sprawdzenie czy oba maile zostały wysłane
    if ($mailToOrganizer && $mailToParticipant) {
        // Przekierowanie użytkownika po udanym wysłaniu formularza
        header('Location: https://radnaw.pl/podziekowanie');
        exit;
    } else {
        // Obsługa błędu, jeśli nie udało się wysłać któregoś z maili
        echo 'Wystąpił problem podczas przetwarzania zgłoszenia. Spróbuj ponownie później.';
    }
} else {
    // Obsługa błędu, jeśli żądanie nie zostało wysłane metodą POST
    echo 'Nieprawidłowe żądanie.';
}
?>