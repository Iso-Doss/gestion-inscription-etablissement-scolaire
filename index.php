<?php

session_start();

require_once './app/fonction.php';

$page = obtenir_le_nom_de_la_page();
$action = $_GET['action'] ?? null;

switch ($page) {
    case 'inscription':
        if (estconnecter()) {
            $ficher_de_la_page = './app/pages/tableau_de_board/index.php';
        } else {
            $ficher_de_la_page = './app/pages/authentification/inscription/index.php';
        }
        break;

    case 'connexion':
        if (estconnecter()) {
            $ficher_de_la_page = './app/pages/tableau_de_board/index.php';
        } else {
            $ficher_de_la_page = './app/pages/authentification/connexion/index.php';
        }
        break;

    case 'deconnexion':
        session_destroy();
        $ficher_de_la_page = './app/pages/authentification/connexion/index.php';
        break;

    case 'tableau-de-board':
        if (estconnecter()) {
            $ficher_de_la_page = './app/pages/tableau_de_board/index.php';
        } else {
            $ficher_de_la_page = './app/pages/authentification/connexion/index.php';
        }
        break;

    // Formation

    case 'liste-formation':
        if (estconnecter()) {
            $ficher_de_la_page = './app/pages/tableau_de_board/formation/liste.php';
        } else {
            $ficher_de_la_page = './app/pages/authentification/connexion/index.php';
        }

        break;

    case 'ajouter-formation':
        if (estconnecter()) {
            $ficher_de_la_page = './app/pages/tableau_de_board/formation/ajouter.php';
        } else {
            $ficher_de_la_page = './app/pages/authentification/connexion/index.php';
        }
        break;

    case 'modifier-formation':
        if (estconnecter()) {
            $ficher_de_la_page = './app/pages/tableau_de_board/formation/modifier.php';
        } else {
            $ficher_de_la_page = './app/pages/authentification/connexion/index.php';
        }
        break;

    // Apprenant

    case 'liste-apprenant':
        $ficher_de_la_page = './app/pages/apprenant/liste.php';
        break;

    case 'ajouter-apprenant':
        $ficher_de_la_page = './app/pages/apprenant/ajouter.php';
        break;

    case 'modifier-apprenant':
        $ficher_de_la_page = './app/pages/apprenant/modifier.php';
        break;

    case 'supprimer-apprenant':
        $ficher_de_la_page = './app/pages/apprenant/supprimer.php';
        break;

    // Inscription

    case 'liste-inscription':
        $ficher_de_la_page = './app/pages/inscription/liste.php';
        break;

    case 'ajouter-inscription':
        $ficher_de_la_page = './app/pages/inscription/ajouter.php';
        break;

    case 'modifier-inscription':
        $ficher_de_la_page = './app/pages/inscription/modifier.php';
        break;

    case 'supprimer-inscription':
        $ficher_de_la_page = './app/pages/inscription/supprimer.php';
        break;

    default:
        $ficher_de_la_page = './app/pages/defaut/404.php';
        break;
}

require_once $ficher_de_la_page;
