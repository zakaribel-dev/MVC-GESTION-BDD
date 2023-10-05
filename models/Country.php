
<?php

class Country extends Model
{

    public function __construct()
    {
        $this->table = "pays";

        $this->getConnection();
    }

    public function allCountries()
    {
        $sql = "SELECT country.*, NOM_CONTINENT 
            FROM " . $this->table . " country
            INNER JOIN continent NOM_CONTINENT ON country.ID_CONTINENT = NOM_CONTINENT.ID_CONTINENT 
            ORDER BY country.ID_PAYS DESC
            LIMIT 10";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function allContinents()
    {
        $sql = "SELECT * FROM continent";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


    public function insert(array $newCountry)
    {
        $sql = "INSERT INTO " . $this->table . "(NOM_PAYS,ID_CONTINENT) 
            VALUES (?,?)";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$newCountry['nom'],$newCountry['id']]);

    }
    

    public function update(array $updatedCountry)
    {
        $sql = "UPDATE " . $this->table . " set NOM_PAYS=?, ID_CONTINENT=? WHERE ID_PAYS=?";
        $query = $this->_connexion->prepare($sql);
        $query->execute([
         $updatedCountry['updatedCountry'],
         intval($updatedCountry['idContinent']),
         intval($updatedCountry['idCountry'])
        ]);
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE ID_PAYS=?";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$id]);
    }


}
