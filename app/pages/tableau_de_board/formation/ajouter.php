<?php
$donnees = $_POST;
$erreurs = [];
$message = '';
$nom_de_la_page = 'Ajouter une formation';


if (!empty($_POST)) {

    if (!isset($_POST['nom']) || empty($_POST['nom'])) {
        $erreurs['nom'] = 'Le champ nom de la filière est obligatoire';
    }


    if (!isset($_POST['montant_scolarite']) || empty($_POST['montant_scolarite'])) {
        $erreurs['montant_scolarite'] = 'Le champ montant de la scolatité de la filière est obligatoire';
    } else if (!empty($_POST['montant_scolarite']) && !is_numeric($_POST['montant_scolarite'])) {
        $erreurs['montant_scolarite'] = 'Le champ montant de la scolatité de la filière doit etre numérique. Exemple : 120.000 FCFA';
    }

    if (empty($erreurs)) {
        $formation = ajouter_formation($_POST['nom'], $_POST['montant_scolarite'], $_POST['description']);
        if ($formation) {
            $message = "La formation a été ajoutée avec succès.";
        } else {
            $message = "Oups !!! Une erreur est survenue, veuillez réessayé plus tard.";
            $erreurs['erreur_base_de_donnee'] = "Oups !!! Une erreur est survenue, veuillez réessayé plus tard.";
        }
    }else{
        $message = "Oups !!! Un ou plusieur(s) champ(s) sont incorrect(s).";
    }
}

require_once './app/pages/tableau_de_board/template_debut.php';
echo entete_de_ma_page($nom_de_la_page, ['nom' => 'Liste des formations', 'href' => 'index.php?page=liste-formation']);
?>


<!--begin::Container-->
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row g-4">
        <!--begin::Col-->
        <div class="col-md-12">
            <?php if (!empty($erreurs)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message; ?>
                </div>
            <?php } elseif(!empty($message)) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $message; ?>
                </div>
            <?php } ?>
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">
                        <?= $nom_de_la_page; ?>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form action="index.php?page=ajouter-formation" method="POST" novalidate>
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="ajouter-formation-nom" class="form-label">
                                Nom de la formation
                                <span class="text-danger">(*)</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="ajouter-formation-nom"
                                name="nom"
                                value="<?= (!empty($donnees['nom'])) ? $donnees['nom'] : ''; ?>"
                                aria-describedby="ajouter-formation-nom-aide"
                                required />

                            <div id="ajouter-formation-nom-aide" class="form-text text-danger">
                                <?= (!empty($erreurs['nom'])) ? $erreurs['nom'] : '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="ajouter-formation-montant-scolarite" class="form-label">
                                Montant de la scolariter de la formation
                                <span class="text-danger">(*)</span>
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="ajouter-formation-montant-scolarite"
                                name="montant_scolarite"
                                value="<?= (!empty($donnees['montant_scolarite'])) ? $donnees['montant_scolarite'] : ''; ?>"
                                aria-describedby="ajouter-formation-montant-scolarite-aide"
                                required />

                            <div id="ajouter-formation-montant-scolarite-aide" class="form-text text-danger">
                                <?= (!empty($erreurs['montant_scolarite'])) ? $erreurs['montant_scolarite'] : '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="ajouter-formation-description" class="form-label">
                                Description de la formation
                                <!-- <span class="text-danger">(*)</span> -->
                            </label>

                            <textarea class="form-control" id="ajouter-formation-description" aria-label="With textarea" name="description"><?= (!empty($donnees['description'])) ? $donnees['description'] : ''  ?></textarea>

                            <div id="ajouter-formation-description-aide" class="form-text">
                                <?= (!empty($erreurs['description'])) ? $erreurs['description'] : '' ?>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ajouter une formation</button>
                    </div>
                    <!--end::Footer-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Quick Example-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->

<? require_once './app/pages/tableau_de_board/template_fin.php'; ?>