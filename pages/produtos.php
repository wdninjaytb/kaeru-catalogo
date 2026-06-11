<?php

include "conexao.php";

$filtro = $_GET["filtro"] ?? "todos";

function buscarProdutos($conn)
{
    $produtos = [];

    $sql = "SELECT * FROM produto";
    $resultado = $conn->query($sql);

    if (!$resultado) {
        return [];
    }

    while ($linha = $resultado->fetch_assoc()) {
        $produtos[] = $linha;
    }

    return $produtos;
}

function filtrarProdutos($produtos, $filtro)
{
    if (empty($produtos)) {
        return [];
    }

    if ($filtro == "todos") {
        return $produtos;
    }

    $resultado = [];

    foreach ($produtos as $produto) {

        if (!isset($produto['filtro'])) {
            continue;
        }

        if ($produto['filtro'] == $filtro) {
            $resultado[] = $produto;
        }
    }

    return $resultado;
}

$produtos = buscarProdutos($conn);

$produtosFiltrados = filtrarProdutos(
    $produtos,
    $filtro
);
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

<?php
       $secao = [
        'produtos' => [
              [
                'id' => '1',
                'nome' => 'Onigiri de Salmão',
                'descricao' => 'Refeição de formato triangular de arroz japonês envolto por nori e com recheio de salmão desfiado',
                'preco' => '14.90',
                'popular'=> 'true',
                'filtro'=> 'alimentos'
              ],
              [
                'id'=> '2',
                'nome'=> 'Onigiri de Atum',
                'descricao'=> 'Refeição de formato triangular de arroz japonês envolto por nori e com recheio de atum desfiado',
                'preco'=> '14.90',
                'popular'=> 'true',
                'filtro'=> 'alimentos'
              ],
              [
                'id'=> '3',
                'nome'=> 'Bandeja de Sushi',
                'descricao'=> 'Uma bandeja de 6 sushis compostos de arroz japonês, nori, omelete, pepino, cenoura, shoga',
                'preco'=> '19.90',
                'popular'=> 'true',
                'filtro'=> 'alimentos'
              ],
              [
                'id'=> '4',
                'nome'=> 'Bandeja de Inarisushi',
                'descricao'=> 'Uma bandeja de 6 inarisushis compostos de arroz japonês, tofu frito, gergelim e shoga',
                'preco'=> '19.90',
                'popular'=> 'true',
                'filtro'=> 'alimentos'
              ],
              [
                'id'=> '5',
                'nome'=> 'Bentou',
                'descricao' => 'Bandeja para almoço completo com as seguintes comidas: Onigiri, Omelete, Inarisushi, Sushi, Espetinho de Frango Frito, Peixe frito',
                'preco'=> '29.90',
                'popular'=> 'true',
                'filtro'=> 'alimentos'
              ],
              [
                'id'=> '6',
                'nome'=> 'Gohan',
                'descricao'=> 'Saco de 5kg de arros japonês para fazer em casa',
                'preco'=> '44.90',
                'popular'=> 'true',
                'filtro'=> 'ingredientes'
                
              ],

              [
                'id'=> '7',
                'nome'=> 'Hashi',
                'descricao'=> 'Kit de Hashis para usar em casa',
                'preco'=> '19.90',
                'popular'=> 'true',
                'filtro'=> 'utilitarios'
                
              ],

            

                            [
                'id'=> '8',
                'nome'=> 'Tofu',
                'descricao'=> 'Massa de Soja para comer com Shoyu',
                'preco'=> '19.90',
                'popular'=> 'false',
                'filtro'=> 'alimentospreprontos'
                
              ],

                            [
                'id'=> '9',
                'nome'=> 'Shoyu',
                'descricao'=> 'Garrafa de 500ml de Shoyu',
                'preco'=> '24.90',
                'popular'=> 'true',
                'filtro'=> 'ingredientes'
                
              ],

                            [
                'id'=> '10',
                'nome'=> 'Mirin',
                'descricao'=> 'Garrafa de 500ml de Mirin para cozinha',
                'preco'=> '24.90',
                'popular'=> 'false',
                'filtro'=> 'ingredientes'
                
              ],

                            [
                'id'=> '11',
                'nome'=> 'Farinha Panko',
                'descricao'=> 'Saco de 1kg de Farinha Panko para fritura',
                'preco'=> '29.90',
                'popular'=> 'false',
                'filtro'=> 'ingredientes'
                
              ],

              [
                'id'=> '12',
                'nome'=> 'Manju',
                'descricao'=> 'Bolinho com recheio de Azuki',
                'preco'=> '24.90',
                'popular'=> 'false',
                'filtro'=> 'doces'
                
              ],

                            [
                'id'=> '13',
                'nome'=> 'Takoyaki',
                'descricao'=> 'Bolinhos com recheio de polvo congelado para fazer em casa',
                'preco'=> '39.90',
                'popular'=> 'true',
                'filtro'=> 'alimentospreprontos'
                
              ],

              [
                'id'=> '14',
                'nome'=> 'Gyoza',
                'descricao'=> 'Saco com 6 unidades de Gyozas para fazer em casa',
                'preco'=> '39.90',
                'popular'=> 'true',
                'filtro'=> 'alimentospreprontos'
                
              ],

              [
                'id'=> '15',
                'nome'=> 'Sorvete Samanco',
                'descricao'=> 'Sorvetes em formato de peixe com sabores de: Chocolate, Chá verde, Frutas Vermelhas, Morango, Azuki e Pipoca',
                'preco'=> '17.90',
                'popular'=> 'true',
                'filtro'=> 'doces'
                
              ],

              [
                'id'=> '16',
                'nome'=> 'Choco Pie',
                'descricao'=> 'Bolinhos de Chocolate com recheio de creme',
                'preco'=> '24.90',
                'popular'=> 'true',
                'filtro'=> 'doces'
                
              ],
        ]
       ];

  ?>

  <div class="menu-secao mb-5 container">
                 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    <?php foreach ($produtosFiltrados as $produto): ?>
                       <?php
                        ?>
                        <div class="col">
                            <div class="card card-menu h-100 shadow-sm border-0 position-relative">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    
                                    
                                    <div class="mb-4">
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