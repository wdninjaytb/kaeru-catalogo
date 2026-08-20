<?php

include "conexao.php";

$categoria = $_GET["categoria"] ?? null;

$caminhoImagens = "http://localhost:8080/PROJETO3BIM/arquivos/";

function buscarProdutos($conn, $categoria = null)
{
    $produtos = [];

    if ($categoria !== null) {

        $sql = "select p.*, e.quantidade from produto p inner join estoque e on e.produto_id = p.id where categoria_id = ? and e.quantidade > 0";

        $stmt = $conn->prepare($sql);

        $categoria = (int) $categoria;

        $stmt->bind_param("i", $categoria);
        $stmt->execute();

        $resultado = $stmt->get_result();

    } else {

        $sql = "select p.*, e.quantidade from produto p inner join estoque e on e.produto_id = p.id where e.quantidade > 0";

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
                        <?php if (empty($produtosFiltrados)): ?>
                            <div class="col-12">
                                <p class="text-muted">
                                  <?php if ($dadosCategoria): ?>
                                    Nenhum produto disponível nessa categoria no momento.
                                  <?php else: ?>
                                    Nenhum produto disponível no momento.
                                  <?php endif; ?>  
                                </p>
                            </div>

                        <?php else: ?>
                    
                    <?php foreach ($produtosFiltrados as $produto): ?>
                       <?php
                        ?>
                        <div class="col">
                            <div class="card card-menu h-100 shadow-sm border-0 position-relative produto-imagem-container">
                                <?php if (!empty($produto['img'])): ?>
                                    <img src="<?= $caminhoImagens . $produto['img'] ?>" alt="<?= $produto['nome'] ?>" class="card-img-top produto-imagem produto-imagem-real" onerror="this.onerror=null; this.src='/PROJETOTADS2BIM/img/sem-imagem.png';">
                                <?php else: ?>
                                    <img src="./img/sem-imagem.png" alt="Produto sem imagem" class="card-img-top produto-placeholder">
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
                                        <p class="produto-estoque text-muted mb-0"><?php if ($produto['quantidade'] == 1): ?>Última unidade disponível<?php elseif ($produto['quantidade'] <= 5): ?>Últimas unidades: <?= $produto['quantidade'] ?><?php else: ?>Em estoque: <?= $produto['quantidade'] ?> unidades <?php endif; ?></p>
                                    </div>
                                    
                                    <?php
                                        $mensagemWhatsApp = "Olá! Gostaria de pedir o produto "
                                            . $produto['nome']
                                            . ", no valor de R$ "
                                            . number_format($produto['preco'], 2, ',', '.')
                                            . ".";
                                    ?>

                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                        <span class="produto-preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                                       <a href="https://wa.me/5544999782038?text=<?php echo urlencode($mensagemWhatsApp) ?>" target="_blank" class="seta-link text-decoration-none">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>
                </div> </div>
    </div>

</body>
</html>