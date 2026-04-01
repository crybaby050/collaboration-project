<?php
// Démarrer la session au tout début
session_start();

// Définir la constante pour les chemins
define('WEBROOT', 'http://localhost:8000/');

// Récupérer la page demandée (login par défaut)
$page = $_GET['page'] ?? 'login';
// Charger le routeur
require_once __DIR__ . '/core/router.php';