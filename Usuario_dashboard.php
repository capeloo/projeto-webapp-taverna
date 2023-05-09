<?php 
    session_start();

    if(empty($_SESSION)){
        echo "<script>location.href='Login.php';</script>";
    }
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="Usuario_dashboard.php">A Taverna</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?page=edita">Editar perfil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mais
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cadastra-mesa.php">Cadastrar mesa</a></li>
            <li><a class="dropdown-item" href="?page=mostraMesasU">Minhas mesas</a></li>
            <li><a class="dropdown-item" href="todas-mesas.php">Todas as mesas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="fale-conosco.php">Fale conosco</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Pesquisar Usuário" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
      </form>
    </div>
  </div>
</nav>  


<div class="container">
  <div class="row">
    <div class="col mt-5">
      <?php
        switch(@$_REQUEST["page"]){
        case"edita":
          include("Editar_perfil.php");
        break;  
        case"mostraMesasU":
          include("mesas-usuario.php");
        break;  
        default: 
          
        }

      ?>
    </div>    
  </div>
</div>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-image" 
      style="background-image: url('./Imagens/bg.jpg'); 
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;">
    <div class="container-fluid text-center mt-4 bg-light" style="width: 400px;">
        <h1 class="p-4">Seja bem vindo, <?php echo $_SESSION['apelido'] ?>!</h1>
        <div class="p-4">
            <a href="logout.php" class="btn btn-danger" style="width: 100px;">Sair</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>