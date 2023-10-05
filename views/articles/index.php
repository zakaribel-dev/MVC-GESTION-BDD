<br><br>
<h1 class="display-3">Liste des articles</h1>
<br>
<button class="btn btn-info" onclick="afficherFormulaire()">Ajouter</button> 
<br><br>
<div id="displayForm">
<form action="<?= PATH ?>/Articles/newArticle" method="POST">
<i>Pour cacher le formulaire d'ajout, cliquez une deuxieme fois sur le bouton "Ajouter"</i><br><br>

    NOM : <input type="text" name="nom">   
    PRIX : <input type="number" name="prix"> 
    VOLUME : <input type="number" name="volume"> 
    TITRAGE : <input type="number" name="titrage"> <br><br>

    MARQUE :
    <select name="marque" >
    <?php foreach ($allMarques as $marque): ?>
    <option value="<?= $marque['ID_MARQUE'] ?>"><?= $marque['NOM_MARQUE'] ?></option>
    <?php endforeach; ?>
    </select>
    TYPE :
    <select name="type" >
    <?php foreach ($allTypes as $type): ?>
    <option value="<?= $type['ID_TYPE'] ?>"><?= $type['NOM_TYPE'] ?></option>
    <?php endforeach; ?>
    </select>

    COULEUR :        
    <select name="couleur" >
    <?php foreach ($allColors as $color): ?>
    <option  value="<?= $color['ID_COULEUR'] ?>"><?= $color['NOM_COULEUR'] ?></option>
    <?php endforeach; ?>
    </select>

    <button type="submit" class="btn btn-dark">Valider</button>
 <br><br><br><br>


</form> 

</div>
<div class="table-container">

<table class="table table-success table-hover">
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
                <a onclick="return confirm('Etes vous sur de vouloir supprimer cet article ?')" href="<?= PATH ?>/articles/deleteArticle/<?= $article['ID_ARTICLE']?>">
                    <button class='btn btn-danger btn-sm fas fa-trash-alt fa-sm'></button></a>
            </td>
        </tr>
    <?php endforeach ?>

    </table>

    </div>