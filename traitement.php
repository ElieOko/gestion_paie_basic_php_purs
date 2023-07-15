<?php
include("models/connexion.php");
include("models/agents.php");
include("models/fonction.php");
include("models/grade.php");
include("models/service.php");
include("models/utilisateur.php");
include("models/paiement.php");
include("models/paiement_agent.php");

//Agent
if(isset($_POST["save"])){
    if(
        isset($_POST['matricule']) && 
        isset($_POST['nom']) &&
        isset($_POST['postnom']) &&
        isset($_POST['prenom'])  &&
        isset($_POST['genre'])  &&
        isset($_POST['fonction'])  &&
        isset($_POST['grade'])  && 
        isset($_POST['adresse'])
        ){
        if(
            !empty($_POST['matricule'])&&
            !empty($_POST['nom']) &&
            !empty($_POST['postnom']) &&
            !empty($_POST['prenom']) &&
            !empty($_POST['genre']) &&
            !empty($_POST['fonction']) &&
            !empty($_POST['grade']) &&
            !empty($_POST['adresse'])
            ){  
                $agent = new Agent(0,
                    strip_tags($_POST['matricule']),
                    strip_tags($_POST['nom']),
                    strip_tags($_POST['postnom']),
                    strip_tags($_POST['prenom']),
                    strip_tags($_POST['fonction']),
                    strip_tags($_POST['grade']),
                    strip_tags($_POST['adresse']),
                    strip_tags($_POST['genre']) 
                );
                $agent->save();
            }
            else{
                die("no");
            }
    }
   
}
//delete agent
if(isset($_POST['delete_agent'])){
    $agent = new Agent();
    $agent->delete($_POST['id']);
}
//delete grade
if(isset($_POST['delete_grade'])){
    $agent = new Grade();
    $agent->delete($_POST['id']);
}
//delete fonc
if(isset($_POST['delete_fonction'])){
    $agent = new Fonction();
    $agent->delete($_POST['id']);
}

//Fonction
if(isset($_POST["save_fonction"])){
    if (
        (isset($_POST['nom'])  && !empty($_POST['nom'])) &&
        (isset($_POST['description'])  && !empty($_POST['description']))
    ) {
        try {
            $fonction = new Fonction(0,strip_tags($_POST['nom']),strip_tags($_POST['description']));
            $fonction->save();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
       
    }
}


//Paiement
if(isset($_POST["save_paiement"])){

    if(
        isset($_POST['libelle'])&&
        isset($_POST['montant_debit'])&&
        isset($_POST['periode'])){
            if (
                !empty($_POST['libelle'])&&
                !empty($_POST['montant_debit'])&&
                !empty($_POST['periode'])
            ) 
            {
               
               $paie = new Paiement(0,strip_tags($_POST['periode']),strip_tags($_POST['montant_debit']),0,strip_tags($_POST['libelle']));
         
               $paie_state = $paie->save();
            }
        }
}












//Grade
if(isset($_POST['save_grade'])){
    if (
        (isset($_POST['nom'])  && !empty($_POST['nom'])) &&
        (isset($_POST['description'])  && !empty($_POST['description']))
    ) {
        try {
            $grade = new Grade(0,strip_tags($_POST['nom']),strip_tags($_POST['description']));
            $grade->save();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
       
    }
}

//Auth
if(isset($_POST['auth'])){
    if(isset($_POST['password']) && isset($_POST['mail'])){
        if(!empty($_POST['password']) && !empty($_POST['mail'])){
            try {
                //code...

            $auth = new Utilisateur("","","",strip_tags($_POST['mail']),strip_tags($_POST['password']),"");
            $auth->auth();
            } catch (\Throwable $th) {
                //throw $th;
            }
            
        }
    }
}
//PaiementAgent

if(isset($_POST['save_paiement_agent'])){
    
    if(isset($_POST['paiement_id']) && isset($_POST['agent_id'])&& isset($_POST['montant']) ){
       
      if(!empty($_POST['paiement_id']) && !empty($_POST['agent_id'])&& !empty($_POST['montant'])){
        try {
           
            $paie_agent = new PaiementAgent();
            // die($_POST['paiement_id']);
            $data = [$_POST['agent_id'],$_POST['paiement_id'],$_POST['montant'],0];
            $paie_agent->save($data);
        } catch (\Throwable $th) {
            //throw $th;
            die($th->getMessage());
        }
       
      }  
      else{
        die("Live");
      }
    }
    else{
        die("No verify");
    }
}


?>