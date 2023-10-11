<br><br>
<h1 class="display-3">Modification de couleur</h1>
<br>

<form action="<?= PATH ?>/couleurs/updateColor" method="POST">
<br>
<br>
<input type="hidden" name="id" value="<?= $currentColorId;?>">
<input type="text" name="updatedColor" required placeholder="<?=$currentColor['NOM_COULEUR']?>">
<button type="submit" class="btn btn-dark">Valider</button>

</form>

