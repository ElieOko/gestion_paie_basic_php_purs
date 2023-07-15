<?php

class PaiementAgent{
    private $id;
    private $agent_id;
    private $paiement_id;
    private $montant;

    public function __construct($id =0,int $agent_id = 0,int $paiement_id = 0,int $montant = 0){
        $this->id = $id;
        $this->agent_id = $agent_id;
        $this->paiement_id = $paiement_id;
        $this->montant = $montant;
    }
    public function save(array $data){
        $requete = Connexion::connexion_start();
        $id = $data[1];
       
        $verification = $requete->query("SELECT * FROM paiement where id = $id");
        $paiement = $verification->fetch();
        $message = "Budget non disponible";
        $montantEnter = $data[2];
        $montant_credit =$montantEnter + ($paiement["montant_credit"]);
        // var_dump($paiement['montant_debit'],$montant_credit);
        // die($montant_credit);
        if($montant_credit < $paiement['montant_debit']){
            $solde = $paiement['montant_debit'] - $montant_credit;
            $data[3] = $solde;
            // $data =[$this->agent_id,$this->paiement_id,$this->montant,$solde];
            $paie_change = $requete->query("UPDATE paiement SET montant_credit = $montant_credit where id = $id");

            $state = $requete->prepare("INSERT INTO paiement_agent(agent_id,paiement_id,montant,solde)VALUES(?,?,?,?)");

            $state->execute($data);

            $_SESSION['msg'] = "Enregistrement réussie avec succès";
            header("location:http://localhost/TP_LICENCE/group_bl/view/paiement_agent.php");
        }
        else{
            $_SESSION['msg'] = $message;
            header("location:http://localhost/TP_LICENCE/group_bl/view/paiement_agent.php");
        }



    }
    public function getAll()
    {
        # code...
        try {
            //code...
            $requete = Connexion::connexion_start();
            $data = $requete->query("SELECT * FROM paiement_agent");
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
            $data = $requete->query("SELECT * FROM paiement_agent where agent_id = $id");
            return $data;
        } catch (\Throwable $th) { 
            //throw $th;
            echo $th->getMessage();
        }
    }

}





?>