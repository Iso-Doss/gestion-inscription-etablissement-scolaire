<?php
$nom_de_la_page = 'Liste des formations';
echo entete_de_ma_page($nom_de_la_page, ['nom' => 'Ajouter une formation', 'href' => 'index.php?page=ajouter-formation']);

$formations = list_formation();
?>

<!--begin::Container-->
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
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

                                            <a href="index.php?page=supprimer-formation&id=<?= $formation['id'] ?? '-'; ?>" class="btn btn-danger">
                                                Supprimer
                                            </a>
                                        </td>
                                    </tr>
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
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->