<?php
//Liste
//modal enregistrement
//modal suppression
//modal modification
include("../models/connexion.php");
include("../models/paiement.php");
include("../models/agents.php");
include("../models/paiement_agent.php");

$agent = new Agent();
$list_agent = $agent->getAll();
$paie_agent = new PaiementAgent();

$paie_agent_list = $paie_agent->getAll();

$paie = new Paiement();

$list_paie = $paie->getAll();
$_SESSION['userId'] = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaiementAgent </title>
   
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    

    

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
<style>
    .form-control{
        width: 250px;
    }
    form{
        margin: 234px;
    }
</style>
</head>
<body>
 
<div class="container-fluid">
  <div class="row">
    <?php
include("navbar.php");
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
<br><br><br><br>
<div class="row featurette">
  <div class="col-md-7">
  <?php
      if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        session_destroy();
      }
    ?>
    <h2 class="featurette-heading fw-normal lh-1">Espace integration de la paie agent.</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Créer un paiement
  </button>
  </div>
  
</div>

    <h1 style="align-item:center;">Tout les paiements et leurs évolutions</h1>


<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Agents</th>
              <th scope="col">Paiement</th>
              <th scope="col">Montant</th>
              <th scope="col">Disponible</th>
              
            </tr>
          </thead>
          <tbody>
            <?php while($list= $paie_agent_list->fetch()):     ?>
            <tr>
             
                <td><?=$list['agent_id']?><?=($agent->getById($list['agent_id']))->fetch()["nom"]?></td>
                <td><?=$paie->getById($list['paiement_id'])->fetch()["libelle"]?></td>
                <td><?=$list['montant']?></td>
                <td><?=$paie->getById($list['paiement_id'])->fetch()["montant_debit"] - $list['montant'] ?></td>
               
            </tr>
            <?php endwhile ?>
          </tbody>
        </table>
      </div>
     

   

    <div class="modal fade  " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="../traitement.php" class="" style="padding:12px" method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Création Paiement</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="d-flex">
            <div class="form-group mb-4">
                <label for="">Montant</label>
                <input type="number" class="form-control " name="montant" placeholder="ex:Paiement agent" id="">
            </div>
            <div class="form-group mb-4">
               <label for="">Agent</label>
               <select name="agent_id" id="" class="form-control">
                <?php
                    while($agent = $list_agent->fetch()):
                ?>
                    <option value="<?=$agent['id']?>"><?=$agent['nom']?>(<?=$agent['matricule']?>)</option>
                    <?php endwhile?>
               </select>
            </div>
        </div>
        <div class="form-group mb-4">
               <label for="">Paiement</label>
               <select name="paiement_id" id="" class="form-control">
                <?php while($paie = $list_paie->fetch()):?>
                    <option value="<?=$paie['id']?>"><?=$paie['libelle']?></option>
                <?php endwhile ?>    
               </select>
        </div>

       <div class="d-flex">
            <button type="submit" class="btn btn-success" name="save_paiement_agent">Enregistrer</button>   
       </div>
        </div>
        
        </div>
      

            </form>
            </div>
                </main>
                </div>
                </div> 
      <script src="../assets/js/color-modes.js"></script>
      <script src="../assets/dist/js/bootstrap.bundle.bundle.min.js"></script>
   
      <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>