<?php

// require_once './app/fonction.php';

$nom_de_la_page = "SGI | Inscription";
$erreurs = [];
$message = '';

if (isset($_POST['s-inscrire']) && '1' == $_POST['s-inscrire']) {
    if (!isset($_POST['nom']) || empty($_POST['nom'])) {
        $erreurs['nom'] = "Le champ nom de famille est obligatoire.";
    } elseif (mb_strlen($_POST['nom']) < 2) {
        $erreurs['nom'] = "Le champ nom de famille doit comporté au moins deux caractères.";
    }

    if (!isset($_POST['prenoms']) || empty($_POST['prenoms'])) {
        $erreurs['prenoms'] = "Le champ prénom(s) est obligatoire.";
    } elseif (mb_strlen($_POST['prenoms']) < 2) {
        $erreurs['prenoms'] = "Le champ prénom(s) doit comporté au moins deux caractères.";
    }

    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $erreurs['email'] = "Le champ adresse email est obligatoire.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Le champ adresse email n'est pas une adresse email valide. Merci de fourmnir une adresse email valide. Exemple john.doe@gmail.com.";
    } elseif (adresse_email_exist($_POST['email'])) {
        $erreurs['email'] = "Le champ adresse email contient une adresse email qui est déja pris par un autre utilisateur. Merci de le changer.";
    }

    if (!isset($_POST['mot-de-passe']) || empty($_POST['mot-de-passe'])) {
        $erreurs['mot-de-passe'] = "Le champ mot de passe est obligatoire.";
    } elseif (mb_strlen($_POST['mot-de-passe']) < 8) {
        $erreurs['mot-de-passe'] = "Le champ mot de passe doit comporté au moins huit caractères.";
    }

    if (!isset($_POST['confirmer-mot-de-passe']) || empty($_POST['confirmer-mot-de-passe'])) {
        $erreurs['confirmer-mot-de-passe'] = "Le champ de confirmation du mot de passe est obligatoire.";
    } elseif (mb_strlen($_POST['mot-de-passe']) < 8) {
        $erreurs['confirmer-mot-de-passe'] = "Le champ de confirmation du mot de passe doit comporté au moins huit caractères.";
    }

    if (
        isset($_POST['mot-de-passe']) && !empty($_POST['mot-de-passe']) &&
        isset($_POST['confirmer-mot-de-passe']) && !empty($_POST['confirmer-mot-de-passe']) &&
        mb_strlen($_POST['mot-de-passe']) >= 8 && mb_strlen($_POST['confirmer-mot-de-passe']) >= 8 &&
        $_POST['mot-de-passe'] !== $_POST['confirmer-mot-de-passe']
    ) {
        $erreurs['mot-de-passe'] = $erreurs['confirmer-mot-de-passe'] = "Les champs mot de passe et Confirmation du mot de passe ne sont pas identitiques.";
    }

    if (empty($erreurs)) {
        $inscrire_utilisateur = inscrire_utilisateur($_POST['nom'], $_POST['prenoms'], $_POST['email'], $_POST['mot-de-passe']);
        $message = "Inscription effectuée avec succès.";
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

            <form action="index.php?page=inscription" method="post" novalidate>
                <div class="mb-3">
                    <label for="inscription-nom" class="form-label">
                        Nom de famille
                        <span class="text-danger">
                            (*)
                        </span>
                    </label>

                    <input type="text" name="nom" class="form-control inscription-nom" id="inscription-nom" aria-describedby="inscription-nom-help"
                        placeholder="Veuillez entrer votre nom de famille" required
                        value="<?= (!empty($_POST['nom'])) ? $_POST['nom'] : '' ?>">

                    <div id="inscription-nom-help" class="form-text text-danger">
                        <?= (!empty($erreurs['nom'])) ? $erreurs['nom'] : '' ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inscription-prenoms" class="form-label">
                        Prénom(s)
                        <span class="text-danger">
                            (*)
                        </span>
                    </label>

                    <input type="text" name="prenoms" class="form-control inscription-prenoms" id="inscription-prenoms" aria-describedby="inscription-prenoms-help"
                        placeholder="Veuillez entrer votre prénom ou vos prénoms" required
                        value="<?= (!empty($_POST['prenoms'])) ? $_POST['prenoms'] : '' ?>">

                    <div id="inscription-prenoms-help" class="form-text  text-danger">
                        <?= (!empty($erreurs['prenoms'])) ? $erreurs['prenoms'] : '' ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inscription-email" class="form-label">
                        Adresse email
                        <span class="text-danger">
                            (*)
                        </span>
                    </label>

                    <input type="email" name="email" class="form-control inscription-email" id="inscription-email" aria-describedby="inscription-email-help"
                        placeholder="Veuillez entrer votre adresse email" required
                        value="<?= (!empty($_POST['email'])) ? $_POST['email'] : '' ?>">

                    <div id="inscription-email-help" class="form-text  text-danger">
                        <?= (!empty($erreurs['email'])) ? $erreurs['email'] : '' ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inscription-mot-de-passe" class="form-label">
                        Mot de passe
                        <span class="text-danger">
                            (*)
                        </span>
                    </label>

                    <input type="password" name="mot-de-passe" class="form-control inscription-mot-de-passe" id="inscription-mot-de-passe" aria-describedby="inscription-mot-de-passe-help"
                        placeholder="Veuillez entrer votre mot de passe" required
                        value="<?= (!empty($_POST['mot-de-passe'])) ? $_POST['mot-de-passe'] : '' ?>">

                    <div id="inscription-mot-de-passe-help" class="form-text  text-danger">
                        <?= (!empty($erreurs['mot-de-passe'])) ? $erreurs['mot-de-passe'] : '' ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inscription-confirmer-mot-de-passe" class="form-label">
                        Confirmer mot de passe
                        <span class="text-danger">
                            (*)
                        </span>
                    </label>

                    <input type="password" name="confirmer-mot-de-passe" class="form-control inscription-confirmer-mot-de-passe" id="inscription-confirmer-mot-de-passe" aria-describedby="inscription-confirmer-mot-de-passe-help"
                        placeholder="Veuillez entrer confirmer votre mot de passe" required
                        value="<?= (!empty($_POST['confirmer-mot-de-passe'])) ? $_POST['confirmer-mot-de-passe'] : '' ?>">

                    <div id="inscription-confirmer-mot-de-passe-help" class="form-text  text-danger">
                        <?= (!empty($erreurs['confirmer-mot-de-passe'])) ? $erreurs['confirmer-mot-de-passe'] : '' ?>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="termes-condictions" class="form-check-input inscription-termes-condictions" id="inscription-termes-condictions">
                    <label class="form-check-label" for="inscription-termes-condictions">
                        J'accepte les termes et condition
                    </label>
                </div>
                <div id="inscription-termes-condictions-help" class="form-text  text-danger">
                    <?= (!empty($erreurs['termes-condictions'])) ? $erreurs['termes-condictions'] : '' ?>
                </div>

                <button type="submit" name="s-inscrire" value="1" class="btn btn-primary mb-3">S'inscrire</button>
            </form>

            <p class="mb-1">
                <a href="index.php?page=connexion">
                    Connexion
                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<?php require_once './app/pages/authentification/template_fin.php'; ?>