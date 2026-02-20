<?php
$nom_de_la_page = 'Ajouter une formation';
echo entete_de_ma_page($nom_de_la_page, ['nom' => 'Liste des formations', 'href' => 'index.php?page=liste-formation']);
?>


<!--begin::Container-->
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row g-4">
        <!--begin::Col-->
        <div class="col-md-12">
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
                <form>
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
                                aria-describedby="ajouter-formation-nom-aide" />

                            <div id="ajouter-formation-nom-aide" class="form-text">

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
                                aria-describedby="ajouter-formation-montant-scolarite-aide" />

                            <div id="ajouter-formation-montant-scolarite-aide" class="form-text">

                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="ajouter-formation-description" class="form-label">
                                Description de la formation
                                <span class="text-danger">(*)</span>
                            </label>

                            <textarea class="form-control" id="ajouter-formation-description" aria-label="With textarea"></textarea>

                            <div id="ajouter-formation-description-aide" class="form-text">

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