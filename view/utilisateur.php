<?php
//Liste
//modal enregistrement
//modal suppression
//modal modification
include("../models/connexion.php");
include("../models/utilisateur.php");

$grade = new Grade();
$list_grade = $agent->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
    
<?php
include("navbar.php");

?>
<br>
<br>
<br>
<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading fw-normal lh-1">Espace integration grade XR-Junior.</h2>
    <span class="btn btn-primary">Créer un grade</span>
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
              <td><div class="group-buttonn">
                <button class="btn btn-danger">Supprimer</button>
                <button class="btn btn-primary">Modifier</button>
              </div></td>
            </tr>
            <?php endwhile?>
          </tbody>
        </table>
      </div>
     
      <form action="../traitement.php" method="post">
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
    </form>
   
      <script src="../assets/js/color-modes.js"></script>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>