<?php
//Script das minhas mesas

      //Inicia a sessão (necessário ter em todas as páginas que o usuário estiver logado)
      session_start();

      //Traz o arquivo config.php onde foi configurado a ligação com o banco de dados
      set_include_path('C:\xampp\htdocs\projeto-webapp-taverna\db');
      require_once 'config.php';
?>

<!-- Início do HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets de Denúncia</title>
    <link rel="shortcut icon" href="../../../assets/images/faviconnn.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/standard.css" rel="stylesheet">
    <link href="../../../css/lista_denuncia.css" rel="stylesheet">
</head>
<body>
  <header class="sticky-top" id="h">
    <a class='navbar-brand' href='../Usuario_dashboard.php'><div id='logo'>A Taverna</div></a>
    <nav>
      <div class='container-fluid'>
      <div>
      <img src="../../../assets/images/icons8-lupa-50.png" style="width: 2em; height: 2em; margin-top: 0.8em; position: relative; left: 11.5em;">
      <form class='form-inline' action='../../pesquisar.php' method='post' style='margin-top:0.6em;'>
      <div style='display:flex;'>
      <input class='form-control mr-sm-2' type='search' placeholder='Pesquisar' name='pesquisa' style='border-radius: 0.25em; margin-right:0.5em; font-family: Montagna LTD;'>
      </div>
      </form>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/icons8-mesa-100.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu">
      <a class="dropdown-item" href="../../mesa/Lista_de_mesas.php">Lista de mesas</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/noticias.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="../../noticias/Escrever_noticia.php">Escrever notícia</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/icons8-identificação-não-verificada-100.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="Lista_denuncia.php">Tickets de denúncia</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn dropdown-toggle" data-bs-toggle="dropdown"><img src="../../../assets/images/pessoa.png" style="width: 2.8em;"></button>
      <div class="dropdown-menu dropdown-menu-lg-end">
      <a class="dropdown-item" href="../perfil/Lista_perfis.php">Lista de perfis</a>
      <hr class="dropdown-divider">
      <a class="dropdown-item" href="../login/logout.php">Sair</a>
      </div>
      </div>
      </div>
      </div>
      </nav>
      </header>
    <!-- Conteúdo da página -->
    <main>
    <div class="text-center" style="width: 800px; position: relative; top: 7em; margin: auto;">
      <h1 class="p-2">Tickets de Denúncia</h1>

        <?php
          error_reporting(E_ALL ^ E_WARNING);
          ini_set("display_errors", 1 );
          $id = $_SESSION["id"];

          if(isset($_GET["id"])){ 
            $sql = "SELECT * FROM denuncia WHERE id > {$_GET["id"]}  ORDER BY id LIMIT 5 ";
          } else{
            $sql = "SELECT * FROM denuncia ORDER BY id LIMIT 5";
          }
          if(isset($_GET["idVoltar"])){ 
            if($_GET["idVoltar"] == ""){
                $sql = "SELECT * FROM denuncia ORDER BY id LIMIT 5";
            }else{
                $idfirst = $_GET["idVoltar"] - 4;
                $idLimit = $idfirst - 6;
                $sql = "SELECT * FROM denuncia WHERE id < {$idfirst} AND id > {$idLimit}  ORDER BY id  LIMIT 5 ";
            }
          } 

          $stmt = $mysqli->query($sql);

          $qtd = $stmt->num_rows;

          //Renderiza os dados na forma de tabela
          if($qtd > 0){
            echo "<table class='table table-hover table-striped table-bordered' style='width: 800px;'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Título</th>";
            echo "<th>Denunciante</th>";
            echo "<th>Denunciado</th>";
            echo "<th colspan='2'>Ações</th>";
            echo "</tr>";
          while($row = $stmt->fetch_object()){
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->titulo . "</td>";
            echo "<td>" . $row->apelido_denunciante . "</td>";
            echo "<td>" . $row->apelido_denunciado . "</td>";
            $id = $row->id;
            echo "<td>
                    <button class='btn' style='background-color: #134F59; color: white;' onclick=\"location.href='Ticket_dashboard.php?id=".$row->id."';\">+</button>
                  </td>";        
            echo "</tr>";
          }
        echo "</table>";
        echo '<div style="display: flex; justify-content: space-between;">';
        echo "<button id='botaoControle' onclick=\"location.href='lista_denuncia.php?idVoltar=$id';\">Voltar</button>";
        echo "<button id='botaoControle' onclick=\"location.href='lista_denuncia.php?id=$id';\">Próxima Página</button>";
        echo '</div>';
        echo '</div>';
        } else {
          echo "<h3 class='text-danger'>Não encontrou resultados!</h3>";
        echo '<div style="display: flex; justify-content: space-between;">';
        echo "<button id='botaoControle' onclick=\"location.href='lista_denuncia.php?idVoltar=$id';\">Voltar</button>";
        echo '</div>';
        echo '</div>';
        }
        ?>
        
    </div>
    </main>
    <footer>
      <div class="container-fluid">
        <p>&copy; A Guilda. Siga em frente!</p>
        <p>Siga-nos:<a href="https://www.instagram.com/aguilda_smd/" target="_blank"><img src="../../../assets/images/insta-icon (3).png"></a></p>
      </div>
    </footer>
    <!-- Chamando os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>