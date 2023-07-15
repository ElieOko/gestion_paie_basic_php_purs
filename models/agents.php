<?php
class Agent{
    private $id;
    private $matricule;
    private $nom;
    private $postnom;
    private $prenom;
    private $genre;
    private $fonction;
    private $grade;
    private $adresse;
    

    public function __construct($id =0,$matricule="",$nom="",$postnom="",$prenom="",$fonction=0,$grade=0,$adresse="",$genre=""){
        $this->id           = $id;
        $this->matricule    = $matricule;
        $this->nom          = $nom;
        $this->postnom      = $postnom;
        $this->prenom       = $prenom;
        $this->fonction     = $fonction;
        $this->grade        = $grade;
        $this->adresse      = $adresse;
        $this->genre        = $genre;
    }

    public function save(){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("INSERT INTO agent(matricule,nom,postnom,prenom,fonction,grade,genre,adresse)VALUES(?,?,?,?,?,?,?,?)");
            $data =[$this->matricule,$this->nom,$this->postnom,$this->prenom,$this->fonction,$this->grade,$this->genre,$this->adresse];
            $state->execute($data);
            $_SESSION['msg'] = "Enregistrement réussie avec succès";
            header("location:http://localhost/TP_LICENCE/group_bl/view/agent.php");
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }
    public function getAll(){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $data = $requete->query("SELECT * FROM agent");
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }
    public function getById($id){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $data = $requete->query("SELECT * FROM agent where id = $id");
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }
    public function update($id,array $data){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("UPDATE agent set matricule = ?, nom = ?,postnom = ?,prenom = ?,fonction = ?,grade =? where id = $id");
            $state->execute($data);
            return "Modification réussie avec succès";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }

    public function delete($id){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("DELETE FROM agent where id = $id");
            $state->execute($data);
            $_SESSION['msg'] = "Suppression réussie avec succès";
            header("location:http://localhost/TP_LICENCE/group_bl/view/agent.php");
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }

}









?>