<br><br>
<h1 class="display-3">Liste des pays</h1>
<br>
<button class="btn btn-primary" onclick="afficherFormulaire('displayFormCountries')">Ajouter</button>
<br><br>
<div id="displayFormCountries">
    <form action="<?= PATH ?>/Countries/newCountry" method="POST">

        Entrez un nouveau pays : <input type="text" name="country">
        <select name="continent">
            <?php foreach ($allContinents as $continent) : ?>
                <option value="<?= $continent['ID_CONTINENT'] ?>"><?= $continent['NOM_CONTINENT'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-dark">Valider</button>
    </form>
    <br>
</div>

<!-- PAGINATION DU HAUT-->


 <div class="pagination-container">
        <a href="<?= PATH ?>/countries/index/0" class="pagination-btn <?= ($page === null || $page < 1) ? 'disabled' : '' ?>"><i class="fa-solid fa-angles-left"></i></a>
        <a href="<?= PATH ?>/countries/index/<?= $page - 1 ?>" class="pagination-btn <?= ($page === null || $page < 1) ? 'disabled' : '' ?> "><i class="fa-solid fa-angle-left"></i></a>

        <div class="page-info">
       Page <?php echo @$page + 1; ?> sur <?php echo @$pages; ?>
    </div>

        <a href="<?= PATH ?>/countries/index/<?= $page + 1 ?>" class="pagination-btn <?= ($page + 2 > $pages) ? 'disabled' : '' ?>"><i class="fa-solid fa-angle-right"></i></a>
        <a href="<?= PATH ?>/countries/index/<?= $pages -1 ?>" class="pagination-btn <?= ($page + 2 > $pages) ? 'disabled' : '' ?>"><i class="fa-solid fa-angles-right"></i></a>
    </div> <br>
<!-- FIN PAGINATION DU HAUT  -->

<div class="table-container">
    <table class="table table-success table-hover">
        <tr>
            <th>Code</th>
            <th>Nom</th>
            <th>Continent</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($allCountries as $country) : ?>
            <tr>
                <td><?= $country['ID_PAYS'] ?></td>
                <td><?= $country['NOM_PAYS'] ?></td>
                <td><?= $country['NOM_CONTINENT'] ?></td>

                <td>
                    <a href="<?= PATH ?>/countries/edit/<?= $country['ID_PAYS'] ?>">
                        <button class='btn btn-info btn-sm fas fa-pencil-alt fa-sm'></button></a>
                    <a onclick="return confirm('Etes vous sur de vouloir supprimer ce pays ?')" href="<?= PATH ?>/countries/deleteCountry/<?= $country['ID_PAYS'] ?>">
                        <button class='btn btn-danger btn-sm fas fa-trash-alt fa-sm'></button></a>
                </td>
            </tr>
        <?php endforeach ?>

    </table>
</div>

<!-- PAGINATION DU BAS-->
<div class="pagination-container">
        <a href="<?= PATH ?>/countries/index/0" class="pagination-btn <?= ($page === null || $page < 1) ? 'disabled' : '' ?>"><i class="fa-solid fa-angles-left"></i></a>
        <a href="<?= PATH ?>/countries/index/<?= $page - 1 ?>" class="pagination-btn <?= ($page === null || $page < 1) ? 'disabled' : '' ?> "><i class="fa-solid fa-angle-left"></i></a>

        <div class="page-info">
        Page <?php echo @$page + 1; ?> sur <?php echo @$pages; ?>
    </div>

        <a href="<?= PATH ?>/countries/index/<?= $page + 1 ?>" class="pagination-btn <?= ($page + 2 > $pages) ? 'disabled' : '' ?>"><i class="fa-solid fa-angle-right"></i></a>
        <a href="<?= PATH ?>/countries/index/<?= $pages -1 ?>" class="pagination-btn <?= ($page + 2 > $pages) ? 'disabled' : '' ?>"><i class="fa-solid fa-angles-right"></i></a>
    </div> <br>
    
<!-- FIN PAGINATION DU BAS  -->