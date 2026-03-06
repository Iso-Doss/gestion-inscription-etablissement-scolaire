<?php
$nom_de_la_page = 'Liste des formations';

if (!empty($_GET['id']) && !empty($_GET['action']) && $_GET['action'] === 'supprimer') {
    $formation = recuperer_formation($_GET['id'] ?? 0);

    if (empty($formation)) {
        $erreurs['formation'] = "La formation que vous souhaitez supprimer est introuvable.";
        $message = "La formation que vous souhaitez supprimer est introuvable.";
    } else {
        // Mettre en place le fonction qui permet de supprimer une formation.
        $supprimer_de_maniere_logique_formation = supprimer_de_maniere_logique_formation($_GET['id']);
        if ($supprimer_de_maniere_logique_formation) {
            $message = "La formation '"  . $formation['nom'] . "'  a été supprimé avec succès.";
        }
    }
}


$numero_page = 1;
$limite = 10;
if (!empty($_GET['numero_page']) && $_GET['numero_page'] > 0) {
    $numero_page = $_GET['numero_page'];
}


if (!empty($_GET['limite']) && $_GET['limite'] > 0) {
    $limite = $_GET['limite'];
}

$montant_scolarite = intval($_GET['montant_scolarite'] ?? null) == 0 ? null : intval($_GET['montant_scolarite'] ?? null);

$formations = list_formation($numero_page, $limite, $_GET['nom'] ?? null,  );

require_once './app/pages/tableau_de_board/template_debut.php';
echo entete_de_ma_page($nom_de_la_page, ['nom' => 'Ajouter une formation', 'href' => 'index.php?page=ajouter-formation']);

?>

<!--begin::Container-->
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($erreurs)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message; ?>
                </div>
            <?php } elseif (!empty($message)) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $message; ?>
                </div>
            <?php } ?>


            <div class="accordion mb-4" id="liste-formation-filtres">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseOne"
                            aria-expanded="true"
                            aria-controls="collapseOne">
                            Cliquez ici pour appliquez un filtre
                        </button>
                    </h2>
                    <div
                        id="collapseOne"
                        class="accordion-collapse collapse"
                        data-bs-parent="#liste-formation-filtres">
                        <div class="accordion-body">
                            <form action="index.php" method="get">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="ajouter-formation-nom" class="form-label">
                                            Nom de la formation
                                        </label>

                                        <input type="hidden" name="page" value="liste-formation">

                                        <input
                                            type="text"
                                            class="form-control"
                                            id="liste-formation-nom"
                                            name="nom"
                                            value="<?= (!empty($donnees['nom'])) ? $donnees['nom'] : ''; ?>"
                                            aria-describedby="liste-formation-nom-aide" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="ajouter-formation-montant-scolarite" class="form-label">
                                            Montant de la scolariter de la formation
                                        </label>

                                        <input
                                            type="number"
                                            class="form-control"
                                            id="ajouter-formation-montant-scolarite"
                                            name="montant_scolarite"
                                            value="<?= (!empty($donnees['montant_scolarite'])) ? $donnees['montant_scolarite'] : ''; ?>"
                                            aria-describedby="ajouter-formation-montant-scolarite-aide" />

                                        <div id="ajouter-formation-montant-scolarite-aide" class="form-text text-danger">
                                            <?= (!empty($erreurs['montant_scolarite'])) ? $erreurs['montant_scolarite'] : '' ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <button type="submit" class="btn btn-primary">Rechercher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <?= $nom_de_la_page; ?>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (!empty($formations)) { ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nom</th>
                                    <th>Montant de la scolarité</th>
                                    <th>Descrption</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($formations as $formation) { ?>
                                    <tr class="align-middle">
                                        <td>
                                            <?= $formation['id'] ?? '-'; ?>
                                        </td>
                                        <td>
                                            <?= $formation['nom'] ?? '-'; ?>
                                        </td>
                                        <td>
                                            <?= number_format($formation['montant_scolarite'], 0, ',', '.') . ' FCFA'  ?? '-'; ?>
                                        </td>
                                        <td>
                                            <?= $formation['description'] ?? '-'; ?>
                                        </td>
                                        <td>
                                            <a href="index.php?page=modifier-formation&id=<?= $formation['id'] ?? '-'; ?>" class="btn btn-warning">
                                                Modifier
                                            </a>

                                            <a type="button" data-bs-toggle="modal" data-bs-target="#formation-supprimer-<?= $formation['id'] ?? '-'; ?>" class="btn btn-danger">
                                                Supprimer
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="formation-supprimer-<?= $formation['id'] ?? '-'; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        Êtes-vous sûr de vouloir supprimer la formation "<?= $formation['nom'] ?? '-'; ?>" ?
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                    <a href="index.php?page=liste-formation&id=<?= $formation['id'] ?? '-'; ?>&action=supprimer" class="btn btn-primary">Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>
                            Aucune formation n'est disponible pour le moment.
                        </p>
                    <?php } ?>
                </div>
                <?php if (!empty($formations)) { ?>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=liste-formation&numero_page=<?= ($numero_page > 1) ? $numero_page - 1 : $numero_page ?>&limite=<?= $limite ?>">
                                    Page précédente
                                </a>
                            </li>
                            <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=liste-formation&numero_page=<?= $numero_page + 1 ?>&limite=<?= $limite ?>">
                                    Page suivante
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->

<? require_once './app/pages/tableau_de_board/template_fin.php'; ?>