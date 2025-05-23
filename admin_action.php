<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'] ?? '';
$action = $data['action'] ?? '';

if (!$email || !$action) {
    echo json_encode(['success' => false, 'error' => 'Email ou action manquant.']);
    exit;
}

$filepath = 'save.json';

if (!file_exists($filepath)) {
    echo json_encode(['success' => false, 'error' => 'Fichier introuvable.']);
    exit;
}

$json = file_get_contents($filepath);
$users = json_decode($json, true);

$found = false;

foreach ($users as $i => $user) {
    
    if ($user['email'] === $email) {
        $found = true;
        if ($action === 'delete') {
            array_splice($users, $i, 1);
        } elseif ($action === 'admin') {
            $users[$i]['Admin'] = "1";
        } elseif ($action === 'standard') {
            $users[$i]['Admin'] = "0";
        } else {
            echo json_encode(['success' => false, 'error' => 'Action inconnue.']);
            exit;
        }
        break;
    }
    
}

if (!$found) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non trouvé.']);
    exit;
}

file_put_contents($filepath, json_encode($users, JSON_PRETTY_PRINT));
echo json_encode(['success' => true]);

?>