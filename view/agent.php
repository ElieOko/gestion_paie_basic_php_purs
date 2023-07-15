<?php
//Liste
//modal enregistrement
//modal suppression
//modal modification
include("../models/connexion.php");
include("../models/agents.php");
include("../models/fonction.php");
include("../models/grade.php");
include("../models/utilisateur.php");
$name = "";
if(isset($_SESSION['userId'])){
  $_SESSION['userId'] = 0;
$agent = new Agent();
$list_agent = $agent->getAll();
$fonction = new Fonction();
$grade = new Grade();
$list_fonction = $fonction->getAll();
$list_grade = $grade->getAll();
  $user = new Utilisateur();
  $user_connect = $user->getById($_SESSION['userId']); 
  $name = $user_connect['nom'];
}
else{
  header("location:http://localhost/TP_LICENCE/group_bl/view/authentification.php");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Page d'accueil</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">i</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">ui</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            <?=$name?>
          </button>
        </div>
      </div>


      <h2>Agents </h2>
      <div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading fw-normal lh-1">Espace agents.</h2>
    <span class="btn btn-primary"></span>  
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Créer un agent
  </button>
  </div>
  
</div>
<hr class="featurette-divider">
<?php
      if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        session_destroy();
      }
    ?>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Matricule</th>
              <th scope="col">Nom</th>
              <th scope="col">Postnom</th>
              <th scope="col">Prenom</th>
              <th scope="col">Genre</th>
              <th scope="col">Adresse</th>
              <th scope="col">Fonction</th>
              <th scope="col">Grade</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while($list=$list_agent->fetch()):?>
            <tr>
              <td><?=$list['matricule']?></td>
              <td><?=$list['nom']?></td>
              <td><?=$list['postnom']?></td>
              <td><?=$list['prenom']?></td>
              <td><?=$list['genre']?></td>
              <td><?=$list['adresse']?></td>
              <td><?=$list['fonction']?></td>
              <td><?=$list['grade']?></td>
              <td><div class="group-buttonn">
               <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$list['id']?>">Supprimer</button> 
              </div></td>
              <div class="modal fade  " id="exampleModal<?=$list['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Voulez-vous supprimer </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span>L'agent <?=$list['nom']?> </span>
        </div>
        <div class="modal-footer">
     
         
          <form action="../traitement.php" method="post">
            <input type="" class="form-control" name="id" value="<?=$list['id']?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
          <button type="submit" name="delete_agent" class="btn btn-primary">Oui</button>
          </form>
        </div>
      </div>
    </div>
  </div>
            </tr>
      
            <?php endwhile?>
          </tbody>
        </table>
      </div>
     
     
   


    <div class="modal fade  " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="../traitement.php" class="" style="padding:12px" method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Création agent</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
          <div class="d-flex">

      
            <div class="mb-4">
                <label for="">Matricule</label>
                <input type="text" name="matricule" class="form-control " id="">
            </div>
            <div class="form-group mb-4">
                <label for="">Nom</label>
                <input type="text" name="nom" class="form-control" id="">
            </div>
            </div>
            <div class="d-flex">
            <div class="form-group mb-4">
                <label for="">Postnom</label>
                <input type="text" name="postnom" class="form-control" id="">
            </div>
            <div class="form-group mb-4">
                <label for="">Prenom</label>
                <input type="text" name="prenom" class="form-control" id="">
            </div>
      
            </div>
            <div class="d-flex">
            <div class="form-group mb-4">
            <label for="">Genre</label>
            <select name="genre" class="form-control" id="">
                <option value="M">M</option>
                <option value="M">F</option>
            </select>
            </div>  
          <div class="form-group mb-4">
                <label for="">Adresse</label>
                <textarea rows="" class="form-control" name="adresse" cols=""></textarea>
            </div>
       
            </div>
            <div class="d-flex">
        <div class="form-group mb-4">
        <label for="">Fonction</label>
         <select name="fonction" class="form-control" id="">
            <?php while($list = $list_fonction->fetch()):?>
              <option value="<?=$list['id']?>"><?=$list['nom']?></option>
            <?php endwhile?>  
        </select>
       </div>
       <div class="form-group mb-4">
        <label for="">Grade</label>
         <select name="grade" class="form-control" id="">
         <?php while($list = $list_grade->fetch()):?>
              <option value="<?=$list['id']?>"><?=$list['nom']?></option>
            <?php endwhile?> 
        </select>
       </div>
         </div>

       <div class="d-flex">
            <button type="submit" class="btn btn-success" name="save">Enregistrer</button>   
       </div>
  
     
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
    </form>
  </div>

    </main>
    </div>
    </div>



      <script src="../assets/js/color-modes.js"></script>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.bundle.min.js"></script>

</body>
</html>




       