<?php

class Service{
    private $id;
    private $nom;
    private $description;
    private $effectif;
    public function __construct($id = 0,$nom="",$description="",$effectif=0){
        $this->id           = $id;
        $this->nom          = $nom;
        $this->description  = $description;
        $this->effectif     = $effectif;
    }

    public function save(){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $data = [$this->nom,$this->description,$this->effectif];
            $state = $requete->prepare("INSERT INTO service(nom,description,effectif)VALUES(?,?,?)");
            $state->execute($data);
            return "Enregistrement réussie avec succès";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }
    public function update(array $data, $id)
    {
        # code...
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("UPDATE service set nom = ?, description = ?,effectif = ? where id = $id");
            $state->execute($data);
            return "Modification réussie avec succès";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }
    public function getAll()
    {
        # code...
        try {
            //code...
            $requete = Connexion::connexion_start();
            $data = $requete->query("SELECT * FROM service");
            return $data;
        } catch (\Throwable $th) { 
            //throw $th;
            echo $th->getMessage();
        }
    }
    public function getById($id)
    {
        # code...
        try {
            //code...
            $requete = Connexion::connexion_start();
            $data = $requete->query("SELECT * FROM service where id = $id");
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }
    public function delete($id)
    {
        # code...
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("DELETE FROM service where id = $id");
            $state->execute($data);
            return "Suppression réussie avec succès";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }
}





?>