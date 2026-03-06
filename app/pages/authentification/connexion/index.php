<?php

require_once './app/fonction.php';

$nom_de_la_page = "SGI | Connexion";
$erreurs = [];
$message = '';

if (isset($_POST['se-connecter']) && '1' == $_POST['se-connecter']) {
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $erreurs['email'] = "Le champ adresse email est obligatoire.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Le champ adresse email n'est pas une adresse email valide. Merci de fourmnir une adresse email valide. Exemple john.doe@gmail.com.";
    }

    if (!isset($_POST['mot-de-passe']) || empty($_POST['mot-de-passe'])) {
        $erreurs['mot-de-passe'] = "Le champ mot de passe est obligatoire.";
    }

    if (empty($erreurs)) {
        $utilisateur = connecter_utilisateur($_POST['email'], $_POST['mot-de-passe']);
        if (is_array($utilisateur)) {
            $_SESSION['utilisateur'] = $utilisateur;
            $message = "Connexion effectuée avec succès.";
        } else {
            $erreurs['email'] = "Adresse email ou mot de passe incorrect.";
            $message = "Adresse email ou mot de passe incorrect.";
        }
    } else {
        $message = "Oups!!! Un ou pluieurs champ(s) sont incorrects";
    }
}

require_once './app/pages/authentification/template_debut.php';

?>

<div class="login-box" style="width: 400px !important;">
    <div class="login-logo">
        <a href="index.php">
            <b>
                <?= $nom_de_la_page ?? '' ?>
            </b>
        </a>
    </div>
    <!-- /.login-l ogo -->
    <div class="card">
        <div class="card-body login-card-body">
            <?php if (!empty($erreurs) & !empty($message)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message; ?>
                </div>
            <?php } elseif (!empty($message)) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $message; ?>
                </div>
            <?php } ?>

            <p>
                <?= estconnecter() ? 'Je suis connecté.' : ''; ?>
            </p>

            <form action="index.php?page=connexion" method="post" novalidate>
                <div class="mb-3">
                    <label for="connexion-email" class="form-label">
                        Adresse email
                        <span class="text-danger">
                            (*)
                        </span>
                    </label>

                    <input type="email" name="email" class="form-control connexion-email" id="connexion-email" aria-describedby="connexion-email-help"
                        placeholder="Veuillez entrer votre adresse email" required
                        value="<?= (!empty($_POST['email'])) ? $_POST['email'] : '' ?>">

                    <div id="connexion-email-help" class="form-text  text-danger">
                        <?= (!empty($erreurs['email'])) ? $erreurs['email'] : '' ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="connexion-mot-de-passe" class="form-label">
                        Mot de passe
                        <span class="text-danger">
                            (*)
                        </span>
                    </label>

                    <input type="password" name="mot-de-passe" class="form-control connexion-mot-de-passe" id="connexion-mot-de-passe" aria-describedby="connexion-mot-de-passe-help"
                        placeholder="Veuillez entrer votre mot de passe" required
                        value="<?= (!empty($_POST['mot-de-passe'])) ? $_POST['mot-de-passe'] : '' ?>">

                    <div id="connexion-mot-de-passe-help" class="form-text  text-danger">
                        <?= (!empty($erreurs['mot-de-passe'])) ? $erreurs['mot-de-passe'] : '' ?>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="se-souvenir-de-moi" class="form-check-input connexion-se-souvenir-de-moi" id="connexion-se-souvenir-de-moi">
                    <label class="form-check-label" for="connexion-se-souvenir-de-moi">Se souvenir de moi</label>
                </div>

                <button type="submit" name="se-connecter" value="1" class="btn btn-primary mb-3">Se connecter</button>
            </form>

            <p class="mb-1">
                <a href="#">
                    Mot de passe oublié ?
                </a>
            </p>
            <p class="mb-1">
                <a href="index.php?page=inscription" class="text-center">
                    S'inscrire
                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<?php require_once './app/pages/authentification/template_fin.php'; ?>