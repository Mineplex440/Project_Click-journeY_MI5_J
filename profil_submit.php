<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$field = $data["field"] ?? '';
$value = $data["value"] ?? '';
$email = $_SESSION["email"] ?? '';

$allowed_fields = [
    "prenom", "nom", "email", "password", "date_of_birth", "sex"
];

if (!in_array($field, $allowed_fields) || empty($email)) {
    echo json_encode(["success" => false, "error" => "Champ invalide ou utilisateur non connecté"]);
    exit;
}

// Chemin vers le fichier JSON
$filepath = "save.json";

// Lire les utilisateurs
$users = json_decode(file_get_contents($filepath), true);
if (!is_array($users)) {
    echo json_encode(["success" => false, "error" => "Erreur de lecture du fichier JSON"]);
    exit;
}

$updated = false;

// Trouver l'utilisateur par son email
foreach ($users as &$user) {
    if ($user["email"] === $email) {
        $user[$field] = $value;
        $updated = true;
        break;
    }
}

if ($field === "password") {
    if (strlen($value) < 4 || strlen($value) > 15) {
        echo json_encode(["success" => false, "error" => "Le mot de passe doit contenir entre 4 et 15 caractères."]);
        exit;
    }
}

if ($updated) {
    file_put_contents($filepath, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Utilisateur non trouvé"]);
}