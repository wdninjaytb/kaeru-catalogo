<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/IconKaeru.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kaeru Produtos Orientais</title>

  <base href="/">
</head>

<body>

<?php 
    include "conexao.php";
    include "include/header.php"; 
?>

<main class="conteudo">

<?php

$pagina = $_GET["pagina"] ?? "home";

$arquivo = "pages/{$pagina}.php";

if (file_exists($arquivo)) {
    include $arquivo;
} else {
    include "pages/erro.php";
}

?>

</main>

<?php include "include/footer.php"; ?>

</body>
</html>