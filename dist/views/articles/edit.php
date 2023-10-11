<h1 class="display-3">Saisissez vos modifications</h1>

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-6"> 
            <form action="<?= PATH ?>/Articles/updateArticle" method="POST">

                <input type="hidden" name="id" value="<?= $currentArticleId;?>">

                <div class="form-row"> 

                    <div class="form-group col-md-6"> 
                        <label for="nom">NOM :</label>
                        <input type="text" class="form-control custom-input" name="nom" required placeholder="<?=$currentArticle['NOM_ARTICLE']?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="prix">PRIX :</label>
                        <input type="number" class="form-control custom-input" name="prix" required placeholder="<?=$currentArticle['PRIX_ACHAT']?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="prix">VOLUME :</label>
                        <input type="number" class="form-control custom-input" name="volume" required placeholder="<?=$currentArticle['VOLUME']?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="prix">TITRAGE :</label>
                        <input type="number" class="form-control custom-input" name="titrage" required placeholder="<?=$currentArticle['TITRAGE']?>">
                    </div>
                </div>
          
                <div class="form-group">
                    <label for="marque">MARQUE :</label>
                    <select class="form-control custom-input" name="marque" required >
                    <option value="" disabled selected>Choisissez une marque</option>
                        <?php foreach ($allMarques as $marque): ?>
                            <option value="<?= $marque['ID_MARQUE'] ?>"><?= $marque['NOM_MARQUE'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">TYPE :</label>
                    <select class="form-control custom-input" name="type" required>
                    <option value="" disabled selected>Choisissez un type</option>
                        <?php foreach ($allTypes as $type): ?>
                            <option value="<?= $type['ID_TYPE'] ?>"><?= $type['NOM_TYPE'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="couleur">COULEUR :</label>
                    <select class="form-control custom-input" name="couleur" required>
                    <option value="" disabled selected>Choisissez une couleur</option>
                        <?php foreach ($allColors as $color): ?>
                            <option value="<?= $color['ID_COULEUR'] ?>"><?= $color['NOM_COULEUR'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-dark">Valider</button>
                </div>

            </form>
        </div>
    </div>
</div>
