<br><br>

<h1 class="display-3">Liste des couleurs</h1>
<br>
<button class="btn" onclick="afficherFormulaire('displayFormColor')">Ouvrir/Fermer formulaire d'ajout</button>
<br><br>


<div id="displayFormColor">
    <form action="<?= PATH ?>/Couleurs/newColor" method="POST">
        Entrez une nouvelle couleur : <input type="text" name="couleur">
        <button type="submit" class="btn btn-dark">Valider</button>
    </form>
    <br>
</div>

<div class="table-container">
    <table class="table table-success table-hover">
        <tr>
            <th>Code</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($allColors as $color) : ?>
            <tr>
                <td><?= $color['ID_COULEUR'] ?></td>
                <td><?= $color['NOM_COULEUR'] ?></td>
                <td>
                    <a href="<?= PATH ?>/couleurs/edit/<?= $color['ID_COULEUR'] ?>">
                        <button class='btn btn-warning btn-sm fas fa-pencil-alt fa-sm'></button></a>
                        <a onclick="return confirmDelete(
                            '<?= $color['NOM_COULEUR'] ?>',
                            'deleteColor',
                            'couleurs',
                            '<?= $color['ID_COULEUR']?>')">
                        <button class='btn btn-danger btn-sm fas fa-trash-alt fa-sm'></button>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>

    </table>

</div>

<div class="colorSpace"></div>