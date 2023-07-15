<?php

class Utilisateur{
    private $nom;
    private $prenom;
    private $nom_complet;
    private $mail;
    private $mot_de_passe;
    private $genre; 

    public function __construct($nom = "",$prenom = "",$nom_complet ="",$mail ="",$mot_de_passe="",$genre=""){
        $this->nom              = $nom;
        $this->nom_complet      = $nom_complet;
        $this->prenom           = $prenom;
        $this->mail             = $mail;
        $this->mot_de_passe     = $mot_de_passe;
        $this->genre            = $genre;
    }

    public function save(array $data){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("INSERT INTO utilisateur(nom,prenom,nom_complet,mail,mot_de_passe,genre)VALUES(?,?,?,?,?,?)");
            $state->execute($data);
            return "Enregistrement réussie avec succès";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }
    public function getAll(){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $data = $requete->query("SELECT * FROM utilisateur");
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
            $data = $requete->query("SELECT * FROM utilisateur where id = $id");
            return $data->fetch();
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }
    public function update($id,array $data){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("UPDATE utilisateur set  nom = ?,prenom = ?,nom_complet = ?,mail =?,genre =? where id = $id");
            $state->execute($data);
            return "Modification réussie avec succès";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }
    public function auth(){
       try {
        $requete = Connexion::connexion_start();
        $state = $requete->prepare("SELECT * FROM utilisateur where mail = ? and mot_de_passe = ?");
        $state->execute([$this->mail,$this->mot_de_passe]);
        $_SESSION['userId'] = $state->fetch()["id"];
        header("location:http://localhost/TP_LICENCE/group_bl/view/index.php");
       } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
       }
    }
    public function update_password($id,array $data){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("UPDATE utilisateur set mot_de_passe = ? where id = $id");
            $state->execute($data);
            return "Modification réussie avec succès du mot de passe";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }

    public function delete($id){
        try {
            //code...
            $requete = Connexion::connexion_start();
            $state = $requete->prepare("UPDATE FROM utilisateur where id = $id");
            $state->execute($data);
            return "Suppression réussie avec succès";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
       
    }















}



?>