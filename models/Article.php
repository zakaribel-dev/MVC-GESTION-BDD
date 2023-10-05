<?php

class Article extends Model
{

    public function __construct()
    {
        $this->table = "article";

        $this->getConnection();
    }


    public function allArticles()
    {
        $sql = "SELECT article.*, NOM_MARQUE, NOM_COULEUR, NOM_TYPE 
            FROM " . $this->table . " article
            LEFT JOIN marque NOM_MARQUE ON article.ID_MARQUE = NOM_MARQUE.ID_MARQUE
            LEFT JOIN couleur NOM_COULEUR ON article.ID_COULEUR = NOM_COULEUR.ID_COULEUR
            LEFT JOIN typebiere NOM_TYPE ON article.ID_TYPE = NOM_TYPE.ID_TYPE 
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
