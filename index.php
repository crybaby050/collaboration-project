<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Démarrer la session au tout début
session_start();

// Définir la constante pour les chemins
define('WEBROOT', 'http://localhost:8000/');

// Récupérer la page demandée (login par défaut)
$page = $_GET['page'] ?? 'login';
// Charger le routeur
require_once __DIR__ . '/core/router.php';