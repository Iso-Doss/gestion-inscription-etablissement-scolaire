<?php

/**
 * Cette fonction permet de recuperer le nom de la page.
 * 
 * @return string $nom_de_la_page Le nom de la page.
 */
function obtenir_le_nom_de_la_page(): string
{
    return $_GET['page'] ?? '';
}


/**
 * Cette fonction permet de determinier quelle page l'utilisateur souhaite consulter.
 * 
 * @return string $fichier_source_de_la_page Le fichier source de la page.
 */
function routage(): string
{
    $ficher_de_la_page = './app/defaut/404.php';
    $page = obtenir_le_nom_de_la_page();
    $action = $_GET['action'] ?? '';

    switch ($page) {
        case '':
            $ficher_de_la_page = './app/pages/defaut/accueil.php';
            break;

        case 'accueil':
            $ficher_de_la_page = './app/pages/defaut/accueil.php';
            break;

        case 'tableau-de-board':
            $ficher_de_la_page = './app/pages/tableau-de-board.php';
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

        // Formation

        case 'liste-formation':
            $ficher_de_la_page = './app/pages/formation/liste.php';
            break;

        case 'ajouter-formation':
            $ficher_de_la_page = './app/pages/formation/ajouter.php';
            break;

        case 'modifier-formation':
            $ficher_de_la_page = './app/pages/formation/modifier.php';
            break;

        case 'supprimer-formation':
            $ficher_de_la_page = './app/pages/formation/supprimer.php';
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

    return $ficher_de_la_page;
}

/**
 * Cette fonction permet de construire l'entête de mes pages.
 * 
 * @param string $nom_de_la_page Le nom de la page.
 * @param array $action L'action.
 * @return string $entete_de_ma_page Entête de ma page.
 */
function entete_de_ma_page(string $nom_de_la_page, array $action = [])
{
    $action_code = (!empty($action) && !empty($action['nom'])) ? '<a class="btn btn-primary" href="' . ($action['href'] ?? '#') . '">' . $action['nom'] . '</a>' : '';

    return '<!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">' . $nom_de_la_page . '</h3>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                             ' . $action_code  . '
                            </div>
                            <!-- <ol class="breadcrumb float-sm-end"> -->
                                <!-- <li class="breadcrumb-item"><a href="#">Accueil</a></li> -->
                                <!-- <li class="breadcrumb-item active" aria-current="page">Accueil</li> -->
                            <!-- </ol> -->
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->';
}


?>
