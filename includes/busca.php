<?php
include_once '../includes/header.php';
include_once __DIR__ . '/../db/connect.php';

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
?>
<div class="container py-5">
  <h2>Resultados para: <strong><?= htmlspecialchars($query) ?></strong></h2>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    <?php
    if ($query) {
      // Usando MySQLi e busca inteligente (LIKE %palavra1%palavra2%...)
      $palavras = preg_split('/\s+/', $query);
      $where = [];
      $params = [];
      foreach ($palavras as $palavra) {
        $where[] = "(nome LIKE ? OR descricao LIKE ?)";
        $params[] = '%' . $palavra . '%';
        $params[] = '%' . $palavra . '%';
      }
      $sql = "SELECT * FROM produtos";
      if ($where) {
        $sql .= " WHERE " . implode(' AND ', $where);
      }
      $sql .= " LIMIT 30";
      $stmt = $conn->prepare($sql);

      // Vincula os parâmetros dinamicamente
      if ($stmt) {
        $types = str_repeat('ss', count($palavras)); // dois 's' para cada palavra
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $produtos = $result->fetch_all(MYSQLI_ASSOC);
      } else {
        $produtos = [];
      }

      if ($produtos) {
        foreach ($produtos as $produto) {
    ?>
          <div class="col d-flex">
            <div class="card produto-card-custom h-100 w-100 d-flex flex-column align-items-center border-0 shadow-none">
              <img src="<?= htmlspecialchars($produto['imagem_principal'] ?? '') ?>"
                class="card-img-top" alt="<?= htmlspecialchars($produto['nome'] ?? '') ?>">
              <div class="card-body d-flex flex-column flex-grow-1 align-items-start px-3 py-4 w-100">
                <h5 class="fw-bold mb-2" style="font-size:1.25rem; color:#000; text-align:left;">
                  <?= htmlspecialchars($produto['nome'] ?? '') ?>
                </h5>
                <p class="mb-1 card-text" style="text-align:left;">
                  <?= htmlspecialchars($produto['descricao'] ?? '') ?>
                </p>
                <p class="preco-antigo mb-1" style="text-align:left;">
                  R$ <?= isset($produto['preco_antigo']) ? number_format($produto['preco_antigo'], 2, ',', '.') : '0,00'; ?>
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
                    echo '<span class="preco-parcelado"> ou ' . $produto['parcela'] . 'x R$ ' . number_format($valor_parcela, 2, ',', '.') . '</span>';
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
    <?php
        }
      } else {
        echo '<div class="col-12"><p>Nenhum produto encontrado.</p></div>';
      }
    } else {
      echo '<div class="col-12"><p>Digite algo para pesquisar.</p></div>';
    }
    ?>
  </div>
</div>
<style>
  /* Botão Comprar e Carrinho - Rosa com texto branco */
  .btn-qpink,
  .btn-outline-qpink {
    background: #ff1493;
    color: #fff;
    border: none;
    transition: all 0.2s;
  }

  .btn-qpink:hover,
  .btn-outline-qpink:hover {
    background: #e6007e;
    color: #fff;
  }

  /* Botão Carrinho - ao passar o mouse, fica branco com texto rosa */
  .btn-outline-qpink {
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #ff1493;
    background: #ff1493;
    color: #fff;
  }

  .btn-outline-qpink:hover,
  .btn-outline-qpink:focus {
    background: #fff !important;
    color: #ff1493 !important;
    border: 2px solid #ff1493;
  }

  .btn-outline-qpink:hover svg,
  .btn-outline-qpink:focus svg {
    color: #ff1493 !important;
    fill: #ff1493 !important;
  }

  .btn-outline-qpink svg {
    color: #fff;
    fill: #fff;
    transition: color 0.2s, fill 0.2s;
  }

  @media (max-width: 575.98px) {
    .card .card-text {
      font-size: 0.95rem;
      max-height: 4.5em;
      overflow: auto;
    }
  }

  .card .card-text {
    min-height: 60px;
    max-height: 120px;
    overflow: auto;
    font-size: 1rem;
  }
</style>
<?php include_once '../includes/footer.php'; ?>