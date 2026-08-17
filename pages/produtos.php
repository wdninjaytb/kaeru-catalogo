<?php

include "conexao.php";

$categoria = $_GET["categoria"] ?? null;

$caminhoImagens = "http://localhost:8080/PROJETO3BIM/arquivos/";

function buscarProdutos($conn, $categoria = null)
{
    $produtos = [];

    if ($categoria !== null) {

        $sql = "select * from produto where categoria_id = ?";

        $stmt = $conn->prepare($sql);

        $categoria = (int) $categoria;

        $stmt->bind_param("i", $categoria);
        $stmt->execute();

        $resultado = $stmt->get_result();

    } else {

        $sql = "select * from produto";

        $resultado = $conn->query($sql);
    }

    if (!$resultado) {
        return [];
    }

    while ($linha = $resultado->fetch_assoc()) {
        $produtos[] = $linha;
    }

    return $produtos;
}

function buscarCategoria($conn, $categoria) {
  $sql = "select id, nome, descricao from categoria where id = ? limit 1";

  $stmt = $conn->prepare($sql);

  $categoria = (int) $categoria;

  $stmt->bind_param("i", $categoria);
  $stmt->execute();

  $resultado = $stmt->get_result();

  return $resultado->fetch_assoc();
}

$produtosFiltrados = buscarProdutos($conn, $categoria);

$dadosCategoria = null;

if($categoria !== null) {
  $dadosCategoria = buscarCategoria($conn, $categoria);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/IconKaeru.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kaeru Produtos Orientais - Todos os Produtos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">  
</head>
<body>
                <div class="menu-secao mb-5 container">
                  <?php if ($dadosCategoria): ?>
                    <div class="mb-4">
                      <h2><?= $dadosCategoria["nome"] ?></h2>
                      <p><?= $dadosCategoria["descricao"] ?></p>
                    </div>
                    <?php else: ?>
                      <div class="mb-4">
                      <h2>Todos os Produtos</h2>
                    </div>
                    <?php endif; ?>
                 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    <?php foreach ($produtosFiltrados as $produto): ?>
                       <?php
                        ?>
                        <div class="col">
                            <div class="card card-menu h-100 shadow-sm border-0 position-relative">
                                <?php if (!empty($produto['img'])): ?>
                                    <img src="<?= $caminhoImagens . $produto['img'] ?>" alt="<?= $produto['nome'] ?>" class="card-img-top produto-imagem">
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    
                                    
                                    <div class="mb-4">
                                      <?php if (!empty($produto['marca'])): ?>
                                          <small class="text-muted">
                                              <?= $produto['marca'] ?>
                                          </small>
                                      <?php endif; ?>
                                        <h4 class="produto-nome"><?php echo $produto['nome']; ?></h4>
                                        <p class="produto-descricao card-text"><?php echo $produto['descricao']; ?></p>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                        <span class="produto-preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                                       <a href="https://wa.me/5544999782038?text=Olá, gostaria de pedir um <?php echo urlencode($produto['nome']); ?>" target="_blank" class="seta-link text-decoration-none">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div> </div>
    </div>

</body>
</html>