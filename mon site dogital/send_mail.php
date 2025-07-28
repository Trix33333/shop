<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if (!$name || !$email || !$message) {
        http_response_code(400);
        echo "Merci de remplir tous les champs.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Email invalide.";
        exit;
    }

    $to = "trix.digital.off@gmail.com";
    $subject = "Message depuis ton site Digital Trix";
    $body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message envoyé avec succès.";
    } else {
        http_response_code(500);
        echo "Erreur lors de l'envoi.";
    }
} else {
    http_response_code(405);
    echo "Méthode non autorisée.";
}
?>
