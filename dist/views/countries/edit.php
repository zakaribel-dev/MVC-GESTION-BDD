<br><br>

<h1 class="display-3">Saisissez vos modifications</h1>

<br><br>
<form action="<?= PATH ?>/Countries/updateCountry" method="POST">
<input type="hidden" name="id" value="<?= $currentCountryId;?>">

 <input type="text" name="updatedCountry" required placeholder="<?= $currentCountry['NOM_PAYS'] ?>"> 

    <select name="updatedContinent">
    <option value="" disabled selected>Choisissez un continent</option>
    <?php foreach ($allContinents as $continent): ?>
    <option value="<?= $continent['ID_CONTINENT'] ?>"><?= $continent['NOM_CONTINENT'] ?></option>
    <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-dark">Valider</button>
</form>
