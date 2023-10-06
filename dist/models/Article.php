<?php

class Article extends Model
{

    private $_start = 0;
    private $_rowsPerPage = 10;

    public function __construct()
    {
        $this->table = "article";

        $this->getConnection();
    }

    public function getStart()
    {
        return $this->_start;
    }

    public function getRowsPerPage()
    {
        return $this->_rowsPerPage;
    }

    public function setStart($start)
    {
        $this->_start = intval($start);
    }

    public function setRowsPerPage($rowsPerPage)
    {
        $this->_rowsPerPage = $rowsPerPage;
    }

    public function allArticles()
    {
        $countSql = "SELECT COUNT(*) as nbr_articles FROM article";
        $countQuery = $this->_connexion->prepare($countSql);
        $countQuery->execute();
        $countResult = $countQuery->fetch();


        $mainSql = "SELECT article.*, marque.NOM_MARQUE, couleur.NOM_COULEUR, typebiere.NOM_TYPE 
                    FROM article
                    LEFT JOIN marque ON article.ID_MARQUE = marque.ID_MARQUE 
                    LEFT JOIN couleur ON article.ID_COULEUR = couleur.ID_COULEUR
                    LEFT JOIN typebiere ON article.ID_TYPE = typebiere.ID_TYPE 
                    LIMIT " . $this->_start . "," . $this->_rowsPerPage;

        $mainQuery = $this->_connexion->prepare($mainSql);
        $mainQuery->execute();
        $allArticles = $mainQuery->fetchAll();

        $allArticles[0]['nbr_articles'] = $countResult['nbr_articles'];

        return $allArticles;
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

    public function articlesNumber()
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
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
