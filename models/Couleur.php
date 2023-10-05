
<?php

class Couleur extends Model
{

    public function __construct()
    {
        $this->table = "couleur";

        $this->getConnection();
    }


    public function update(array $updatedcolor)
    {
        $sql = "UPDATE " . $this->table . " set NOM_COULEUR=? WHERE ID_COULEUR=?";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$updatedcolor['nom'], $updatedcolor['id']]);
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE ID_COULEUR=?";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$id]);
    }

    public function insert(array $newColor)
    {
        $sql = "INSERT INTO " . $this->table . " (NOM_COULEUR) VALUES (?)";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$newColor['nom']]);
    }
}
