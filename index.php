<?php
// ============================================================
// AI Training n Impact Tracker — Main Router
// ============================================================

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';

session_start();

$page = preg_replace('/[^a-z0-9_-]/', '', strtolower($_GET['page'] ?? 'home'));

$pageFiles = [
    'home'     => 'pages/home.php',
    'classes'  => 'pages/classes.php',
    'material' => 'pages/material.php',
    'impact'   => 'pages/impact.php',
    'quizzes'  => 'pages/quizzes.php',
    'about'    => 'pages/about.php',
];

$suppressPageTitle = !isset($_GET['page']);

$file = $pageFiles[$page] ?? null;

if ($file && file_exists(__DIR__ . '/' . $file)) {
    require_once __DIR__ . '/' . $file;
} else {
    http_response_code(404);
    $pageTitle  = '404 Not Found';
    $activePage = '';
    include __DIR__ . '/includes/header.php';
    echo '<div class="container" style="padding:6rem 2rem;text-align:center">';
    echo '<h1 style="font-size:5rem;opacity:.2">404</h1>';
    echo '<h2>Page not found</h2>';
    echo '<a href="' . APP_URL . '/" class="btn btn-primary" style="margin-top:1rem">Go Home</a>';
    echo '</div>';
    include __DIR__ . '/includes/footer.php';
}
