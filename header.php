<!Doctype html>
<html>
<head>
  <title>Visomes - Gestão de Arquivos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link rel="icon" href="images/favicon-192x192.jpg" sizes="192x192" />
  <link rel="apple-touch-icon-precomposed" href="images/favicon-180x180.jpg" />
  <meta name="msapplication-TileImage" content="images/favicon-270x270.jpg" />

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top" <?php if(!isset($_SESSION['username'])) echo 'hidden'?>>

    <a class="navbar-brand" href="localhost\visomes"><?php if(isset($_SESSION['name']) && isset($_SESSION['name2'])) echo $_SESSION['name'].' '.$_SESSION['name2'];?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="localhost\visomes">Início <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cogs" style="font-size:24px"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="listuser.php" <?php if(!$_SESSION['admin_users']) echo 'hidden'?>>Configurações</a>
            <a class="dropdown-item" href="signout.php">Sair</a>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0 navbar-right navbar-text" <?php if(!$_SESSION['show_search_text']) echo 'hidden'?>>
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" id="textSearch">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" hidden="">Buscar</button>
      </form>
    </div>
  </nav>