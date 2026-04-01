<?php

// Récupérer la page demandée
$page = $_GET['page'] ?? 'login';

// Si l'utilisateur n'est pas connecté ET qu'il essaie d'accéder à une page autre que login
if (!isset($_SESSION["userConnect"]) && $page !== 'login') {
    header("Location: " . WEBROOT . "?page=login");
    exit;
}