<?php

define('ROOT_PATH', __DIR__);

include './includes/header.php';
include './db/connect.php';
include './classes/produto.php';

//listar produtos em destaque
$linha_completa_produtos = [];
$sql = "SELECT * FROM produtos WHERE destaque_id = 1 ORDER BY id DESC LIMIT 4";
$resultado = $conn->query($sql);
if ($resultado && $resultado->num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    $linha_completa_produtos[] = $row;
  }
};

$destaque_mes = [];
$sql = "SELECT * FROM produtos WHERE destaque_id = 2 ORDER BY id DESC LIMIT 1";
$resultado = $conn->query($sql);
if ($resultado && $resultado->num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    $destaque_mes[] = $row;
  }
};

// Buscar todos os produtos
$produtos = [];
$sql = "SELECT * FROM produtos ORDER BY id ASC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
  }
}

// Defina os IDs dos produtos para cada slide (4 por slide)
$slides_ids = [
  [1, 2, 3, 4], // Slide 1: IDs dos produtos
  [36, 6, 7, 8], // Slide 2: IDs dos produtos
  // Adicione mais arrays para mais slides
];

$slides_produtos = [];
foreach ($slides_ids as $ids) {
  // Monta a string de IDs para o SQL
  $placeholders = implode(',', array_fill(0, count($ids), '?'));
  $sql = "SELECT * FROM produtos WHERE id IN ($placeholders) ORDER BY FIELD(id, $placeholders)";
  $stmt = $conn->prepare($sql);
  // Duplicar os IDs para o ORDER BY FIELD
  $params = array_merge($ids, $ids);
  $types = str_repeat('i', count($params));
  $stmt->bind_param($types, ...$params);
  $stmt->execute();
  $result = $stmt->get_result();
  $produtos = [];
  while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
  }
  $slides_produtos[] = $produtos;
}

$allproducts = [
  $sql = "SELECT * FROM produtos "
];

?>

<head>
  <meta charset="UTF-8">
  <title>Queridinhos da Wepink</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* --- Botões do carrossel --- */
    .carousel-control-prev,
    .carousel-control-next,
    #carrosselProdutos .carousel-control-prev,
    #carrosselProdutos .carousel-control-next {
      background-color: #ff008c;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0.95;
      border: none;
      margin-top: 0 !important;
      position: absolute;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-size: 70% 70%;
    }

    #carrosselProdutos .carousel-control-prev {
      left: -32px;
    }

    #carrosselProdutos .carousel-control-next {
      right: -32px;
    }

    @media (max-width: 575.98px) {

      #carrosselProdutos .carousel-control-prev,
      #carrosselProdutos .carousel-control-next {
        width: 38px;
        height: 38px;
        left: 0;
        right: 0;
      }

      #carrosselProdutos .carousel-control-prev {
        left: 2px;
      }

      #carrosselProdutos .carousel-control-next {
        right: 2px;
      }
    }

    #bannerCarousel .carousel-control-prev {
      left: 24px;
    }

    #bannerCarousel .carousel-control-next {
      right: 24px;
    }

    /* --- Cards de produto --- */
    .produto-card {
      border: 1px solid #eee;
      text-align: center;
      border-radius: 22px;
      background: #fff;
      height: 100%;
      display: flex;
      flex-direction: column;
      box-shadow: none;
      transition: none;
    }

    .produto-card:hover {
      box-shadow: none;
      transform: none;
    }

    .produto-card img {
      max-height: 200px;
      object-fit: contain;
      padding: 1rem;
      border-radius: 16px 16px 0 0;
      background: #fff0fa;
    }

    .card-title {
      color: #ff008c;
      font-size: 1.15rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    .preco-antigo {
      text-decoration: line-through;
      color: #888;
      font-size: 0.9rem;
    }

    .preco-atual {
      font-weight: bold;
      font-size: 1.2rem;
      color: #ff008c;
    }

    .preco-parcelado {
      font-size: 0.9rem;
      color: #555;
    }

    /* --- Botões de ação --- */
    .btn-pink,
    .btn-pink:disabled,
    .btn-pink[disabled] {
      background-color: #ff008c !important;
      color: white !important;
      font-weight: bold;
      border-radius: 12px;
      padding: 10px 24px;
      box-shadow: 0 2px 8px 0 rgba(255, 0, 140, 0.10);
      border: none;
      transition: background 0.2s, box-shadow 0.2s;
      opacity: 1 !important;
      cursor: pointer;
    }

    .btn-pink:hover {
      background-color: #e6007e !important;
      box-shadow: 0 4px 16px 0 rgba(255, 0, 140, 0.18);
    }

    .btn-outline-pink {
      border: 2px solid #ff008c;
      color: #ff008c;
      background: #fff;
      border-radius: 8px;
      padding: 0;
      transition: background 0.2s, color 0.2s;
    }

    .btn-outline-pink:hover {
      background: #ff008c;
      color: #fff;
    }

    .icon-carrinho,
    .btn-cart,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0 {
      border: 2px solid #ff0080;
      color: #ff0080;
      border-radius: 10px;
      background: #fff0fa;
      width: 50px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s, color 0.2s;
      font-weight: bold;
      padding: 0;
    }

    .icon-carrinho:hover,
    .btn-cart:hover,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0:hover {
      background: #ff0080;
      color: #fff;
    }

    .btn-cart,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0 {
      border: 2px solid #ff0080;
      color: #ff0080;
      border-radius: 10px;
      background: #fff0fa;
      width: 50px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s, color 0.2s;
      font-weight: bold;
      padding: 0;
    }

    .btn-cart span,
    .btn-cart svg,
    .btn-cart i,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0 span,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0 svg,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0 i {
      color: #ff0080;
      fill: #ff0080;
      transition: color 0.2s, fill 0.2s;
    }

    /* Hover: fundo rosa, "+" e carrinho brancos */
    .btn-cart:hover,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0:hover {
      background: #ff0080;
      color: #fff;
    }

    .btn-cart:hover span,
    .btn-cart:hover svg,
    .btn-cart:hover i,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0:hover span,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0:hover svg,
    .btn.d-flex.align-items-center.justify-content-center.flex-shrink-0:hover i {
      color: #fff !important;
      fill: #fff !important;
    }

    /* --- Responsividade --- */
    @media (max-width: 991.98px) {
      .carousel-item .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
      }

      .carousel-inner {
        padding-left: 0;
        padding-right: 0;
      }

      #carrosselProdutos .carousel-control-prev,
      #carrosselProdutos .carousel-control-next {
        left: 0 !important;
        right: 0 !important;
      }

      .produto-card img {
        max-height: 160px;
      }
    }

    @media (max-width: 575.98px) {
      .produto-card img {
        max-height: 120px;
        padding: 0.5rem;
      }

      .carousel-inner {
        padding-left: 0;
        padding-right: 0;
      }
    }

    /* Botão Comprar */
    .btn-comprar {
      background-color: #ff0080 !important;
      color: #fff !important;
      font-weight: bold;
      border-radius: 10px !important;
      border: none !important;
      padding: 10px 0;
      box-shadow: none;
      transition: background 0.2s, color 0.2s;
    }

    .btn-comprar:disabled {
      background-color: #ff0080 !important;
      color: #fff !important;
      opacity: 1 !important;
      cursor: not-allowed;
    }

    /* Botão Carrinho com "+" e ícone */
    .btn-carrinho {
      border: 2px solid #ff0080 !important;
      color: #ff0080 !important;
      border-radius: 10px !important;
      background: #fff0fa !important;
      width: 48px !important;
      height: 45px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      transition: background 0.2s, color 0.2s;
      font-weight: bold;
      padding: 0 !important;
      box-shadow: none !important;
    }

    .btn-carrinho span,
    .btn-carrinho svg {
      color: #ff0080 !important;
      fill: #ff0080 !important;
      transition: color 0.2s, fill 0.2s;
    }

    .btn-carrinho:hover {
      background: #ff0080 !important;
      color: #fff !important;
    }

    .btn-carrinho:hover span,
    .btn-carrinho:hover svg {
      color: #fff !important;
      fill: #fff !important;
    }

    /* --- Estilos personalizados para a seção "Queridinhos da Wepink" --- */
    .queridinhos-title {
      color: #ff008c;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 2.5rem;
      letter-spacing: -1px;
    }

    .produto-card-custom {
      border: none;
      border-radius: 20px;
      background: #fff;
      box-shadow: none;
      padding-bottom: 0;
      min-height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: stretch;
      text-align: left;
    }

    .produto-card-custom .card-img-top {
      background: none;
      border-radius: 20px 20px 0 0;
      padding: 0;
      margin: 0 auto 0.5rem auto;
      max-height: 220px;
      min-height: 180px;
      width: auto;
      object-fit: contain;
      display: block;
    }

    .produto-card-custom .card-body {
      padding: 0 0 0.5rem 0;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      background: none;
    }

    .produto-card-custom h5 {
      font-size: 1.25rem;
      font-weight: 700;
      color: #000;
      margin-bottom: 0.5rem;
      text-align: left;
    }

    .produto-card-custom p {
      font-size: 1rem;
      color: #222;
      margin-bottom: 0.25rem;
      text-align: left;
    }

    .preco-antigo {
      text-decoration: line-through;
      color: #888;
      font-size: 1rem;
      margin-bottom: 0.1rem;
    }

    .preco-atual {
      font-weight: bold;
      font-size: 1.25rem;
      color: #000;
    }

    .preco-parcelado {
      font-size: 1rem;
      color: #555;
      font-weight: 400;
      margin-left: 0.25rem;
    }

    /* Botão Comprar igual VTEX */
    .btn-qpink {
      background: #ff008c !important;
      color: #fff !important;
      font-weight: 700;
      border-radius: 10px !important;
      border: none !important;
      padding: 10px 0;
      font-size: 1.1rem;
      box-shadow: none;
      transition: background 0.2s, color 0.2s;
    }

    .btn-qpink:hover {
      background: #e6007e !important;
      color: #fff !important;
    }

    /* Botão Carrinho igual VTEX */
    .btn-outline-qpink {
      border: 2px solid #ff008c !important;
      color: #ff008c !important;
      border-radius: 10px !important;
      background: #fff !important;
      width: 48px !important;
      height: 45px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-weight: bold;
      padding: 0 !important;
      box-shadow: none !important;
      font-size: 1.2rem;
      transition: background 0.2s, color 0.2s;
    }

    .btn-outline-qpink span,
    .btn-outline-qpink svg {
      color: #ff008c !important;
      fill: #ff008c !important;
      transition: color 0.2s, fill 0.2s;
    }

    .btn-outline-qpink:hover {
      background: #ff008c !important;
      color: #fff !important;
    }

    .btn-outline-qpink:hover span,
    .btn-outline-qpink:hover svg {
      color: #fff !important;
      fill: #fff !important;
    }

    /* Setas do carrossel nas laterais, centralizadas verticalmente, fora do grid */
    .queridinhos-arrow {
      background: #ff008c !important;
      border-radius: 50% !important;
      width: 56px !important;
      height: 56px !important;
      top: 50%;
      transform: translateY(-50%);
      z-index: 3;
      opacity: 1;
      display: flex !important;
      align-items: center;
      justify-content: center;
      border: none;
      position: absolute;
    }

    .carousel-control-prev.queridinhos-arrow {
      left: -32px;
    }

    .carousel-control-next.queridinhos-arrow {
      right: -32px;
    }

    @media (max-width: 991.98px) {
      .carousel-control-prev.queridinhos-arrow {
        left: 0;
      }

      .carousel-control-next.queridinhos-arrow {
        right: 0;
      }
    }

    @media (max-width: 575.98px) {
      .produto-card-custom .card-img-top {
        max-height: 120px;
        min-height: 80px;
      }

      .queridinhos-title {
        font-size: 1.5rem;
      }

      .carousel-control-prev.queridinhos-arrow,
      .carousel-control-next.queridinhos-arrow {
        width: 38px !important;
        height: 38px !important;
      }
    }

    /* Aumenta tamanho dos cards e imagens dos "queridinhos da wepink" */
    .produto-card-custom {
      min-height: 540px;
      /* aumenta altura do card */
      border-radius: 32px;
      font-size: 1.22rem;
      padding-bottom: 0;
    }

    .produto-card-custom .card-img-top {
      max-height: 340px;
      /* aumenta altura máxima da imagem */
      min-height: 240px;
      width: 100%;
      padding-top: 2.5rem;
      padding-bottom: 2.5rem;
      object-fit: contain;
      transform: scale(1.12);
      /* dá um leve zoom na imagem */
      transition: transform 0.2s;
    }

    .produto-card-custom:hover .card-img-top {
      transform: scale(1.18);
      /* zoom maior ao passar o mouse */
    }

    .w-100.h-100.rounded-4.overflow-hidden {
      position: relative;
      width: 100%;
      height: 100%;
      min-height: 0;
      min-width: 0;
    }

    .w-100.h-100.rounded-4.overflow-hidden img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* cobre todo o espaço, sem distorcer */
      aspect-ratio: 1/1;
      /* mantém quadrado */
      display: block;
    }

    /* --- Estilos para o destaque do mês --- */
    .destaque-mes-preco {
      color: #fff;
      font-weight: bold;
      font-size: 1.35rem;
    }

    .destaque-mes-preco .preco-parcelado {
      color: #fff;
      font-weight: 400;
      font-size: 1rem;
      margin-left: 0.25rem;
    }

    .btn-eu-quero {
      background: transparent;
      color: #fff;
      border: 2px solid #fff;
      border-radius: 10px;
      font-size: 1.1rem;
      font-weight: bold;
      padding: 10px 32px;
      transition: background 0.2s, color 0.2s, border 0.2s;
    }

    .btn-eu-quero:hover,
    .btn-eu-quero:focus {
      background: #fff !important;
      color: #ff008c !important;
      border-color: #ff008c !important;
    }
  </style>
</head>
<!-- Banner principal com carrossel -->
<div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./assets/img/bannermaria1.jpg" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="assets/img/bannermaria2.jpg" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="assets/img/bannermaria3.jpg" class="d-block w-100" alt="Banner 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon " aria-hidden="true"> </span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon  " aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>



<div class="container my-5 position-relative">
  <h2 class="text-center mb-5 fw-bold queridinhos-title">queridinhos da wepink</h2>
  <div id="queridinhosCarousel" class="carousel slide" data-bs-ride="carousel">
    <!-- Botões do carrossel nas laterais -->
    <button class="carousel-control-prev queridinhos-arrow" type="button" data-bs-target="#queridinhosCarousel" data-bs-slide="prev" style="left:-56px;">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next queridinhos-arrow" type="button" data-bs-target="#queridinhosCarousel" data-bs-slide="next" style="right:-56px;">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Próximo</span>
    </button>
    <div class="carousel-inner">
      <?php foreach ($slides_produtos as $slideIndex => $produtos): ?>
        <div class="carousel-item <?php echo $slideIndex === 0 ? 'active' : ''; ?>">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 justify-content-center align-items-stretch">
            <?php foreach ($produtos as $produto): ?>
              <div class="col d-flex">
                <div class="card produto-card-custom h-100 w-100 d-flex flex-column align-items-center border-0 shadow-none">
                  <img src="<?php echo htmlspecialchars($produto['imagem_principal'] ?? ''); ?>"
                    class="card-img-top" alt="<?php echo htmlspecialchars($produto['nome'] ?? ''); ?>">
                  <div class="card-body d-flex flex-column flex-grow-1 align-items-start px-3 py-4 w-100">
                    <h5 class="fw-bold fs-4 mb-2" style="color:#000;"><?php echo htmlspecialchars($produto['nome'] ?? ''); ?></h5>
                    <p class="mb-2" style="color:#222; font-size:1.15rem;"><?php echo htmlspecialchars($produto['descricao'] ?? ''); ?></p>
                    <p class="preco-antigo mb-1" style="font-size:1.08rem;">
                      R$ <?php echo isset($produto['preco_antigo']) ? number_format($produto['preco_antigo'], 2, ',', '.') : '0,00'; ?>
                    </p>
                    <p class="preco-atual mb-2" style="font-size:1.55rem;">
                      R$
                      <?php
                      echo isset($produto['preco']) ? number_format($produto['preco'], 2, ',', '.') : '0,00';
                      if (
                        !empty($produto['parcela']) &&
                        !empty($produto['preco']) &&
                        isset($produto['parcela']) &&
                        isset($produto['preco']) &&
                        $produto['parcela'] > 0
                      ) {
                        $valor_parcela = $produto['preco'] / $produto['parcela'];
                        echo '<span class="preco-parcelado" style="font-size:1.08rem;"> ou ' . $produto['parcela'] . 'x R$ ' . number_format($valor_parcela, 2, ',', '.') . '</span>';
                      }
                      ?>
                    </p>
                    <div class="d-flex gap-2 mt-auto w-100">
                      <button class="btn btn-qpink flex-grow-1">Comprar</button>
                      <button class="btn btn-outline-qpink d-flex align-items-center justify-content-center">
                        <span class="fw-bold">+</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-fill ms-1" viewBox="0 0 16 16">
                          <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .485.379L2.89 5H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 14H4a.5.5 0 0 1-.491-.408L1.01 2H.5a.5.5 0 0 1-.5-.5zM5 16a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm7 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- CSS extra para o carrossel de produtos -->

</div>


<section class="container my-5">
  <?php foreach($destaque_mes as $destaque): ?>
  <div class="row justify-content-center align-items-stretch g-0">
    <!-- Imagem -->
    <div class="col-md-6 bg-white p-0 d-flex align-items-center justify-content-center"
      style="box-shadow: 0 6px 24px 0 rgba(0,0,0,0.07); border-radius: 12px 0 0 12px; min-height: 420px;">
      <img src="<?php echo htmlspecialchars($destaque['imagem_principal'] ?? ''); ?>" alt="Produto Destaque" class="img-fluid w-100 h-100"
        style="object-fit: contain; border-radius: 12px 0 0 12px; max-height: 420px;">
    </div>
    <!-- Conteúdo -->
    <div class="col-md-6 d-flex align-items-center justify-content-center p-0"
      style="background:#ff008c; border-radius: 0 12px 12px 0; min-height: 420px;">
      <div class="w-100 p-5" style="color: #fff; max-width: 500px;">
        <p class="fw-bold text-uppercase mb-2" style="letter-spacing: 1px;">#destaque do mês</p>
        <h2 class="fw-bold mb-3" style="font-size:2rem; line-height:1.2;">
        <?php echo htmlspecialchars($destaque['nome'] ?? ''); ?>
        </h2>
        <p class="mb-3" style="font-size:1.15rem;"><?php echo htmlspecialchars($destaque['descricao'] ?? ''); ?></p>
        <p class="preco-atual mb-2 destaque-mes-preco" style="text-align:left;">
          R$
          <?php
          echo isset($destaque['preco']) ? number_format($destaque['preco'], 2, ',', '.') : '0,00';
          if (
            isset($destaque['parcela']) &&
            isset($destaque['preco']) &&
            $destaque['parcela'] > 0 &&
            $destaque['preco'] > 0
          ) {
            $valor_parcela = $destaque['preco'] / $destaque['parcela'];
            echo '<span class="preco-parcelado">ou ' . $destaque['parcela'] . 'x R$ ' . number_format($valor_parcela, 2, ',', '.') . '</span>';
          }
          ?>
        </p>
        <a href="#" class="btn btn-eu-quero px-5 py-2 fw-bold"
          style="border-radius:10px; font-size:1.1rem; border-width:2px;">eu quero!</a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</section>

<!-- Linha RED - Linha completa pra você -->
<div class="container my-5">
  <h2 class="text-center fw-bold mb-5 queridinhos-title" style="color:#ff008c;">uma linha completa pra você</h2>
  
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
    <?php foreach ($linha_completa_produtos as $produto): ?>
      <div class="col d-flex">
        <div class="card produto-card-custom h-100 w-100 d-flex flex-column align-items-center border-0 shadow-none">
          <img src="<?php echo htmlspecialchars($produto['imagem_principal'] ?? ''); ?>"
            class="card-img-top" alt="<?php echo htmlspecialchars($produto['nome'] ?? ''); ?>">
          <div class="card-body d-flex flex-column flex-grow-1 align-items-start px-3 py-4 w-100">
            <h5 class="fw-bold mb-2" style="font-size:1.25rem; color:#000; text-align:left;">
              <?php echo htmlspecialchars($produto['nome'] ?? ''); ?>
            </h5>
            <p class="mb-1" style="text-align:left;">
              <?php echo htmlspecialchars($produto['descricao'] ?? ''); ?>
            </p>
            <p class="preco-antigo mb-1" style="text-align:left;">
              R$ <?php echo isset($produto['preco_antigo']) ? number_format($produto['preco_antigo'], 2, ',', '.') : '0,00'; ?>
            </p>
            <p class="preco-atual mb-2" style="text-align:left;">
              R$
              <?php
              echo isset($produto['preco']) ? number_format($produto['preco'], 2, ',', '.') : '0,00';
              if (
                isset($produto['parcela']) &&
                isset($produto['preco']) &&
                $produto['parcela'] > 0 &&
                $produto['preco'] > 0
              ) {
                $valor_parcela = $produto['preco'] / $produto['parcela'];
                echo '<span class="preco-parcelado">ou ' . $produto['parcela'] . 'x R$ ' . number_format($valor_parcela, 2, ',', '.') . '</span>';
              }
              ?>
            </p>
            <div class="d-flex gap-2 mt-auto w-100">
              <button class="btn btn-qpink flex-grow-1">Comprar</button>
              <button class="btn btn-outline-qpink d-flex align-items-center justify-content-center">
                <span class="fw-bold">+</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-fill ms-1" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .485.379L2.89 5H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 14H4a.5.5 0 0 1-.491-.408L1.01 2H.5a.5.5 0 0 1-.5-.5zM5 16a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm7 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      
    <?php endforeach; ?>
  </div>
</div>

<section class="newsletter-section d-flex align-items-center justify-content-center" style="background:#ff008c; min-height: 320px; width:100%;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h2 class="fw-bold mb-4" style="color:#fff; font-size:2.3rem; line-height:1.15; font-family:'Montserrat',sans-serif;">
          Ama promos e lançamentos? <span style="font-size:2.1rem;">❤️</span>Vem<br>
          receber tudo em 1ª mão! <span style="font-size:2.1rem;">👇🏻✨</span>
        </h2>
      </div>
      <div class="col-12 d-flex justify-content-center">
        <form action="#" method="post" class="d-flex flex-row align-items-center gap-3 w-100" style="max-width:700px;">
          <input type="email" name="email" placeholder="seu e-mail" required
            style="flex:1; padding: 22px 28px; border-radius: 32px; border: none; font-size: 1.18rem; font-family:'Montserrat',sans-serif;">
          <button type="submit"
            style="padding: 18px 38px; border-radius: 22px; border: none; background: #fff; color: #ff008c; font-weight: 700; font-size: 1.18rem; font-family:'Montserrat',sans-serif; transition:background 0.2s;">
            Enviar
          </button>
        </form>
      </div>
    </div>
  </div>
</section>


<!-- Seção Instagram -->
<section class="container my-5">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="d-flex flex-column align-items-center mb-4">
        <h2 class="fw-bold" style="color:#ff008c; font-size:2rem; margin-bottom: 0.5rem;">siga @wepink.br</h2>
      </div>
      <div class="row g-3 justify-content-center" style="background:#fff; border-radius:22px; padding:24px 8px 8px 8px; box-shadow:0 4px 24px 0 rgba(0,0,0,0.04);">
        <!-- Post 1 -->
        <div class="col-6 col-md-4 d-flex">
          <div class="w-100 h-100 rounded-4 overflow-hidden" style="background:#ffe3f3;">
            <img src="https://scontent-fra3-2.cdninstagram.com/v/t39.30808-6/504415366_731202512636903_7709977144191549741_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=1&ccb=1-7&_nc_sid=18de74&_nc_ohc=hcMxucD-vScQ7kNvwEcPCSQ&_nc_oc=AdlAGX8JwytT1oK3A_ALzCdDlJoL1frWTkbkdGJBvUY_7M1DMABixuv6UDjf0MT8yLzXxOQ7ZAEYJRpdaN-WO2cI&_nc_zt=23&_nc_ht=scontent-fra3-2.cdninstagram.com&edm=AM6HXa8EAAAA&_nc_gid=OaIqlCIeEP7uCbWI3CXDHA&oh=00_AfOoTp25l3ASuQJzSsgfKgVBUFjHjRfHQzF3NYLjpDfSAQ&oe=68483350">
          </div>
        </div>
        <!-- Post 2 -->
        <div class="col-6 col-md-4 d-flex">
          <div class="w-100 h-100 rounded-4 overflow-hidden" style="background:#ffe3f3;">
            <img src="https://scontent-fra3-2.cdninstagram.com/v/t39.30808-6/504741926_731028465987641_1706498143050092523_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=1&ccb=1-7&_nc_sid=18de74&_nc_ohc=XntcfKu4gZYQ7kNvwHdxVlX&_nc_oc=AdmPHi0X2TSVa9VWJMRqeMTYin34nJedu0uqbZH6dRuPg5K-M6Z4y4MNic9Za8T7LAgyZbpUXeGFzGFLtmzOvMJ2&_nc_zt=23&_nc_ht=scontent-fra3-2.cdninstagram.com&edm=AM6HXa8EAAAA&_nc_gid=OaIqlCIeEP7uCbWI3CXDHA&oh=00_AfPPPLj9CpSegb6PiKBEAqNsYIC--IhlLiZz9eLmZox_cA&oe=68484D77">
          </div>
        </div>
        <!-- Post 3 -->
        <div class="col-6 col-md-4 d-flex d-none d-md-flex">
          <div class="w-100 h-100 rounded-4 overflow-hidden" style="background:#ffe3f3;">
            <img src="https://scontent-fra5-1.cdninstagram.com/v/t39.30808-6/504338296_730358949387926_8925169569426501339_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=110&ccb=1-7&_nc_sid=18de74&_nc_ohc=8dLeGnqrYloQ7kNvwH46g-P&_nc_oc=AdkJEkn7F5OyLe2vO-hySKvK4RtyrRM2A4YBPRTiBRgN7n5hs6s3lWpVj6iJ3dldJKMMWVy_W4XvgAs4iywLhZ5i&_nc_zt=23&_nc_ht=scontent-fra5-1.cdninstagram.com&edm=AM6HXa8EAAAA&_nc_gid=OaIqlCIeEP7uCbWI3CXDHA&oh=00_AfPBFXrtxP8J-gTIdnFxsnUYc8Vms8DGdiJty7MMoBfkLA&oe=6848259D">
          </div>
        </div>
        <!-- Post 4 -->
        <div class="col-6 col-md-4 d-flex">
          <div class="w-100 h-100 rounded-4 overflow-hidden" style="background:#ffe3f3;">
            <img src="https://scontent-fra3-2.cdninstagram.com/v/t39.30808-6/503979965_730303932726761_4594870844782830940_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=1&ccb=1-7&_nc_sid=18de74&_nc_ohc=9KUCIO4I3Q4Q7kNvwGflQLQ&_nc_oc=AdkGL2CTxVQr4KZFPcI1GhDMhgU9GNLBbCJj4qLA9sMYNqtl6lZM5t9o4Z_MprKwvk-ca25r7yPXsMH4UJle4O09&_nc_zt=23&_nc_ht=scontent-fra3-2.cdninstagram.com&edm=AM6HXa8EAAAA&_nc_gid=OaIqlCIeEP7uCbWI3CXDHA&oh=00_AfP9ftdSEEWNWqBIAWpgbv015cXrokruuB96pv2enOAlcg&oe=68483307">
          </div>
        </div>
        <!-- Post 5 -->
        <div class="col-6 col-md-4 d-flex">
          <div class="w-100 h-100 rounded-4 overflow-hidden" style="background:#ffe3f3;">
            <img src="https://scontent-fra3-1.cdninstagram.com/v/t39.30808-6/502849161_727791106311377_7013726103031544994_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=108&ccb=1-7&_nc_sid=18de74&_nc_ohc=Q2XjLW5h1BIQ7kNvwE08YhX&_nc_oc=Adk-KK_mXr_jCxUwv2rXvfb9pJ4w125S9505TfSuRGxetLWtKHWzgM9IurxlM29R7rj6ZsMHSV1NEMq2OVKRAw2z&_nc_zt=23&_nc_ht=scontent-fra3-1.cdninstagram.com&edm=AM6HXa8EAAAA&_nc_gid=OaIqlCIeEP7uCbWI3CXDHA&oh=00_AfPYROwbpBAz8hXi64NaYci3mmY4iaz2jnn2XX-DPuuopA&oe=6848285A">
          </div>
        </div>
        <!-- Post 6 -->
        <div class="col-6 col-md-4 d-flex d-none d-md-flex">
          <div class="w-100 h-100 rounded-4 overflow-hidden" style="background:#ffe3f3;">
            <img src="https://scontent-fra3-2.cdninstagram.com/v/t39.30808-6/502559042_726954579728363_1125116987485390145_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=1&ccb=1-7&_nc_sid=18de74&_nc_ohc=eQcOym82yAcQ7kNvwEfl5IM&_nc_oc=Adl03Rm3l2nyBITETAXDg-uHYg1sBCUpcUrxgUjBvgnmSK_sTtarwHVENQMJNZ_lcUJj6tv-u6UVc9YVM3yp073R&_nc_zt=23&_nc_ht=scontent-fra3-2.cdninstagram.com&edm=AM6HXa8EAAAA&_nc_gid=OaIqlCIeEP7uCbWI3CXDHA&oh=00_AfNghcueVNrXlA9ra0q_XH4MSR_T5wcQ_jGYXi3yHK4SSA&oe=68484EB4">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  fetch("http://localhost:3000/api/instagram")
    .then(res => res.json())
    .then(images => {
      const gallery = document.getElementById('insta-gallery');
      images.forEach(url => {
        const col = document.createElement('div');
        col.className = 'col-md-2 col-6';
        col.innerHTML = `<img src="${url}" class="img-fluid" alt="Instagram post">`;
        gallery.appendChild(col);
      });
    })
    .catch(err => console.error('Erro ao carregar Instagram:', err));
</script>







<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function scrollQueridinhos(direction) {
    const carousel = document.getElementById('queridinhos-carousel');
    const scrollAmount = 300;
    carousel.scrollBy({
      left: direction * scrollAmount,
      behavior: 'smooth'
    });
  }

  function scrollCarousel(direction) {
    const carousel = document.getElementById('carouselProdutos');
    const scrollAmount = 270; // largura de um card + gap
    carousel.scrollBy({
      left: direction * scrollAmount,
      behavior: 'smooth'
    });
  }
</script>

<?php include 'includes/footer.php'; ?>