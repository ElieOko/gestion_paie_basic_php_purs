<?php
include("../models/connexion.php");
include("../models/fonction.php");
include("../models/grade.php");

$fonction = new Fonction();
$grade = new Grade();
$list_grade = $grade->getAll();
$list_fonction = $fonction->getAll();
$_SESSION['userId'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">

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
<div class="row featurette">
  <div class="col-md-7">
    <?php
      if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        session_destroy();
      }
    ?>
    <br><br><br><br>
    <h2 class="featurette-heading fw-normal lh-1">Espace integrations grade.</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Créer un grade
  </button>
  </div>
  
</div>
<center>
    <h1>Liste des grades</h1>
</center>

<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
            <th scope="col">Nom</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while($list=$list_grade->fetch()):?>
            <tr>
                <td><?=$list['nom']?></td>
                <td><?=$list['description']?></td>
                <td>
                    <div class="group-buttonn">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$list['id']?>">Supprimer</button>
                    </div>
                </td>
                <div class="modal fade  " id="exampleModal<?=$list['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Voulez-vous supprimer </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span>Le grade <?=$list['nom']?> </span>
        </div>
        <div class="modal-footer">
     
         
          <form action="../traitement.php" method="post">
            <input type="" class="form-control" name="id" value="<?=$list['id']?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
          <button type="submit" name="delete_grade" class="btn btn-primary">Oui</button>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Création Grade</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="d-flex">
            <div class="form-group mb-4">
                <label for="">Nom</label>
                <input type="text" class="form-control " name="nom" id="">
            </div>
            <div class="form-group mb-4">
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" class="form-control" rows="10"></textarea>
            </div>
        </div>
       <div class="d-flex">
       <button type="submit" class="btn btn-success" name="save_grade">Enregistrer</button>   
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