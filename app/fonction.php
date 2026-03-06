<?php

/**
 * Cette fonction permet de se connecter a une base de donnée.
 * 
 * @return PDO|bool Instance de la base de donnée.
 */
function connexion_base_de_donnees(): PDO|bool
{
    try {
        return new PDO('mysql:host=localhost:8889;dbname=gestion_inscription_etablissement_scolaire;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
        return false;
    }
}

/**
 * Cette fonction permet de recuperer le nom de la page.
 * 
 * @return null|string $nom_de_la_page Le nom de la page.
 */
function obtenir_le_nom_de_la_page(): ?string
{
    return $_GET['page'] ?? null;
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

        // Formation

        case 'liste-formation':
            $ficher_de_la_page = './app/pages/formation/liste.php';
            break;

        case 'ajouter-formation':
            $ficher_de_la_page = './app/pages/formation/ajouter.php';
            break;

        case 'ajouter-formation-traitement':
            $ficher_de_la_page = './app/pages/formation/ajouter-traitement.php';
            break;

        case 'modifier-formation':
            $ficher_de_la_page = './app/pages/formation/modifier.php';
            break;

        case 'supprimer-formation':
            $ficher_de_la_page = './app/pages/formation/supprimer.php';
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

/**
 * Cette fonction permet d'ajouter une filière ou formation dans la table filières de notre base de donnée.
 * 
 * @param string $nom Le nom de la filière.
 * @param string $montant Le montant de la filière.
 * @param string|null $description  La description  de la filière.
 * @return bool La filière a été créer ou non.
 */
function ajouter_formation(string $nom, int $montant, string|null $description = null): bool
{
    $ajouter_formation = false;

    $requette = "INSERT INTO `filieres` (`nom`, `montant_scolarite`, `description`, `creer_le`, `modifier_le`) VALUES (:nom, :montant, :description_filiere, NOW(), NOW());";

    $instance_base_de_donnees =  connexion_base_de_donnees();
    $preparation_de_la_requette = $instance_base_de_donnees->prepare($requette);
    $formation = $preparation_de_la_requette->execute([
        'nom' => $nom,
        'montant' => $montant,
        'description_filiere' => $description,
    ]);

    $ajouter_formation = $formation ? true : false;

    return $ajouter_formation;
}

/**
 * Cette fonction permet de récupéré la liste des filières ou formations dans la table filières de notre base de donnée.
 * 
 * @return array La liste des filières.
 */
function list_formation(int $numero_page = 1, int $limite = 10, ?string $nom = null, ?int $montant_scolarite = null): array
{
    //
    $list_formation = [];
    $data = [];

    $requette_debut = "SELECT * FROM `filieres` WHERE supprimer_le is null ";

    // if ($nom) {
    //     $requette_debut = $requette_debut . " AND nom like ':nom'";
    // }

    // if ($montant_scolarite) {
    //     $requette_debut = $requette_debut . " AND montant_scolarite like '%:montant_scolarite%'";
    // }

    $requette_fin = " LIMIT :limit OFFSET :offset;";


    $requette = $requette_debut . $requette_fin;

    $instance_base_de_donnees =  connexion_base_de_donnees();
    $preparation_de_la_requette = $instance_base_de_donnees->prepare($requette);

    $offset = ($numero_page - 1) * $limite;

    // if ($nom) {
    //     $preparation_de_la_requette->bindParam(':nom', $nom, PDO::PARAM_STR);
    // }

    // Explicitly bind as integers
    $preparation_de_la_requette->bindParam(':limit', $limite, PDO::PARAM_INT);
    $preparation_de_la_requette->bindParam(':offset', $offset, PDO::PARAM_INT);

    // if ($montant_scolarite) {
    //     die('montant_scolarite');
    //     $preparation_de_la_requette->bindParam(':montant_scolarite', $montant_scolarite, PDO::PARAM_INT);
    // }

    $preparation_de_la_requette->execute();

    $list_formation = $preparation_de_la_requette->fetchAll(PDO::FETCH_ASSOC);

    return $list_formation;
}

/**
 * Cette fonction permet de récupéré une filières ou une formation dans la table filières de notre base de donnée.
 * 
 * @param int $id L'identifiant de la filière.
 * @return array La filière.
 */
function recuperer_formation(int $id): array
{
    $recuperer_formation = [];

    $requette = "SELECT * FROM `filieres` WHERE id=:id and supprimer_le is null ;";

    $instance_base_de_donnees =  connexion_base_de_donnees();
    $preparation_de_la_requette = $instance_base_de_donnees->prepare($requette);
    $preparation_de_la_requette->execute([
        'id' => $id
    ]);

    $formation = $preparation_de_la_requette->fetch(PDO::FETCH_ASSOC);
    $recuperer_formation =  $formation ? $formation : [];

    return $recuperer_formation;
}

/**
 * Cette fonction permet de modifier une filière ou formation grace a son identifiamt dans la table filières de notre base de donnée.
 * 
 * @param string $id L'identifiant de la filière.
 * @param string $nom Le nom de la filière.
 * @param string $montant Le montant de la filière.
 * @param string|null $description  La description  de la filière.
 * @return bool La filière a été créer ou non.
 */
function modifier_formation(int $id, string $nom, int $montant, string|null $description = null): bool
{
    $modifier_formation = false;

    $requette = "UPDATE `filieres` SET `nom` = :nom, `montant_scolarite` = :montant_scolarite, `description` = :description_formation WHERE `filieres`.`id` = :id;";

    $instance_base_de_donnees =  connexion_base_de_donnees();
    $preparation_de_la_requette = $instance_base_de_donnees->prepare($requette);
    $formation = $preparation_de_la_requette->execute([
        'id' => $id,
        'nom' => $nom,
        'montant_scolarite' => $montant,
        'description_formation' => $description,
    ]);

    $modifier_formation = $formation ? true : false;

    return $modifier_formation;
}

/**
 * Cette fonction permet de supprimer une filière ou formation grace a son identifiamt dans la table filières de notre base de donnée.
 * 
 * @param string $id L'identifiant de la filière.
 * @return bool La filière a été créer ou non.
 */
function supprimer_de_maniere_logique_formation(int $id): bool
{
    $supprimer_de_maniere_logique_formation = false;

    $requette = "UPDATE `filieres` SET `supprimer_le` = now() WHERE `filieres`.`id` = :id;";

    $instance_base_de_donnees =  connexion_base_de_donnees();
    $preparation_de_la_requette = $instance_base_de_donnees->prepare($requette);
    $formation = $preparation_de_la_requette->execute([
        'id' => $id,
    ]);

    $supprimer_de_maniere_logique_formation = $formation ? true : false;

    return $supprimer_de_maniere_logique_formation;
}

function estconnecter(): bool
{
    return isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur']);
}

/**
 * Cette fonction peremt de verrifier si une adresse email existe dans la table utilisateur de la base de données.
 * 
 * @param string $email L'adresse email.
 * @return bool Es ce que l'adresse email existe ou pas.
 */
function adresse_email_exist(string $email): bool
{
    $adresse_email_exist = false;

    $instance_base_de_donnee = connexion_base_de_donnees();

    $requette = "SELECT * FROM utilisateur WHERE email=:email";

    $resultat = $instance_base_de_donnee->prepare($requette);

    $resultat->execute(['email' => $email]);

    $utilisateur = $resultat->fetch();

    $adresse_email_exist = (is_array($utilisateur)) ? true : $adresse_email_exist;

    return $adresse_email_exist;
}

/**
 * cette fonction permet d'inscrire un utilisateur dans la table utilisateur de la base de données.
 * 
 * @param string $nom Le nom de l'utilisateur.
 * @param string $prenoms Le ou les prénom(s) de l'utilisateur.
 * @param string $email L'adresse email de l'utilisateur.
 * @param string $mot_de_passe Le mot de passe de l'utilisateur.
 */
function inscrire_utilisateur(string $nom, string $prenoms, string $email, string $mot_de_passe): bool
{
    $inscrire_utilisateur = false;

    $instance_base_de_donnee = connexion_base_de_donnees();

    $requette = "INSERT INTO utilisateur(nom, prenoms, email, mot_de_passe, creer_le, mise_a_jour_le, supprimer_le) VALUES(:nom, :prenoms, :email, :mot_de_passe, NOW(), NOW(), NOW())";

    $resultat = $instance_base_de_donnee->prepare($requette);

    $inscrire_utilisateur = $resultat->execute([
        'nom' => $nom,
        'prenoms' => $prenoms,
        'email' => $email,
        'mot_de_passe' => sha1($mot_de_passe),
    ]);

    return $inscrire_utilisateur;
}



/**
 * Cette fonction peremt de connecter un utilisateur grace a son email et son mot de passe.
 * 
 * @param string $email L'adresse email.
 * @param string $mot_de_passe Le mot de passe.
 * @return bool|array $utilisateur L'utilisateur connecté.
 */
function connecter_utilisateur(string $email, string $mot_de_passe): bool|array
{
    $utilisateur = false;

    $instance_base_de_donnee = connexion_base_de_donnees();

    $requette = "SELECT * FROM utilisateur WHERE email=:email and mot_de_passe=:mot_de_passe";

    $resultat = $instance_base_de_donnee->prepare($requette);

    $resultat->execute([
        'email' => $email,
        'mot_de_passe' => sha1($mot_de_passe),
    ]);

    $utilisateur = $resultat->fetch();

    $utilisateur = (is_array($utilisateur)) ? $utilisateur : false;

    return $utilisateur;
}
