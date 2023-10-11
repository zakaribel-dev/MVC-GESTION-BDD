<br><br>
<h1 class="display-3">Liste des articles</h1>
<br>
<button class="btn btn-info" onclick="afficherFormulaire('displayForm')">Ajouter</button> 
<br><br>

<div id="displayForm">
  <div class="container mx-auto" >
    <form action="<?= PATH ?>/Articles/newArticle" method="POST" class="form-inline">

      <input type="hidden" name="page" value="page">

      <div class="mb-3 mr-3">
        <label for="nom" class="form-label">NOM :</label>
        <input type="text" class="form-control" name="nom" required>
      </div>

      <div class="mb-3 mr-3">
        <label for="prix" class="form-label">PRIX :</label>
        <input type="number" class="form-control" name="prix" required>
      </div>

      <div class="mb-3 mr-3">
        <label for="volume" class="form-label">VOLUME :</label>
        <input type="number" class="form-control" name="volume" required>
      </div>

      <div class="mb-3 mr-3">
        <label for="titrage" class="form-label">TITRAGE :</label>
        <input type="number" class="form-control" name="titrage" required>
      </div>

      <div class="mb-3 mr-3">
        <label for="type" class="form-label">TYPE :</label>
        <select class="form-select" name="type" required>
          <?php foreach ($allTypes as $type): ?>
            <option value="<?= $type['ID_TYPE'] ?>"><?= $type['NOM_TYPE'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3 mr-3">
        <label for="couleur" class="form-label">COULEUR :</label>
        <select class="form-select" name="couleur" required>
          <?php foreach ($allColors as $color): ?>
            <option value="<?= $color['ID_COULEUR'] ?>"><?= $color['NOM_COULEUR'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3 mr-3">
        <label for="marque" class="form-label">MARQUE :</label>
        <select class="form-select" name="marque" required>
          <?php foreach ($allMarques as $marque): ?>
            <option value="<?= $marque['ID_MARQUE'] ?>"><?= $marque['NOM_MARQUE'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-dark mobile">Valider</button>
    </form>
  </div>
</div>
 <!-- PAGINATION DU HAUT-->
    <div class="pagination-container">
        <a href="<?= PATH ?>/articles/index/0" class="pagination-btn <?= ($page === null || $page < 1) ? 'disabled' : '' ?>"><i class="fa-solid fa-angles-left"></i></a>
        <a href="<?= PATH ?>/articles/index/<?= $page - 1 ?>" class="pagination-btn <?= ($page === null || $page < 1) ? 'disabled' : '' ?> "><i class="fa-solid fa-angle-left"></i></a>

        <div class="page-info">
        Page <?php echo @$page + 1; ?> sur <?php echo @$pages; ?>
    </div>

        <a href="<?= PATH ?>/articles/index/<?= $page + 1 ?>" class="pagination-btn <?= ($page + 2 > $pages) ? 'disabled' : '' ?>"><i class="fa-solid fa-angle-right"></i></a>
        <a href="<?= PATH ?>/articles/index/<?= $pages -1 ?>" class="pagination-btn <?= ($page + 2 > $pages) ? 'disabled' : '' ?>"><i class="fa-solid fa-angles-right"></i></a>
    </div> <br>
    <!-- FIN PAGINATION DU HAUT  -->

<div class="table-container"> 
<table class="table table-secondary table-hover">
    <tr>
        <th>Code</th>
        <th>Nom Article</th>
        <th>Prix</th>
        <th>Volume</th>
        <th>Titrage</th>
        <th>Marque</th>
        <th>Type</th>
        <th>Couleur</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($allArticles as $article) : ?>
        <tr>
            <td><?= $article['ID_ARTICLE'] ?></td>
            <td><?= $article['NOM_ARTICLE'] ?></td>
            <td><?= $article['PRIX_ACHAT'] ?> €</td>
            <td><?= $article['VOLUME'] ?> </td>
            <td><?= $article['TITRAGE'] ?> </td>
            <td><?= $article['NOM_MARQUE'] ?> </td>
            <td><?= $article['NOM_COULEUR'] ?> </td>
            <td><?= $article['NOM_TYPE'] ?> </td>
            <td>
                    <a href="<?= PATH ?>/articles/edit/<?= $article['ID_ARTICLE'] ?>">
                    <button class='btn btn-info btn-sm fas fa-pencil-alt fa-sm'></button></a>
                    <a onclick="return confirmDelete(
                    '<?= $article['NOM_ARTICLE'] ?>',
                    'deleteArticle',
                    'articles',
                    <?= $article['ID_ARTICLE']?>)">
                        <button class='btn btn-danger btn-sm fas fa-trash-alt fa-sm'></button>
                    </a>
            </td>
        </tr>
    <?php endforeach ?>
    </table>

      
</div>
</div>
 <!-- PAGINATION DU BAS-->
 <div class="pagination-container">
        <a href="<?= PATH ?>/articles/index/0" class="pagination-btn <?= ($page === null || $page < 1) ? 'disabled' : '' ?>"><i class="fa-solid fa-angles-left"></i></a>
        <a href="<?= PATH ?>/articles/index/<?= $page - 1 ?>" class="pagination-btn <?= ($page === null || $page < 1) ? 'disabled' : '' ?> "><i class="fa-solid fa-angle-left"></i></a>

        <div class="page-info">
       Page <?php echo @$page + 1; ?> sur <?php echo @$pages; ?>
    </div>

        <a href="<?= PATH ?>/articles/index/<?= $page + 1 ?>" class="pagination-btn <?= ($page + 2 > $pages) ? 'disabled' : '' ?>"><i class="fa-solid fa-angle-right"></i></a>
        <a href="<?= PATH ?>/articles/index/<?= $pages -1 ?>" class="pagination-btn <?= ($page + 2 > $pages) ? 'disabled' : '' ?>"><i class="fa-solid fa-angles-right"></i></a>
    </div> <br>
    <!-- FIN PAGINATION DU BAS  -->
