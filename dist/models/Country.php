
<?php

class Country extends Model
{
    private $_start = 0;
    private $_rowsPerPage = 10;

    public function __construct()
    {
        $this->table = "pays";

        $this->getConnection();
    }

    public function getRowsPerPage()
    {
        return $this->_rowsPerPage;
    }

    public function setStart($start)
    {
        $this->_start = intval($start);
    }


    public function allCountries()
    {

        $countSql = "SELECT COUNT(*) as nbr_countries FROM pays";
        $countQuery = $this->_connexion->prepare($countSql);
        $countQuery->execute();
        $countResult = $countQuery->fetch();


        $mainSql = "SELECT country.*, NOM_CONTINENT 
            FROM " . $this->table . " country
            INNER JOIN continent NOM_CONTINENT ON country.ID_CONTINENT = NOM_CONTINENT.ID_CONTINENT 
            ORDER BY country.ID_PAYS ASC
            LIMIT " . $this->_start . "," . $this->_rowsPerPage;

        $mainQuery = $this->_connexion->prepare($mainSql);
        $mainQuery->execute();
        $allCountries = $mainQuery->fetchAll();

        $allCountries[0]['nbr_countries'] = $countResult['nbr_countries'];

        return $allCountries;
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
        $query->execute([$newCountry['nom'], $newCountry['id']]);
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
