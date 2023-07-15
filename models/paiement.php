<?php

class Paiement{
   private $id;
   private $periode;
   private $montant_debit;
   private $montant_credit;
   private $libelle;
   public function __construct($id = 0,$periode="",$montant_debit=0,$montant_credit=0,$libelle=""){
      $this->id             = $id;
      $this->periode        = $periode;
      $this->montant_credit = $montant_credit;
      $this->montant_debit  = $montant_debit;
      $this->libelle        = $libelle;

  }

   public function save(){
      try {
          //code...
          $requete = Connexion::connexion_start();
          $data = [$this->periode,$this->montant_debit,$this->montant_credit,$this->libelle];
          $state = $requete->prepare("INSERT INTO paiement(periode,montant_debit,montant_credit,libelle)VALUES(?,?,?,?)");
          $state->execute($data);
          $_SESSION['msg'] = "Enregistrement réussie avec succès";
          header("location:http://localhost/TP_LICENCE/group_bl/view/paiement.php");
      } catch (\Throwable $th) {
          //throw $th;
          echo $th->getMessage();
      }
  }
  public function update(array $data, $id)
  {
      # code...
      try {
          $requete = Connexion::connexion_start();
          $state = $requete->prepare("UPDATE paiement set periode = ?, montant_debit = ?,montant_credit = ?,libelle = ? where id = $id");
          $state->execute($data);
          return "Modification réussie avec succès";
      } catch (\Throwable $th) {
          echo $th->getMessage();
      }
     
  }
  public function getAll()
  {
      # code...
      try {
          //code...
          $requete = Connexion::connexion_start();
          $data = $requete->query("SELECT * FROM paiement");
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
          $data = $requete->query("SELECT * FROM paiement where id = $id");
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
          $state = $requete->prepare("DELETE FROM paiement where id = $id");
          $state->execute($data);
          return "Suppression réussie avec succès";
      } catch (\Throwable $th) {
          //throw $th;
          echo $th->getMessage();
      }
     
  }
}





?>