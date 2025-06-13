<?php
session_start();
include_once __DIR__ . '/../db/connect.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($page_title) ? $page_title . ' | ' . SITE_NAME : SITE_NAME; ?></title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- CSS Customizado -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/main.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/responsive.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/minicart.css">
  <!-- Favicon -->
  <link rel="icon" href="<?php echo SITE_URL; ?>/assets/images/favicon.ico">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .wepink-header {
      position: sticky;
      top: 0;
      z-index: 1040;
      width: 100%;
      transition: background 0.3s, backdrop-filter 0.3s;
      background: rgba(247, 247, 247, 0.85);
      /* Translucida */
      backdrop-filter: blur(2px);
      box-shadow: 0 1px 8px 0 rgba(0, 0, 0, 0.03);
    }

    .wepink-header:hover,
    .wepink-header:focus-within {
      background: #fff !important;
      /* Branca ao passar mouse */
      backdrop-filter: none !important;
      /* Remove blur */
      transition: background 0.3s, backdrop-filter 0.3s;
    }

    .wepink-header .topbar {
      background: #ff008c;
      color: #fff;
      font-size: 15px;
      text-align: center;
      padding: 15px 0 12px 0;
      font-weight: 400;
      letter-spacing: 0.1px;
      border-radius: 0;
      border: none;
    }

    .wepink-header .topbar a {
      color: #fff;
      text-decoration: underline;
      font-weight: 400;
      transition: color 0.2s;
    }

    .wepink-header .topbar a:hover {
      color: #ffd6ef;
    }

    .wepink-header .mainbar {
      background: transparent !important;
      box-shadow: none;
      border: none;
      padding: 0;
      width: 100%;
    }

    .wepink-header .mainbar-inner {
      display: flex;
      align-items: center;
      /* Centraliza verticalmente com a barra de pesquisa */
      justify-content: flex-start;
      gap: 0;
      padding: 1.1rem 0 0.2rem 0;
      width: 100%;
    }

    .wepink-header .logo-search-group {
      display: flex;
      align-items: flex-start;
      flex: 1 1 0;
      min-width: 0;
      gap: 2.2rem;
      margin-left: 2.2rem;
    }

    .wepink-header .navbar-brand {
      margin-left: 0.3rem;
      margin-right: 0.7rem;
      font-weight: 700;
      font-size: 2rem;
      color: #ff008c !important;
      letter-spacing: -0.5px;
      text-transform: lowercase;
      display: flex;
      align-items: center;
      margin-right: 0;
      padding-right: 0;
    }

    .wepink-header .navbar-brand img {
      max-height: 44px;
      margin-left: 0;
      margin-right: 0;
      width: auto;
      height: 44px;
      display: block;
    }

    .wepink-header .search-bar-wepink {
      flex: 1 1 0;
      max-width: 950px;
      min-width: 0;
      position: relative;
    }

    .wepink-header .search-bar-wepink input {
      border-radius: 14px;
      padding-left: 44px;
      font-size: 1rem;
      border: none;
      background: #fff;
      height: 44px;
      box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.03);
      width: 100%;
      min-width: 0;
    }

    .wepink-header .search-bar-wepink input:focus {
      outline: none;
      box-shadow: 0 2px 8px 0 rgba(255, 0, 140, 0.08);
      border: 1.5px solid #ff008c;
    }

    .wepink-header .search-bar-wepink .bi-search {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #ff008c;
      font-size: 20px;
      z-index: 2;
    }

    .wepink-header .mainbar-icons {
      display: flex;
      align-items: center;
      gap: 1.7rem;
      min-width: 0;
      margin-left: 0.7rem;
      /* Mais próximo da barra de pesquisa */
    }

    .wepink-header .mainbar-icons .icon-link {
      color: #222 !important;
      font-size: 1rem;
      font-weight: 400;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      position: relative;
      transition: color 0.2s;
      text-decoration: none;
      white-space: nowrap;
      line-height: 1.2;
    }

    .wepink-header .mainbar-icons .icon-link .bi {
      font-size: 1.35rem;
      color: #ff008c !important;
      transition: color 0.2s;
      line-height: 1;
      position: relative;
      top: 0;
      /* Remove ajuste vertical para alinhar perfeitamente */
      display: inline-block;
      vertical-align: middle;
    }

    .wepink-header .mainbar-icons .icon-link .badge {
      background: #ff008c;
      color: #fff;
      font-size: 0.85rem;
      font-weight: 600;
      position: absolute;
      top: -10px;
      right: -14px;
      padding: 2px 7px;
      border-radius: 12px;
    }

    .wepink-header .mainbar-icons .icon-link .bi-person-circle,
    .wepink-header .mainbar-icons .icon-link .bi-cart3 {
      color: #ff008c !important;
    }

    .wepink-header .mainbar-icons .icon-link:hover,
    .wepink-header .mainbar-icons .icon-link:focus {
      color: #ff008c !important;
      text-decoration: none;
    }

    .wepink-header .categories-bar-wepink {
      display: flex;
      justify-content: center;
      width: 100%;
      background: transparent;
      border: none;
      box-shadow: none;
      padding: 0;
    }

    .wepink-header .categories-list {
      display: flex;
      flex-wrap: nowrap;
      justify-content: center;
      align-items: center;
      gap: 2.2rem;
      padding: 0.5rem 0 0.3rem 0;
      margin: 0 auto;
      overflow-x: auto;
      scrollbar-width: none;
      width: auto;
      max-width: 100%;
    }

    .wepink-header .categories-list::-webkit-scrollbar {
      display: none;
    }

    .wepink-header .category-link {
      font-weight: 400;
      font-size: 1.08rem;
      letter-spacing: 0.1px;
      padding: 0 0;
      border-radius: 20px;
      color: #222;
      background: transparent;
      border: none;
      transition: background 0.2s, color 0.2s;
      margin: 0 0;
      white-space: nowrap;
      text-decoration: none;
      display: inline-block;
      line-height: 2.2rem;
    }

    .wepink-header .category-link:hover,
    .wepink-header .category-link:focus {
      background: transparent;
      /* Remove fundo rosa */
      color: #ff008c !important;
      /* Só o texto fica rosa */
      text-decoration: none;
      padding-left: 10px;
      padding-right: 10px;
    }

    /* Botão hamburguer */
    .navbar-toggler {
      background: none;
      border: none;
      padding: 0.5rem 0.7rem;
      margin-right: 1rem;
      display: none;
      align-items: center;
      cursor: pointer;
      z-index: 1200;
    }

    .navbar-toggler-icon {
      display: inline-block;
      width: 28px;
      height: 3px;
      background: #222;
      border-radius: 2px;
      position: relative;
    }

    .navbar-toggler-icon::before,
    .navbar-toggler-icon::after {
      content: '';
      display: block;
      width: 28px;
      height: 3px;
      background: #222;
      border-radius: 2px;
      position: absolute;
      left: 0;
      transition: 0.2s;
    }

    .navbar-toggler-icon::before {
      top: -9px;
    }

    .navbar-toggler-icon::after {
      top: 9px;
    }

    /* MOBILE: mostra hamburguer, esconde menu */
    @media (max-width: 991.98px) {
      .navbar-toggler {
        display: flex;
      }

      .wepink-header .logo-search-group,
      .wepink-header .mainbar-icons,
      .wepink-header .categories-bar-wepink {
        display: none !important;
      }

      .wepink-header .mainbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: row;
        position: relative;
        padding: 0.7rem 0;
        gap: 0.5rem;
        width: 100%;
        z-index: 10;
      }

      .wepink-header .mainbar-icons {
        order: 3;
        display: flex !important;
        align-items: center;
        gap: 0.7rem;
        position: static !important;
        margin: 0 !important;
        min-width: unset;
        background: transparent;
        z-index: 10;
        width: auto;
        padding: 0;
        top: auto !important;
        right: auto !important;
        transform: none !important;
      }
    }

    /* DESKTOP: mostra menu normal, esconde hamburguer */
    @media (min-width: 992px) {
      .navbar-toggler {
        display: none !important;
      }

      .wepink-header .logo-search-group,
      .wepink-header .mainbar-icons,
      .wepink-header .categories-bar-wepink {
        display: flex !important;
      }

      /* REMOVA QUALQUER REGRA DE body.nav-open .wepink-header .mainbar-inner AQUI! */
    }

    @media (max-width: 1400px) {
      .wepink-header .search-bar-wepink {
        max-width: 800px;
      }

      .wepink-header .logo-search-group {
        margin-left: 1.2rem;
        gap: 1.2rem;
      }

      .wepink-header .mainbar-icons {
        margin-left: 1.2rem;
      }
    }

    @media (max-width: 1200px) {
      .wepink-header .categories-list {
        gap: 1.2rem;
      }
    }

    @media (max-width: 991.98px) {
      .wepink-header .mainbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: row;
        position: relative;
        padding: 0.7rem 0;
        gap: 0.5rem;
        width: 100%;
        z-index: 10;
      }

      .wepink-header .mainbar-icons {
        order: 3;
        display: flex !important;
        align-items: center;
        gap: 0.7rem;
        position: static !important;
        margin: 0 !important;
        min-width: unset;
        background: transparent;
        z-index: 10;
        width: auto;
        padding: 0;
        top: auto !important;
        right: auto !important;
        transform: none !important;
      }
    }

    @media (max-width: 575.98px) {
      .wepink-header .navbar-brand img {
        max-height: 34px;
        height: 34px;
      }

      .wepink-header .category-link {
        font-size: 0.93rem;
      }

      .wepink-header .mainbar-inner {
        gap: 0.3rem;
      }
    }

    /* MOBILE MENU ONLY */
    .mobile-menu,
    .mobile-menu-overlay {
      display: none;
    }

    body.nav-open .mobile-menu-overlay {
      display: block;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.25);
      z-index: 1199;
    }

    body.nav-open .mobile-menu {
      display: block;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      width: 85vw;
      max-width: 420px;
      min-width: 260px;
      background: #ff008c;
      color: #fff;
      z-index: 1200;
      overflow-y: auto;
      box-shadow: 2px 0 16px rgba(0, 0, 0, 0.08);
      animation: slideInMenu .25s;
      transition: width 0.25s cubic-bezier(.4, 0, .2, 1);
    }

    @keyframes slideInMenu {
      from {
        transform: translateX(-100%);
      }

      to {
        transform: translateX(0);
      }
    }

    .mobile-menu-logo {
      display: block;
      margin: 48px auto 18px auto !important;
      max-height: 54px;
    }

    .mobile-menu-icons {
      flex-wrap: nowrap;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .mobile-menu-icons .icon-link {
      color: #fff !important;
      font-size: 1rem;
      margin: 0 0.5rem;
      text-decoration: none;
      min-width: 70px;
      flex: 1 1 0;
      max-width: 120px;
    }

    .mobile-menu-icons .icon-link .bi {
      color: #fff !important;
    }

    .mobile-menu-search .search-bar-wepink {
      position: relative;
    }

    .mobile-menu-search .search-bar-wepink .bi-search {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #ff008c;
      font-size: 20px;
      z-index: 2;
    }

    .mobile-menu-search .search-bar-wepink input {
      border-radius: 14px;
      padding-left: 44px;
      font-size: 1rem;
      border: none;
      background: #fff;
      height: 44px;
      box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.03);
      width: 100%;
      min-width: 0;
    }

    .mobile-menu-categories {
      background: #fff;
      min-height: 100vh;
    }

    .mobile-menu-categories ul {
      margin: 0;
      padding: 0;
    }

    .mobile-menu-categories li {
      border-bottom: 1px solid #f3e0ee;
      margin-bottom: 0;
    }

    .mobile-menu-categories a {
      display: flex;
      align-items: center;
      gap: 1rem;
      color: #ff008c;
      font-size: 1.25rem;
      padding: 1.1rem 1.2rem 1.1rem 1.2rem;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.2s, color 0.2s;
      background: #fff;
    }

    .mobile-menu-categories a:hover {
      background: #ffe3f5;
      color: #d1006f;
    }

    .mobile-menu-categories i.bi {
      font-size: 1.5rem;
      color: #ff008c;
    }

    .mobile-menu-categories i.bi-chevron-right {
      margin-left: auto;
      font-size: 1.3rem;
      color: #ff008c;
    }

    .btn-close-mobile {
      background: none;
      border: none;
      color: #fff;
      padding: 0;
      margin: 0;
    }

    @media (max-width: 575.98px) {
      .mobile-menu-icons .icon-link span {
        font-size: 0.85rem;
      }

      .mobile-menu-icons .icon-link {
        min-width: 60px;
        max-width: 90px;
        font-size: 0.95rem;
      }
    }

    @media (min-width: 992px) {

      .mobile-menu,
      .mobile-menu-overlay {
        display: none !important;
      }
    }

    .minicart-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.32);
      z-index: 2000;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s;
    }

    .minicart-overlay.open {
      opacity: 1;
      pointer-events: auto;
    }

    .minicart-drawer {
      position: fixed;
      top: 0;
      right: 0;
      width: 420px;
      max-width: 100vw;
      height: 100vh;
      background: #fff;
      box-shadow: -2px 0 16px rgba(0, 0, 0, 0.12);
      z-index: 2100;
      transform: translateX(100%);
      transition: transform 0.3s;
      display: flex;
      flex-direction: column;
      padding: 0;
    }

    .minicart-drawer.open {
      transform: translateX(0);
    }

    .minicart-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 28px 28px 12px 28px;
      border-bottom: 1px solid #f3e0ee;
    }

    .minicart-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #222;
      display: flex;
      align-items: center;
    }

    .minicart-close-btn {
      background: none;
      border: none;
      color: #222;
      font-size: 2rem;
      cursor: pointer;
      padding: 0;
      margin-left: 12px;
    }

    .minicart-content {
      flex: 1 1 auto;
      overflow-y: auto;
      padding: 18px 28px 0 28px;
    }

    .minicart-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 18px;
      border-bottom: 1px solid #f3e0ee;
      padding-bottom: 14px;
    }

    .minicart-item-img {
      width: 64px;
      height: 64px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #eee;
    }

    .minicart-item-info {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .minicart-item-name {
      font-weight: 600;
      color: #222;
      font-size: 1rem;
      margin-bottom: 2px;
    }

    .minicart-item-controls {
      display: flex;
      align-items: center;
      gap: 8px;
      margin: 4px 0;
    }

    .minicart-qty-btn {
      background: #ff008c;
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 26px;
      height: 26px;
      font-size: 1.2rem;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s;
    }

    .minicart-item-qty {
      font-size: 1rem;
      font-weight: 600;
      color: #222;
      min-width: 24px;
      text-align: center;
    }

    .minicart-item-price {
      font-size: 1rem;
      color: #ff008c;
      font-weight: 600;
      margin-top: 2px;
    }

    .minicart-empty {
      text-align: center;
      color: #aaa;
      margin-top: 40px;
    }

    .minicart-footer {
      border-top: 1px solid #f3e0ee;
      padding: 18px 28px 24px 28px;
      background: #fff;
      /* Alinha os itens na base do drawer */
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
    }

    .minicart-summary {
      margin-bottom: 18px;
    }

    .minicart-summary-row {
      display: flex;
      justify-content: space-between;
      font-size: 1rem;
      margin-bottom: 6px;
      font-weight: 600;
    }

    .minicart-summary-row span:last-child {
      font-weight: 700;
      font-size: 1.08rem;
    }

    .minicart-summary-row.total span:last-child {
      color: #ff008c;
      font-size: 1.18rem;
    }

    .minicart-summary-row.total span:first-child {
      font-weight: 700;
    }

    .minicart-summary-row span {
      color: #222;
    }

    .minicart-summary-row span[style*="color:#ff008c"] {
      color: #ff008c !important;
    }

    .minicart-footer-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 18px;
      margin-top: 8px;
    }

    .minicart-continue {
      color: #111;
      font-size: 1rem;
      text-decoration: underline;
      font-weight: 700;
      transition: color 0.2s;
      line-height: 1.2;
    }

    .minicart-continue:hover {
      color: #ff008c;
    }

    .minicart-checkout-btn {
      background: #ff008c;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 12px 28px;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s;
      text-align: center;
      min-width: 180px;
      box-shadow: none;
      outline: none;
      line-height: 1.2;
      margin-left: auto;
      display: block;
    }

    /* Carrinho SEMPRE visível na navbar */
    .wepink-header .mainbar-icons .icon-link#openMinicartHeader {
      display: flex !important;
    }

    /* MOBILE: ajusta posição do drawer para não sobrepor toda a tela */
    @media (max-width: 991.98px) {
      .minicart-drawer {
        width: 100vw;
        max-width: 100vw;
        right: 0;
        left: 0;
        margin: 0 auto;
        border-radius: 0;
        box-shadow: 0 0 24px rgba(0, 0, 0, 0.08);
      }

      .minicart-overlay {
        background: rgba(0, 0, 0, 0.18);
      }


    }

    /* Overlay e drawer só aparecem quando abertos */
    .minicart-overlay,
    .minicart-drawer {
      display: none;
    }

    .minicart-overlay.open,
    .minicart-drawer.open {
      display: block;
    }

    @media (max-width: 991.98px) {
      .wepink-header .mainbar-icons {
        display: flex !important;
        position: fixed !important;
        right: 1.2rem;
        top: 18px;
        gap: 1.1rem;
        z-index: 3000 !important;
        background: none !important;
        box-shadow: none !important;
        width: auto;
        padding: 0;
        align-items: center;
      }

      .wepink-header .mainbar-icons .icon-link:not(:nth-last-child(-n+2)) {
        display: none !important;
      }
    }

    @media (min-width: 992px) {
      .wepink-header .mainbar-icons {
        position: static !important;
        gap: 1.7rem;
        margin-left: 0.7rem;
        background: transparent;
        box-shadow: none;
      }

      .wepink-header .mainbar-icons .icon-link {
        display: flex !important;
      }
    }
  </style>
</head>

<body>
  <header class="wepink-header">
    <!-- Topbar -->
    <div class="topbar">
      <a href="/../wepink/includes/perfumaria.php">Garanta agora</a> o seu <strong>we favorito!</strong>
    </div>
    <!-- Mainbar -->
    <div class="mainbar container-fluid px-4">
      <div class="mainbar-inner ">
        <!-- Botão hamburguer -->
        <div class="col-md-2 d-flex d-lg-none align-items-center">
          <button class="navbar-toggler" type="button" aria-label="Abrir menu" onclick="document.body.classList.toggle('nav-open')">
            <i class="bi bi-list" style="font-size: 2rem;"></i>
          </button>
        </div>
        <div class="logo-search-group">
          <!-- Logo -->
          <a href="/../wepink/index.php" class="navbar-brand me-0 pe-0">
            <img src="https://wepink.vtexassets.com/assets/vtex/assets-builder/wepink.store-theme/3.1.14/svg/logo-primary___5bd0e7fa6451ba181395889123dfe00a.svg" alt="Wepink">
          </a>
          <!-- Barra de pesquisa (escondida em mobile/tablet pelo CSS acima) -->
          <div class="search-bar-wepink w-100">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control" id="searchInput" placeholder="digite aqui o que procura...">
          </div>
        </div>
        <!-- Ícones -->
        <div class="mainbar-icons">
          <a href="https://wepink.cademeupedido.com.br/" target="_blank" class="icon-link">
            <i class="bi bi-truck"></i> <span class="d-none d-md-inline">Rastreio</span>
          </a>
          <a href="https://wepink.troque.app.br/" target="_blank" class="icon-link">
            <i class="bi bi-arrow-left-right"></i> <span class="d-none d-md-inline">Trocar e Devolver</span>
          </a>
          <a href="/../wepink/includes/painel_usuario.php" class="icon-link">
            <i class="bi bi-person-circle fs-5"></i>
          </a>
          <a href="#" class="icon-link position-relative" id="openMinicartHeader" style="color:#ff1493;">
            <i class="bi bi-cart3 fs-5"></i>
            <span class="badge" style="background:#ff1493;">
              <?php echo isset($cartCount) ? $cartCount : 0; ?>
            </span>
          </a>
          <!-- Overlay + Drawer do minicart -->
          <div class="minicart-overlay" id="minicartOverlay"></div>
          <aside class="minicart-drawer" id="minicartDrawer">
            <div class="minicart-header">
              <span class="minicart-title">
                <i class="bi bi-cart3" style="color:#ff008c;font-size:1.5rem;margin-right:8px;"></i>
                seu carrinho
              </span>
              <button class="minicart-close-btn" id="closeMinicart" aria-label="Fechar">
                <i class="bi bi-x-lg"></i>
              </button>
            </div>
            <div class="minicart-content">
              <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $item): ?>
                  <div class="minicart-item">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="minicart-item-img" />
                    <div class="minicart-item-info">
                      <span class="minicart-item-name"><?= htmlspecialchars($item['name']) ?></span>
                      <div class="minicart-item-controls">
                        <button class="minicart-qty-btn" data-action="decrease" data-id="<?= $item['id'] ?>">-</button>
                        <span class="minicart-item-qty"><?= (int)$item['qty'] ?></span>
                        <button class="minicart-qty-btn" data-action="increase" data-id="<?= $item['id'] ?>">+</button>
                      </div>
                      <span class="minicart-item-price">R$ <?= htmlspecialchars($item['price']) ?></span>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="minicart-empty">
                  <svg fill="none" width="64" height="64" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="7" stroke="#aaa" stroke-width="2" />
                    <rect x="5" y="7" width="6" height="4" fill="#aaa" />
                  </svg>
                  <p>seu carrinho está vazio.</p>
                </div>
              <?php endif; ?>
            </div>
            <div class="minicart-footer">
              <div class="minicart-summary">
                <div class="minicart-summary-row">
                  <span>descontos</span>
                  <span style="color:#ff008c;">-R$ <?= number_format($cartDiscount ?? 0, 2, ',', '.') ?></span>
                </div>
                <div class="minicart-summary-row total">
                  <span>total</span>
                  <span style="color:#ff008c;font-weight:700;">R$ <?= number_format($cartTotal ?? 0, 2, ',', '.') ?></span>
                </div>
              </div>
              <div class="minicart-footer-actions">
                <a href="/../wepink/includes/perfumaria.php" class="minicart-continue">continuar comprando</a>
                <a href="/../wepink/includes/checkout.php" class="minicart-checkout-btn">finalizar compra</a>
              </div>
            </div>
          </aside>
        </div>
      </div>
      <!-- Barra de categorias -->
      <div class="categories-bar-wepink w-100">
        <div class="categories-list">
          <a href="/../wepink/includes/kits.php" class="category-link">kits</a>
          <a href="/../wepink/includes/bath&body.php" class="category-link">bath&amp;body</a>
          <a href="/../wepink/includes/bodysplash.php" class="category-link">body splash</a>
          <a href="/../wepink/includes/perfumaria.php" class="category-link">perfumaria</a>
          <a href="/../wepink/includes/skincare.php" class="category-link">skincare</a>
          <a href="/../wepink/includes/bodycream.php" class="category-link">body cream</a>
          <a href="/../wepink/includes/thecream.php" class="category-link">the cream</a>
          <a href="/../wepink/includes/theoil.php" class="category-link">the oil</a>
          <a href="/../wepink/includes/make.php" class="category-link">make</a>
          <a href="/../wepink/includes/hair.php" class="category-link">hair</a>
          <a href="/../wepink/includes/roll-on.php" class="category-link">roll-on</a>
          <a href="/../wepink/includes/bem-estar.php" class="category-link">bem-estar</a>
        </div>
      </div>
    </div>
  </header>
  <!-- MENU MOBILE CUSTOM -->
  <div class="mobile-menu-overlay" onclick="document.body.classList.remove('nav-open')"></div>
  <nav class="mobile-menu" tabindex="-1">
    <!-- Topo rosa com logo centralizada -->
    <div class="mobile-menu-top bg-pink text-center position-relative">
      <button class="btn-close-mobile"
        aria-label="Fechar menu"
        onclick="document.body.classList.remove('nav-open')"
        style="position:absolute;top:24px;right:24px;background:none;border:none;color:#fff;z-index:2;">
        <i class="bi bi-x-lg" style="font-size:2rem;"></i>
      </button>
      <img src=""
        class="mobile-menu-logo">
      <div class="mobile-menu-icons d-flex justify-content-center align-items-start gap-4 mb-4 flex-nowrap">
        <a href="/../wepink/includes/painel_usuario.php" id="myacounticon" class="icon-link d-flex flex-column align-items-center text-white">
          <i class="bi bi-person-circle fs-3"></i>
          <span class="small mt-1 text-nowrap">Minha<br>conta</span>
        </a>
        <a href="https://wepink.troque.app.br/" target="_blank" class="icon-link d-flex flex-column align-items-center text-white">
          <i class="bi bi-arrow-left-right fs-3"></i>
          <span class="small mt-1 text-nowrap">Trocar e<br>Devolver</span>
        </a>
        <a href="https://wepink.cademeupedido.com.br/" target="_blank" class="icon-link d-flex flex-column align-items-center text-white">
          <i class="bi bi-box-seam fs-3"></i>
          <span class="small mt-1 text-nowrap">Rastreio</span>
        </a>
        <a href="/nossas-lojas" class="icon-link d-flex flex-column align-items-center text-white">
          <i class="bi bi-geo-alt fs-3"></i>
          <span class="small mt-1 text-nowrap">Nossas Lojas</span>
        </a>
      </div>
      <div class="mobile-menu-search d-flex justify-content-center px-3 pb-3">
        <div class="search-bar-wepink w-100" style="max-width:370px;position:relative;">
          <i class="bi bi-search"></i>
          <input type="text" class="form-control" placeholder="digite aqui o que procura..." style="background:#fff;color:#222;">
        </div>
      </div>
    </div>
    <!-- Links em fundo branco -->
    <div class="mobile-menu-categories bg-white pt-2">
      <ul class="list-unstyled m-0 p-0">
        <li><a href="/../wepink/includes/kits.php"><i class="bi bi-gift"></i> Kits <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/bath&body.php"><i class="bi bi-stars"></i> Bath&Body <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/bodysplash.php"><i class="bi bi-stars"></i> Body Splash <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/perfumaria.php"><i class="bi bi-emoji-smile"></i> Perfumaria <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/skincare.php"><i class="bi bi-heart"></i> Skincare <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/bodycream.php"><i class="bi bi-stars"></i> Body Cream <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/thecream.php"><i class="bi bi-stars"></i> The Cream <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/theoil.php"><i class="bi bi-stars"></i> The Oil <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/make.php"><i class="bi bi-stars"></i> Make <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/hair.php"><i class="bi bi-stars"></i> Hair <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/roll-on.php"><i class="bi bi-stars"></i> Roll-on <i class="bi bi-chevron-right ms-auto"></i></a></li>
        <li><a href="/../wepink/includes/bem-estar.php"><i class="bi bi-stars"></i> Bem-estar <i class="bi bi-chevron-right ms-auto"></i></a></li>
      </ul>
    </div>
  </nav>
  <!-- FIM MENU MOBILE CUSTOM -->

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var userIcon = document.querySelector('a[href*="painel_usuario.php"]');
      if (userIcon) {
        userIcon.addEventListener('click', function(e) {
          e.preventDefault();
          if (window.innerWidth < 992) {
            window.location.href = '/../wepink/includes/usuario.php';
          } else {
            window.location.href = '/../wepink/includes/painel_usuario.php';
          }
        });
      }
    });
    document.addEventListener('DOMContentLoaded', function() {
      var myAccountIcon = document.getElementById('myacounticon');
      if (myAccountIcon) {
        myAccountIcon.addEventListener('click', function(e) {
          e.preventDefault();
          if (window.innerWidth < 992) {
            window.location.href = '/../wepink/includes/usuario.php';
          } else {
            window.location.href = '/../wepink/includes/painel_usuario.php';
          }
        });
      }
    });
    // Fecha o menu ao clicar fora ou redimensionar para desktop
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 992) {
        document.body.classList.remove('nav-open');
      }
    });
    document.addEventListener('click', function(e) {
      if (document.body.classList.contains('nav-open')) {
        const header = document.querySelector('.wepink-header');
        const mobileMenu = document.querySelector('.mobile-menu');
        if (!header.contains(e.target) && !mobileMenu.contains(e.target)) {
          document.body.classList.remove('nav-open');
        }
      }
    });

    function openAccountSidebarMobile() {
      // Chame esta função ao clicar no ícone do perfil no mobile!
      document.getElementById('sidebarMobileOverlay').style.display = 'flex';
      document.getElementById('mobileContent').style.display = 'none';
      // Remove destaque dos links
      document.querySelectorAll('#sidebarMobileOverlay .account-nav-link').forEach(link => link.classList.remove('active'));
    };

    // Redireciona para painel_usuario.php ao voltar para desktop
    let wasMobile = window.innerWidth < 992;
    window.addEventListener('resize', function() {
      const isNowDesktop = window.innerWidth >= 992;
      if (wasMobile && isNowDesktop) {
        window.location.href = '/../wepink/includes/painel_usuario.php';
      }
      wasMobile = !isNowDesktop;
      // Fecha o menu ao redimensionar para desktop
      if (isNowDesktop) {
        document.body.classList.remove('nav-open');
      }
    });

    const openBtn = document.getElementById('openMinicartHeader');
    const closeBtn = document.getElementById('closeMinicart');
    const overlay = document.getElementById('minicartOverlay');
    const drawer = document.getElementById('minicartDrawer');

    openBtn.onclick = (e) => {
      e.preventDefault();
      overlay.classList.add('open');
      drawer.classList.add('open');
    };
    closeBtn.onclick = () => {
      overlay.classList.remove('open');
      drawer.classList.remove('open');
    };
    overlay.onclick = (e) => {
      if (e.target === overlay) {
        overlay.classList.remove('open');
        drawer.classList.remove('open');
      }
    };

    function updateNavbarIconsVisibility() {
      var iconsContainer = document.querySelector('.wepink-header .mainbar-icons');
      if (!iconsContainer) return;
      var iconLinks = iconsContainer.querySelectorAll('.icon-link');
      if (window.innerWidth < 992) {
        // Exibe apenas os dois últimos (usuário e carrinho)
        iconLinks.forEach((el, idx) => {
          if (idx < iconLinks.length - 2) {
            el.style.display = 'none';
          } else {
            el.style.display = 'flex';
          }
        });
        iconsContainer.style.position = 'fixed';
        iconsContainer.style.right = '1.2rem';
        iconsContainer.style.top = '18px';
        iconsContainer.style.zIndex = 3000;
        iconsContainer.style.gap = '1.1rem';
      } else {
        // Exibe todos
        iconLinks.forEach(el => el.style.display = 'flex');
        iconsContainer.style.position = '';
        iconsContainer.style.right = '';
        iconsContainer.style.top = '';
        iconsContainer.style.zIndex = '';
        iconsContainer.style.gap = '';
      }
    }

    window.addEventListener('resize', updateNavbarIconsVisibility);
    window.addEventListener('DOMContentLoaded', updateNavbarIconsVisibility);
  </script>
  <script>
    function positionCartIconMobile() {
      var iconsContainer = document.querySelector('.wepink-header .mainbar-icons');
      if (!iconsContainer) return;
      if (window.innerWidth < 992) {
        iconsContainer.style.position = 'fixed';
        iconsContainer.style.right = '1.2rem';
        iconsContainer.style.top = '18px';
        iconsContainer.style.zIndex = 3000;
        iconsContainer.style.gap = '1.1rem';
        iconsContainer.style.background = 'none';
        iconsContainer.style.width = 'auto';
        iconsContainer.style.padding = '0';
        iconsContainer.style.alignItems = 'center';
      } else {
        iconsContainer.style.position = '';
        iconsContainer.style.right = '';
        iconsContainer.style.top = '';
        iconsContainer.style.zIndex = '';
        iconsContainer.style.gap = '';
        iconsContainer.style.background = '';
        iconsContainer.style.width = '';
        iconsContainer.style.padding = '';
        iconsContainer.style.alignItems = '';
      }
    }

    window.addEventListener('resize', positionCartIconMobile);
    window.addEventListener('DOMContentLoaded', positionCartIconMobile);
  </script>
  <!-- Adicione este script antes do </body> -->
  <script>
    // Ao pressionar Enter na barra de pesquisa, redireciona para a página de resultados
    document.addEventListener('DOMContentLoaded', function() {
      var searchInput = document.getElementById('searchInput');
      if (searchInput) {
        searchInput.addEventListener('keydown', function(e) {
          if (e.key === 'Enter') {
            e.preventDefault();
            var query = searchInput.value.trim();
            if (query.length > 1) {
              window.location.href = "/../wepink/includes/busca.php?q=" + encodeURIComponent(query);
            }
          }
        });
      }
    });
  </script>
</body>

</html>