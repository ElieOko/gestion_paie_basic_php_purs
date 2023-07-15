<?php
class Fonction{
    private $id;
    private $nom;
    private $description;
    public function __construct($id = 0,$nom="",$description=""){
        $this->id   = $id;
        $this->nom = $nom;
        $this->description = $description;
    }

    public function save(){
        try {
            //code...
            $data = [$this->nom,$this->description];
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("INSERT INTO fonction(nom,description)VALUES(?,?)");
            $state->execute($data);
            $_SESSION['msg'] = "Enregistrement réussie avec succès";
            header("location:http://localhost/TP_LICENCE/group_bl/view/fonction.php");
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
            $state = $requete->prepare("UPDATE fonction set nom = ?, description = ? where id = $id");
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
            $data = $requete->query("SELECT * FROM fonction");
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
            $data = $requete->query("SELECT * FROM fonction where id = $id");
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
            $state = $requete->prepare("DELETE FROM fonction where id = $id");
            $state->execute($data);
            $_SESSION['msg'] = "Suppression réussie avec succès";
            header("location:http://localhost/TP_LICENCE/group_bl/view/fonction.php");
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }











}





?>