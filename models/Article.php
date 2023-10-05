<?php

class Article extends Model
{

    public function __construct()
    {
        $this->table = "article";

        $this->getConnection();
    }


    public function allArticles()
    {   // article.* = toute mes colonnes de ma table article 
        // Ensuite je recupere 3 colonnes chacunes étant des colonnes étrangères (nom_marque,nom_couleur et nom_type)
        //au niveau de mon premier join, je dis join la table étrangère 
        //et dis que l'id_marque de ma table article doit correspondre à l'idmarque de ma table étrangère "marque" etc etc
        $sql = "SELECT article.*, marque.NOM_MARQUE, couleur.NOM_COULEUR, typebiere.NOM_TYPE 
        FROM article
        LEFT JOIN marque ON article.ID_MARQUE = marque.ID_MARQUE 
        LEFT JOIN couleur ON article.ID_COULEUR = couleur.ID_COULEUR
        LEFT JOIN typebiere ON article.ID_TYPE = typebiere.ID_TYPE 
        ORDER BY article.ID_ARTICLE DESC
        LIMIT 15";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function allTypes()
    {
        $sql = "SELECT * FROM typebiere";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function allMarques()
    {
        $sql = "SELECT * FROM marque";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


    public function insert(array $article)
    {

        $sql = "INSERT INTO " . $this->table . "(NOM_ARTICLE,PRIX_ACHAT,VOLUME,TITRAGE,ID_MARQUE,ID_COULEUR,ID_TYPE) 
            VALUES (?,?,?,?,?,?,?)";

        $query = $this->_connexion->prepare($sql);
        $query->execute([
            $article['nom'],
            $article['prix'],
            $article['volume'],
            $article['titrage'],
            $article['id_marque'],
            $article['id_couleur'],
            $article['id_type']
        ]);
    }
    public function update(array $updatedArticle)
    {
        $sql = "UPDATE " . $this->table . "
            SET NOM_ARTICLE = ?, PRIX_ACHAT =?, VOLUME = ?, TITRAGE=?, ID_MARQUE=?, ID_COULEUR=?, ID_TYPE=?
            WHERE ID_ARTICLE = ?";

        $query = $this->_connexion->prepare($sql);
        $query->execute([
            $updatedArticle['nom'],
            $updatedArticle['prix'],
            $updatedArticle['volume'],
            $updatedArticle['titrage'],
            $updatedArticle['id_marque'],
            $updatedArticle['id_couleur'],
            $updatedArticle['id_type'],
            $updatedArticle['id']
        ]);
    }



    public function delete(int $id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE ID_ARTICLE=?";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$id]);
    }

  
}
