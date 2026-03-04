<?php
$nom_de_la_page = 'Liste des formations';
echo entete_de_ma_page($nom_de_la_page, ['nom' => 'Ajouter une formation', 'href' => 'index.php?page=ajouter-formation']);

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

$formations = list_formation($numero_page, $limite);

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
                                            <?= $formation['montant_scolarite'] ?? '-'; ?>
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