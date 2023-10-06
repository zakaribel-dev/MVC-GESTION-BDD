<?php
abstract class Model{
    private $host = "localhost";
    private $db_name = "agagagag";
    private $username = "tauras pas l'username";
    private $password = "tauras pas le mdp";
     
    protected $_connexion;

    public $table;
    public $id; 
                
    abstract public function update(array $values);
    abstract public function insert(array $values);
    abstract public function delete(int $id);

  
    public function getConnection(){
        // On supprime la connexion précédente
        $this->_connexion = null;

        // On essaie de se connecter à la base
        try{
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec("set names utf8");
        }catch(PDOException $exception){
            
            echo "Erreur de connexion : " . $exception->getMessage();
          
        }
    }

 
    public function getOne()
    {
        $cle_recherchee = "";
        $tab_cles = array();
        foreach ($this->id as $key => $value){
            $tab_cles[] = $key. "=".$value;
        }
        $cle_recherchee = implode(" AND ",  $tab_cles );


        $sql = "SELECT * FROM ".$this->table." WHERE ". $cle_recherchee;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    
    public function getAll(){
        $sql = "SELECT * FROM ".$this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();    
    }

}