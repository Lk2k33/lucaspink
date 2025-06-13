<?php
include_once '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel do Usuário</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../wepink/assets/css/pailnel.css">
</head>

<body>
    <button class="painel-hamburger" id="painelHamburger" aria-label="Abrir menu" type="button">
        <span></span>
    </button>
    <div class="painel-container">
        <aside class="painel-sidebar">

            <div>
                <div class="painel-avatar">
                    <!-- SVG Avatar -->
                    <svg width="60" height="60" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="55" cy="55" r="55" fill="#D8D8D8" />
                        <ellipse cx="55" cy="46" rx="25" ry="27" fill="#979797" />
                        <ellipse cx="55" cy="90" rx="35" ry="20" fill="#979797" />
                    </svg>
                </div>
                <div class="painel-hello">Olá!</div>
            </div>
            <nav class="painel-menu">
                <a href="#dados" class="active">Dados pessoais</a>
                <a href="#enderecos">Endereços</a>
                <a href="#pedidos">Pedidos</a>
                <a href="#cartoes">Cartões</a>
                <a href="#assinaturas">Assinaturas</a>
                <a href="#autenticacao">Autenticação</a>
                <a href="#sair">Sair</a>
            </nav>


        </aside>

        <main class="painel-main">
            <div class="painel-header" id="painel-header">
                <!-- Conteúdo do header SPA -->
            </div>
            <div class="painel-main-content" id="painel-content">
                <!-- Conteúdo SPA -->
            </div>
        </main>
    </div>
    <script>
        // Conteúdos das páginas
        const conteudos = {
            dados: `
                <div class="painel-enderecos-vtex">
                    <div class="painel-dados-box">
                        <div class="painel-dados-header">Dados Pessoais</div>
                        <table class="painel-dados-table">
                            <tr>
                                <td>
                                    <div class="painel-dados-label">Nome</div>
                                </td>
                                <td>
                                    <div class="painel-dados-label">Sobrenome</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="height:18px"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="painel-dados-label">Email</div>
                                    <div class="painel-dados-value">la38910399393@gmail.com</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="painel-dados-label">CPF</div>
                                </td>
                                <td>
                                    <div class="painel-dados-label">Gênero</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="painel-dados-label">Data de nascimento</div>
                                </td>
                                <td>
                                    <div class="painel-dados-label">Telefone</div>
                                </td>
                            </tr>
                        </table>
                        <div class="painel-dados-footer">
                            <button class="painel-dados-editar-btn" id="editarDadosBtn">Editar</button>
                        </div>
                    </div>
                    <div class="painel-newsletter-box">
                        <div class="painel-newsletter-title">Newsletter</div>
                        <div class="painel-newsletter-desc">Deseja receber e-mails com promoções?</div>
                        <div class="painel-checkbox-row">
                            <input type="checkbox" id="newsletterOptIn" class="painel-checkbox-custom" checked>
                            <label for="newsletterOptIn" class="painel-checkbox-label">Quero receber e-mails com promoções.</label>
                        </div>
                    </div>
                </div>
            `,
            enderecos: `
                <div class="painel-enderecos-vtex">
                    <div class="painel-enderecos-header">
                        <div class="painel-enderecos-header-left">
                            <button class="painel-vtex-btn painel-vtex-btn-back" onclick="window.location.hash='#dados'">
                                <span class="painel-vtex-btn-icon">
                                    <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 15.5002C5.75781 15.5002 5.92969 15.4169 6.10156 15.2502L11 10.5002L9.79687 9.33356L6.35938 12.6669L6.35938 0H4.64063L4.64062 12.6669L1.20312 9.33356L0 10.5002L4.89844 15.2502C5.07031 15.4169 5.24219 15.5002 5.5 15.5002Z" transform="translate(16.0002) rotate(90)" fill="currentColor"/>
                                    </svg>
                                </span>
                                <span class="painel-vtex-btn-text">Voltar</span>
                            </button>
                            <div class="painel-enderecos-title">Endereços</div>
                        </div>
                        <div class="painel-enderecos-header-right">
                            <button class="painel-vtex-btn-add">Adicionar endereço</button>
                        </div>
                    </div>
                    <div class="painel-enderecos-content">
                        <div class="painel-endereco-card">
                            Rua Francisco Muhlbauer 30, as<br>
                            Conjunto Residencial Araratama - Pindamonhangaba - SP<br>
                            12423-140<br>
                            Brasil
                            <button class="painel-endereco-editar-btn">Editar</button>
                        </div>
                    </div>
                </div>
            `,
            pedidos: `
    <div class="painel-pedidos-vtex">
        <div class="painel-pedidos-header" style="flex-direction:column;align-items:flex-start;gap:10px;padding-top:40px;">
            <button class="painel-vtex-btn painel-vtex-btn-back" onclick="window.location.hash='#dados'">
                <span class="painel-vtex-btn-icon">
                    <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 15.5002C5.75781 15.5002 5.92969 15.4169 6.10156 15.2502L11 10.5002L9.79687 9.33356L6.35938 12.6669L6.35938 0H4.64063L4.64062 12.6669L1.20312 9.33356L0 10.5002L4.89844 15.2502C5.07031 15.4169 5.24219 15.5002 5.5 15.5002Z" transform="translate(16.0002) rotate(90)" fill="currentColor"/>
                    </svg>
                </span>
                <span class="painel-vtex-btn-text">Voltar</span>
            </button>
            <div class="painel-pedidos-title">Pedidos</div>
        </div>
        <div class="painel-pedidos-empty">
            <span class="painel-pedidos-empty-msg">Você ainda não possui pedidos!</span>
        </div>
    </div>
`,
            cartoes: `
    <section class="painel-cartoes-vtex">
        <header class="painel-cartoes-header-vtex">
            <div class="painel-cartoes-header-row1">
                <button class="painel-vtex-btn painel-vtex-btn-back" onclick="window.location.hash='#dados'">
                    <span class="painel-vtex-btn-icon">
                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 15.5002C5.75781 15.5002 5.92969 15.4169 6.10156 15.2502L11 10.5002L9.79687 9.33356L6.35938 12.6669L6.35938 0H4.64063L4.64062 12.6669L1.20312 9.33356L0 10.5002L4.89844 15.2502C5.07031 15.4169 5.24219 15.5002 5.5 15.5002Z" transform="translate(16.0002) rotate(90)" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="painel-vtex-btn-text">Voltar</span>
                </button>
            </div>
            <div class="painel-cartoes-header-row2">
                <div class="painel-cartoes-title">Cartões</div>
                <button class="painel-vtex-btn-add">Adicionar cartão</button>
            </div>
        </header>
        <main class="painel-cartoes-empty">
            <span class="painel-cartoes-empty-msg">Você não tem nenhum método de pagamento registrado.</span>
        </main>
    </section>
`,
            assinaturas: `
    <section class="painel-assinaturas-vtex">
        <header class="painel-assinaturas-header">
            <div class="painel-assinaturas-title">Assinaturas</div>
            <button class="painel-vtex-btn-add painel-assinaturas-add-btn">Nova assinatura</button>
        </header>
        <div class="painel-assinaturas-filtro-row">
            <label for="assinaturas-filtro" class="painel-assinaturas-filtro-label">Exibir</label>
            <select id="assinaturas-filtro" class="painel-assinaturas-filtro-select">
                <option>Ativas</option>
                <option>Canceladas</option>
            </select>
        </div>
        <main class="painel-assinaturas-empty">
            <div>
                <div class="painel-assinaturas-empty-title">Você ainda não tem assinaturas</div>
                <div class="painel-assinaturas-empty-desc">Assine seus produtos preferidos e os encontre sempre aqui</div>
            </div>
        </main>
    </section>
`,
            autenticacao: `
    <section class="painel-autenticacao-vtex">
        <header class="painel-autenticacao-header" style="flex-direction:column;align-items:flex-start;gap:10px;padding-top:40px;">
            
            <div class="painel-autenticacao-title">Autenticação</div>
        </header>
        <main class="painel-autenticacao-main">
            <div class="painel-autenticacao-cards">
                <section class="painel-autenticacao-card">
                    <div class="painel-autenticacao-card-title">Senha</div>
                    <div class="painel-autenticacao-card-content">******************</div>
                    <footer class="painel-autenticacao-card-footer">
                        <button class="painel-vtex-btn painel-vtex-btn-outline">Redefinir senha</button>
                    </footer>
                </section>
                <section class="painel-autenticacao-card">
                    <div class="painel-autenticacao-card-title">Gerenciamento de Sessões</div>
                    <div class="painel-autenticacao-card-content">Você tem 1 sessões ativas</div>
                    <footer class="painel-autenticacao-card-footer">
                        <button class="painel-vtex-btn painel-vtex-btn-outline">Ver sessões</button>
                    </footer>
                </section>
            </div>
        </main>
    </section>
`,
            sair: `
                <div class="painel-main-content" style="justify-content:center;">
                    <span class="painel-empty-msg">Você saiu da conta.</span>
                </div>
            `,
            novo_cartao: `
<div class="vtex-render__container-id-my-cards">
  <section class="vtex-account__page w-100 w-80-m" style="max-width:900px;margin:0 auto;">
    <header class="vtex-account__create-card__header">
      <div class="db dn-m">
        <div class="vtex-pageHeader__container pa5 pa7-ns">
          <div class="vtex-pageHeader-link__container mb3">
            <button tabindex="0" class="vtex-button bw1 ba fw5 v-mid relative pa0 br2 bn nr2 nl2 pointer bg-transparent b--transparent c-action-primary hover-b--transparent hover-bg-action-secondary hover-b--action-secondary t-action" type="button" id="btnVoltarCartoes">
              <div class="flex items-center justify-center h-100 pv1 ttn ph2">
                <svg class="vtex__icon-arrow-back" width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.5 15.5002C5.75781 15.5002 5.92969 15.4169 6.10156 15.2502L11 10.5002L9.79687 9.33356L6.35938 12.6669L6.35938 0H4.64063L4.64062 12.6669L1.20312 9.33356L0 10.5002L4.89844 15.2502C5.07031 15.4169 5.24219 15.5002 5.5 15.5002Z" transform="translate(16.0002) rotate(90)" fill="currentColor"/>
                </svg>
                <span class="ml3 ttu t-action--small">Cartões</span>
              </div>
            </button>
          </div>
          <div class="c-on-base flex flex-wrap flex-row justify-between mt0">
            <div class="vtex-pageHeader__title t-heading-2 order-0 flex-grow-1" style="font-size:2rem;font-weight:700;">Novo cartão</div>
            <div class="w-100" style="height: 0px;"></div>
          </div>
        </div>
      </div>
    </header>
    <main class="vtex-account__page-body vtex-account__create-card w-100 pa4-s" style="background:transparent;">
      <div class="row" style="display:flex;flex-wrap:wrap;gap:32px;justify-content:flex-start;">
        <div class="col-12 col-md-7" style="flex:1 1 340px;max-width:480px;min-width:320px;margin-left:0;">
          <form id="form-novo-cartao" autocomplete="off">
            <div class="mb-3">
              <label class="form-label" for="numero-cartao">Número do cartão</label>
              <input type="text" class="form-control" id="numero-cartao" maxlength="19" placeholder="•••• •••• •••• ••••" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="nome-cartao">Nome impresso no cartão</label>
              <input type="text" class="form-control" id="nome-cartao" maxlength="50" placeholder="Nome impresso no cartão" required>
            </div>
            <div class="row mb-3">
              <div class="col-6">
                <label class="form-label" for="validade-cartao">Validade</label>
                <input type="text" class="form-control" id="validade-cartao" maxlength="5" placeholder="MM/AA" required>
              </div>
              <div class="col-6">
                <label class="form-label" for="codigo-cartao">Código de segurança</label>
                <input type="text" class="form-control" id="codigo-cartao" maxlength="4" placeholder="CVV" required>
              </div>
            </div>
            <hr>
            <div class="mb-2" style="font-weight:600;">Endereço de fatura do cartão</div>
            <textarea class="form-control mb-2" rows="3" readonly>Rua Francisco Muhlbauer 30, as
Conjunto Residencial Araratama - Pindamonhangaba - SP
12423-140
Brasil</textarea>
            <button type="button" class="btn btn-pink mb-3" id="btnNovoEndereco" style="background:#ff008c;color:#fff;font-weight:700;">Adicionar novo endereço</button>
            <div class="alert alert-warning" style="font-size:0.98rem;">
              Uma pequena quantia pode ser cobrada para verificar seu cartão. A cobrança será cancelada posteriormente.
            </div>
            <div class="d-flex gap-2 mt-3">
              <button type="submit" class="btn btn-pink flex-fill" style="background:#ff008c;color:#fff;font-weight:700;">Salvar novo cartão</button>
              <button type="button" class="btn btn-outline-pink flex-fill" id="btnCancelarNovoCartao" style="border:2px solid #ff008c;color:#ff008c;font-weight:700;">Cancelar</button>
            </div>
            <div class="mt-3" style="font-size:0.95rem;color:#888;">
              Este cartão não será associado automaticamente a nenhuma assinatura ativa.
            </div>
          </form>
        </div>
        <div class="col-12 col-md-5 d-flex align-items-center justify-content-center" style="min-width:260px;">
          <div style="background:#e5e5e5;border-radius:12px;padding:32px 24px;min-width:260px;max-width:320px;min-height:180px;display:flex;flex-direction:column;align-items:center;">
            <svg width="120" height="80" viewBox="0 0 120 80" fill="none">
              <rect width="120" height="80" rx="12" fill="#bdbdbd"/>
              <rect x="16" y="32" width="88" height="8" rx="2" fill="#fff" fill-opacity="0.3"/>
              <rect x="16" y="48" width="56" height="8" rx="2" fill="#fff" fill-opacity="0.3"/>
              <circle cx="28" cy="24" r="6" fill="#fff" fill-opacity="0.5"/>
              <rect x="80" y="60" width="24" height="6" rx="2" fill="#fff" fill-opacity="0.3"/>
              <text x="24" y="70" fill="#fff" font-size="10" font-family="Arial" opacity="0.7">NOME</text>
              <text x="80" y="70" fill="#fff" font-size="10" font-family="Arial" opacity="0.7">••/••</text>
            </svg>
          </div>
        </div>
      </div>
    </main>
  </section>
</div>
`,
        };
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.querySelector('.painel-sidebar');
            var hamburger = document.getElementById('painelHamburger');
            if (!sidebar || !hamburger) return;

            hamburger.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });

            // Fecha sidebar ao clicar em um link do menu
            sidebar.querySelectorAll('.painel-menu a').forEach(function(link) {
                link.addEventListener('click', function() {
                    sidebar.classList.remove('open');
                });
            });

            // Fecha ao clicar fora da sidebar
            document.addEventListener('click', function(e) {
                if (
                    window.innerWidth <= 900 &&
                    sidebar.classList.contains('open') &&
                    !sidebar.contains(e.target) &&
                    !hamburger.contains(e.target)
                ) {
                    sidebar.classList.remove('open');
                }
            });
        });

        // SPA Navegação
        function renderPainel(hash) {
            let page = (hash || location.hash || "#dados").replace("#", "");
            if (!conteudos[page]) page = "dados";
            // Ativa o link do menu
            document.querySelectorAll('.painel-menu a').forEach(a => {
                a.classList.toggle('active', a.getAttribute('href') === "#" + page);
            });
            // Renderiza header e conteúdo (header só mostra o título se desejar)
            let title = "";
            switch (page) {
                case "dados":
                    title = "Dados pessoais";
                    break;
                case "enderecos":
                    title = "Endereços";
                    break;
                case "pedidos":
                    title = "Pedidos";
                    break;
                case "cartoes":
                    title = "Cartões";
                    break;
                case "assinaturas":
                    title = "Assinaturas";
                    break;
                case "autenticacao":
                    title = "Autenticação";
                    break;
                default:
                    title = "";
            }
            document.getElementById('painel-header').innerHTML = title ? `<span class="painel-title">${title}</span>` : "";
            document.getElementById('painel-content').innerHTML = conteudos[page];
        }

        // Inicialização
        window.addEventListener('DOMContentLoaded', () => {
            renderPainel(location.hash);
            document.querySelectorAll('.painel-menu a').forEach(a => {
                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.hash = this.getAttribute('href');
                });
            });
            window.addEventListener('hashchange', () => renderPainel(location.hash));
        });

        // Adicione ou ajuste este script após o renderPainel para tornar o botão "Editar" funcional

        // Substitua a função ativarEdicaoDados por esta versão ajustada

        // Substitua a função ativarEdicaoDados por esta versão ajustada

        document.addEventListener('DOMContentLoaded', function() {
            function ativarEdicaoDados() {
                const formHTML = `
<section class="vtex-account__page w-100" style="display: flex; flex-direction: column; align-items: flex-start; background: transparent; box-shadow: none; border: none;">
  <header class="vtex-my-account-1-x-profileEdit__header" style="margin-bottom: 0; background: transparent; border: none;">
    <div class="vtex-pageHeader__container" style="padding: 0; background: transparent; border: none;">
      <div class="vtex-pageHeader-link__container" style="margin-bottom: 12px;">
        <button type="button" class="painel-back-btn" style="background: #ff1493; color: #fff; border-radius: 16px; font-size: 1rem; font-weight: 600; border: none; display: inline-flex; align-items: center; padding: 2px 14px; margin-bottom: 18px;" onclick="window.location.hash='#dados'">
          <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 6px;">
            <path d="M5.5 15.5002C5.75781 15.5002 5.92969 15.4169 6.10156 15.2502L11 10.5002L9.79687 9.33356L6.35938 12.6669L6.35938 0H4.64063L4.64062 12.6669L1.20312 9.33356L0 10.5002L4.89844 15.2502C5.07031 15.4169 5.24219 15.5002 5.5 15.5002Z" transform="translate(16.0002) rotate(90)" fill="currentColor"/>
          </svg>
          <span style="font-size: 1rem; font-weight: 600;">Dados pessoais</span>
        </button>
      </div>
      <div style="display: flex; flex-direction: column; align-items: flex-start;">
        <div class="vtex-pageHeader__title" style="font-size: 1.5rem; font-weight: 700; color: #3a3a3a; margin-bottom: 18px;">Editar dados pessoais</div>
      </div>
    </div>
  </header>
  <main class="vtex-account__page-body vtex-my-account-1-x-profileEdit w-100 pa4-s" style="width: 100%; display: flex; justify-content: flex-start; align-items: flex-start; background: transparent; box-shadow: none; border: none;">
    <div class="vtex-my-account-1-x-profileFormBoxContainer" style="max-width: 340px; width: 100%; margin: 0; border: none; box-shadow: none;">
      <div style="padding-bottom: 0; padding-right: 0; width: 100%;">
        <article class="vtex-my-account-1-x-boxContainer" style="border: none; border-radius: 0; background: transparent; box-shadow: none; width: 100%; padding: 0;">
          <main class="vtex-my-account-1-x-boxContainerBody" style="padding: 0;">
            <form class="vtex-profile-form-3-x-profileContainer" autocomplete="off" id="painel-dados-form">
              <div class="vtex-profile-form-3-x-personalFields" style="display: flex; flex-direction: column; gap: 10px;">
                <div class="vtex-profile-form-3-x-styleguideInput pb7" style="margin-bottom: 8px;">
                  <label class="vtex-input w-100" style="width: 100%; border: none; box-shadow: none; background: transparent;">
                    <span class="vtex-input__label db mb3 w-100 f6" style="display: block; margin-bottom: 4px; font-size: 0.95rem; color: #222;">Nome</span>
                    <div class="flex vtex-input-prefix__group relative" style="width: 100%;">
                      <input class="w-100 painel-input" maxlength="100" name="firstName" type="text" value="" style="width: 100%; border: none; border-radius: 8px; padding: 6px 10px; font-size: 0.95rem; background: #fff; color: #222; height: 32px; box-shadow: none;">
                    </div>
                  </label>
                </div>
                <div class="vtex-profile-form-3-x-styleguideInput pb7" style="margin-bottom: 8px;">
                  <label class="vtex-input w-100" style="border: none; box-shadow: none; background: transparent;">
                    <span class="vtex-input__label db mb3 w-100 f6" style="display: block; margin-bottom: 4px; font-size: 0.95rem; color: #222;">Sobrenome</span>
                    <div class="flex vtex-input-prefix__group relative">
                      <input class="w-100 painel-input" maxlength="100" name="lastName" type="text" value="" style="width: 100%; border: none; border-radius: 8px; padding: 6px 10px; font-size: 0.95rem; background: #fff; color: #222; height: 32px; box-shadow: none;">
                    </div>
                  </label>
                </div>
                <div class="vtex-profile-form-3-x-styleguideInput pb7" style="margin-bottom: 8px;">
                  <label class="vtex-input w-100" style="border: none; box-shadow: none; background: transparent;">
                    <span class="vtex-input__label db mb3 w-100 f6" style="display: block; margin-bottom: 4px; font-size: 0.95rem; color: #222;">CPF</span>
                    <div class="flex vtex-input-prefix__group relative">
                      <input class="w-100 painel-input" maxlength="50" name="document" placeholder="Opcional" type="text" value="" style="width: 100%; border: none; border-radius: 8px; padding: 6px 10px; font-size: 0.95rem; background: #fff; color: #222; height: 32px; box-shadow: none;">
                    </div>
                  </label>
                </div>
                <div class="vtex-profile-form-3-x-styleguideInput pb7" style="margin-bottom: 8px;">
                  <label class="vtex-input w-100" style="border: none; box-shadow: none; background: transparent;">
                    <span class="vtex-input__label db mb3 w-100 f6" style="display: block; margin-bottom: 4px; font-size: 0.95rem; color: #222;">Telefone</span>
                    <div class="flex vtex-input-prefix__group relative">
                      <input class="w-100 painel-input" maxlength="30" name="homePhone" placeholder="Obrigatório" type="text" value="" style="width: 100%; border: none; border-radius: 8px; padding: 6px 10px; font-size: 0.95rem; background: #fff; color: #222; height: 32px; box-shadow: none;">
                    </div>
                    <div class="t-required-phone red f6 mt3 lh-title" style="color:#ff008c; font-size: 0.85rem; margin-top: 2px;"></div>
                  </label>
                </div>
                <div class="vtex-profile-form-3-x-styleguideInput pb7" style="margin-bottom: 8px;">
                  <label class="vtex-input w-100" style="border: none; box-shadow: none; background: transparent;">
                    <span class="vtex-input__label db mb3 w-100 f6" style="display: block; margin-bottom: 4px; font-size: 0.95rem; color: #222;">Gênero</span>
                    <div class="br2 bw1 relative bg-white ba b--light-gray hover-b--silver" style="border-radius: 8px; border: none; background: #fff;">
                      <select class="w-100 painel-input" name="gender" style="width: 100%; border: none; outline: none; font-size: 0.95rem; background: #fff; color: #222; height: 32px; padding: 6px 10px;">
                        <option disabled="" value="">Opcional</option>
                        <option value="male">Masculino</option>
                        <option value="female">Feminino</option>
                      </select>
                    </div>
                  </label>
                </div>
                <div class="vtex-profile-form-3-x-styleguideInput pb7" style="margin-bottom: 8px;">
                  <label class="vtex-input w-100" style="border: none; box-shadow: none; background: transparent;">
                    <span class="vtex-input__label db mb3 w-100 f6" style="display: block; margin-bottom: 4px; font-size: 0.95rem; color: #222;">Data de nascimento</span>
                    <div class="flex vtex-input-prefix__group relative">
                      <input class="w-100 painel-input" maxlength="30" name="birthDate" placeholder="Opcional" type="text" value="" style="width: 100%; border: none; border-radius: 8px; padding: 6px 10px; font-size: 0.95rem; background: #fff; color: #222; height: 32px; box-shadow: none;">
                    </div>
                  </label>
                </div>
              </div>
              <div class="vtex-profile-form-3-x-toggleBusinessButtonWrapper mb7" style="margin-bottom: 10px;">
                <button type="button" class="vtex-button--primary" style="width:100%;margin-top:18px;" style="width: 100%; background: #ff008c; color: #fff; border-radius: 8px; font-weight: 700; font-size: 0.95rem; padding: 8px 0; border: none; height: 32px;">INCLUIR CAMPOS DE PESSOA JURÍDICA</button>
              </div>
              <button tabindex="0" class="vtex-button--primary" style="width:100%;margin-top:18px;" type="submit" style="width: 100%; background: #ff008c; color: #fff; border-radius: 8px; font-weight: 700; font-size: 0.95rem; padding: 8px 0; border: none; height: 32px;">
                Salvar alterações
              </button>
            </form>
          </main>
        </article>
      </div>
    </div>
  </main>
</section>
`;
                // Substitui o conteúdo da box por formulário de edição VTEX-like
                const box = document.querySelector('.painel-dados-box');
                if (box) box.innerHTML = formHTML;

                // Esconde o newsletter box
                const newsletter = document.querySelector('.painel-newsletter-box');
                if (newsletter) newsletter.style.display = 'none';

                // Cancelar volta para visualização e mostra newsletter
                const backBtn = document.querySelector('.painel-back-btn');
                if (backBtn) {
                    backBtn.onclick = function() {
                        renderPainel('#dados');
                        setTimeout(() => {
                            const newsletter = document.querySelector('.painel-newsletter-box');
                            if (newsletter) newsletter.style.display = '';
                        }, 10);
                    };
                }
                // Submissão do formulário (aqui só volta para visualização, implemente o envio real se quiser)
                const form = document.getElementById('painel-dados-form');
                if (form) {
                    form.onsubmit = function(e) {
                        e.preventDefault();
                        renderPainel('#dados');
                        setTimeout(() => {
                            const newsletter = document.querySelector('.painel-newsletter-box');
                            if (newsletter) newsletter.style.display = '';
                        }, 10);
                    };
                }
            }

            // SPA Navegação
            function afterRenderPainel() {
                const btn = document.getElementById('editarDadosBtn');
                if (btn) btn.onclick = ativarEdicaoDados;
            }

            // Modifique renderPainel para chamar afterRenderPainel
            const oldRenderPainel = window.renderPainel;
            window.renderPainel = function(hash) {
                oldRenderPainel(hash);
                afterRenderPainel();
            };
            afterRenderPainel();
        });

        function ativarEdicaoEndereco(endereco = {}) {
            const formEndereco = `
    <div class="painel-enderecos-vtex" style="display:flex;justify-content:center;align-items:flex-start;width:100%;">
        <div style="width:100%;max-width:420px;background:#fff;border:1px solid #e3e4e6;border-radius:10px;padding:32px 36px;margin:32px auto 0 auto;">
            <button class="painel-vtex-btn painel-vtex-btn-back" style="margin-bottom:18px;" onclick="window.location.hash='#enderecos'">
                <span class="painel-vtex-btn-icon">
                    <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 15.5002C5.75781 15.5002 5.92969 15.4169 6.10156 15.2502L11 10.5002L9.79687 9.33356L6.35938 12.6669L6.35938 0H4.64063L4.64062 12.6669L1.20312 9.33356L0 10.5002L4.89844 15.2502C5.07031 15.4169 5.24219 15.5002 5.5 15.5002Z" transform="translate(16.0002) rotate(90)" fill="currentColor"/>
                    </svg>
                </span>
                <span class="painel-vtex-btn-text">Endereços</span>
            </button>
            <div style="font-size:2rem;font-weight:700;color:#3a3a3a;margin-bottom:24px;">Editar endereço</div>
            <form id="form-editar-endereco" autocomplete="off">
                <label class="vtex-input__label" for="pais">País</label>
                <select id="pais" name="pais" class="painel-input" style="margin-bottom:12px;" disabled>
                    <option selected>Brasil</option>
                </select>
                <label class="vtex-input__label" for="cep">CEP</label>
                <input type="text" id="cep" name="cep" class="painel-input" maxlength="9" value="${endereco.cep || ''}" style="margin-bottom:4px;" placeholder="Digite o CEP" required>
                <div id="cep-erro" style="color:#ff008c;font-size:0.95rem;display:none;margin-bottom:8px;">Não sei meu CEP <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank" style="color:#ff008c;text-decoration:underline;font-weight:600;">Clique aqui</a></div>
                <div id="endereco-formatado" style="color:#222;font-size:1.05rem;margin-bottom:8px;line-height:1.4;">
                    ${endereco.logradouro ? `
                        ${endereco.logradouro} ${endereco.numero || ''}<br>
                        ${endereco.bairro ? endereco.bairro + ' - ' : ''}${endereco.localidade || ''} - ${endereco.uf || ''}<br>
                        ${endereco.cep || ''} - <span style="color:#ff1493;cursor:pointer;" id="editarCepLink">Editar</span>
                    ` : ''}
                </div>
                <label class="vtex-input__label" for="complemento">Complemento e referência</label>
                <input type="text" id="complemento" name="complemento" class="painel-input" maxlength="60" value="${endereco.complemento || ''}">
                <label class="vtex-input__label" for="destinatario">Destinatário</label>
                <input type="text" id="destinatario" name="destinatario" class="painel-input" maxlength="60" value="${endereco.destinatario || ''}">
                <button type="submit" class="vtex-button--primary" style="width:100%;margin-top:18px;">Salvar endereço</button>
                <button type="button" class="vtex-button--primary" style="width:100%;background:#fff;color:#ff008c;border:2px solid #ff008c;margin-top:12px;" id="removerEnderecoBtn">Remover endereço</button>
            </form>
        </div>
    </div>
    `;
            document.getElementById('painel-content').innerHTML = formEndereco;


            // CEP API (ViaCEP)
            const cepInput = document.getElementById('cep');
            const enderecoFormatado = document.getElementById('endereco-formatado');
            const cepErro = document.getElementById('cep-erro');
            cepInput.addEventListener('input', function() {
                let cep = cepInput.value.replace(/\D/g, '');
                if (cep.length === 8) {
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(r => r.json())
                        .then(data => {
                            if (data.erro) {
                                enderecoFormatado.innerHTML = '';
                                cepErro.style.display = 'block';
                            } else {
                                cepErro.style.display = 'none';
                                enderecoFormatado.innerHTML = `
                            ${data.logradouro} <input type="text" id="numero" name="numero" class="painel-input" style="width:80px;display:inline-block;margin:0 4px;" placeholder="Nº" required>
                            <br>${data.bairro} - ${data.localidade} - ${data.uf}<br>
                            ${data.cep} - <span style="color:#ff1493;cursor:pointer;" id="editarCepLink">Editar</span>
                        `;
                                // Preencher campos ocultos se quiser
                            }
                        });
                } else {
                    enderecoFormatado.innerHTML = '';
                    cepErro.style.display = 'none';
                }
            });

            // Editar CEP
            enderecoFormatado.addEventListener('click', function(e) {
                if (e.target.id === 'editarCepLink') {
                    cepInput.disabled = false;
                    cepInput.focus();
                }
            });

            // Remover endereço (apenas volta para lista)
            document.getElementById('removerEnderecoBtn').onclick = function() {
                window.location.hash = '#enderecos';
            };

            // Submissão do formulário
            document.getElementById('form-editar-endereco').onsubmit = function(e) {
                e.preventDefault();
                window.location.hash = '#enderecos';
            };
        }

        // SPA: botão editar endereço
        function afterRenderPainelEndereco() {
            document.querySelectorAll('.painel-endereco-editar-btn').forEach(btn => {
                btn.onclick = () => ativarEdicaoEndereco();
            });
        }
        const oldRenderPainelEnd = window.renderPainel;
        window.renderPainel = function(hash) {
            oldRenderPainelEnd(hash);
            if ((hash || location.hash) === "#enderecos") afterRenderPainelEndereco();
        };

        function renderPainel(hash) {
            let page = (hash || location.hash || "#dados").replace("#", "");
            if (!conteudos[page]) page = "dados";

            // Ativa o link do menu
            document.querySelectorAll('.painel-menu a').forEach(a => {
                a.classList.toggle('active', a.getAttribute('href') === "#" + page);
            });

            // Renderiza header e conteúdo (header só mostra o título se desejar)
            let title = "";

            document.getElementById('painel-header').innerHTML = title ? `<span class="painel-title">${title}</span>` : "";
            document.getElementById('painel-content').innerHTML = conteudos[page];
        }

        // SPA: botão "Adicionar cartão"
        function afterRenderPainelCartoes() {
            document.querySelectorAll('.painel-vtex-btn-add').forEach(btn => {
                btn.onclick = () => {
                    renderPainel('#novo_cartao');
                    setTimeout(afterRenderPainelNovoCartao, 10);
                };
            });
        }

        function afterRenderPainelNovoCartao() {
            // Voltar para lista de cartões
            const btnVoltar = document.getElementById('btnVoltarCartoes');
            if (btnVoltar) btnVoltar.onclick = () => renderPainel('#cartoes');
            // Cancelar
            const btnCancelar = document.getElementById('btnCancelarNovoCartao');
            if (btnCancelar) btnCancelar.onclick = () => renderPainel('#cartoes');
            // Submissão do form (apenas SPA, não envia de verdade)
            const form = document.getElementById('form-novo-cartao');
            if (form) form.onsubmit = function(e) {
                e.preventDefault();
                alert('Cartão cadastrado com sucesso! (SPA)');
                renderPainel('#cartoes');
            };
            // Botão adicionar novo endereço
            const btnNovoEndereco = document.getElementById('btnNovoEndereco');
            if (btnNovoEndereco) btnNovoEndereco.onclick = showEnderecoForm;
        }

        // Função para exibir o form de endereço como modal SPA
        function showEnderecoForm() {
            document.getElementById('painel-content').innerHTML = `
    <div class="painel-enderecos-vtex" style="display:flex;justify-content:center;align-items:flex-start;width:100%;">
      <div style="width:100%;max-width:420px;background:#fff;border:1px solid #e3e4e6;border-radius:10px;padding:32px 36px;margin:32px auto 0 auto;">
        <button class="painel-vtex-btn painel-vtex-btn-back" style="margin-bottom:18px;" id="voltarParaNovoCartao">
          <span class="painel-vtex-btn-icon">
            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.5 15.5002C5.75781 15.5002 5.92969 15.4169 6.10156 15.2502L11 10.5002L9.79687 9.33356L6.35938 12.6669L6.35938 0H4.64063L4.64062 12.6669L1.20312 9.33356L0 10.5002L4.89844 15.2502C5.07031 15.4169 5.24219 15.5002 5.5 15.5002Z" transform="translate(16.0002) rotate(90)" fill="currentColor"/>
            </svg>
          </span>
          <span class="painel-vtex-btn-text">Novo cartão</span>
        </button>
        <div style="font-size:2rem;font-weight:700;color:#3a3a3a;margin-bottom:24px;">Novo endereço de cobrança</div>
        <form id="form-editar-endereco" autocomplete="off">
          <label class="vtex-input__label" for="pais">País</label>
          <select id="pais" name="pais" class="painel-input" style="margin-bottom:12px;" disabled>
            <option selected>Brasil</option>
          </select>
          <label class="vtex-input__label" for="cep">CEP</label>
          <input type="text" id="cep" name="cep" class="painel-input" maxlength="9" style="margin-bottom:4px;" placeholder="Digite o CEP" required>
          <div id="cep-erro" style="color:#ff008c;font-size:0.95rem;display:none;margin-bottom:8px;">Não sei meu CEP <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank" style="color:#ff008c;text-decoration:underline;font-weight:600;">Clique aqui</a></div>
          <div id="endereco-formatado" style="color:#222;font-size:1.05rem;margin-bottom:8px;line-height:1.4;"></div>
          <label class="vtex-input__label" for="complemento">Complemento e referência</label>
          <input type="text" id="complemento" name="complemento" class="painel-input" maxlength="60">
          <label class="vtex-input__label" for="destinatario">Destinatário</label>
          <input type="text" id="destinatario" name="destinatario" class="painel-input" maxlength="60">
          <button type="submit" class="vtex-button--primary" style="width:100%;margin-top:18px;">Salvar endereço</button>
          <button type="button" class="vtex-button--primary" style="width:100%;background:#fff;color:#ff008c;border:2px solid #ff008c;margin-top:12px;" id="cancelarNovoEnderecoBtn">Cancelar</button>
        </form>
      </div>
    </div>
  `;

            // Voltar para o form de cartão
            document.getElementById('voltarParaNovoCartao').onclick = () => renderPainel('#novo_cartao');
            document.getElementById('cancelarNovoEnderecoBtn').onclick = () => renderPainel('#novo_cartao');

            // CEP API (ViaCEP)
            const cepInput = document.getElementById('cep');
            const enderecoFormatado = document.getElementById('endereco-formatado');
            const cepErro = document.getElementById('cep-erro');
            cepInput.addEventListener('input', function() {
                let cep = cepInput.value.replace(/\D/g, '');
                if (cep.length === 8) {
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(r => r.json())
                        .then(data => {
                            if (data.erro) {
                                enderecoFormatado.innerHTML = '';
                                cepErro.style.display = 'block';
                            } else {
                                cepErro.style.display = 'none';
                                enderecoFormatado.innerHTML = `
              ${data.logradouro} <input type="text" id="numero" name="numero" class="painel-input" style="width:80px;display:inline-block;margin:0 4px;" placeholder="Nº" required>
              <br>${data.bairro} - ${data.localidade} - ${data.uf}<br>
              ${data.cep}
            `;
                            }
                        });
                } else {
                    enderecoFormatado.innerHTML = '';
                    cepErro.style.display = 'none';
                }
            });

            // Submissão do formulário (SPA)
            document.getElementById('form-editar-endereco').onsubmit = function(e) {
                e.preventDefault();
                // Aqui você pode salvar o endereço, mas no SPA só volta para o cartão
                renderPainel('#novo_cartao');
            };
        }

        // Modifique renderPainel para chamar afterRenderPainelCartoes e afterRenderPainelNovoCartao
        const oldRenderPainel = window.renderPainel;
        window.renderPainel = function(hash) {
            oldRenderPainel(hash);
            if ((hash || location.hash) === "#cartoes") afterRenderPainelCartoes();
            if ((hash || location.hash) === "#novo_cartao") afterRenderPainelNovoCartao();
        };
    </script>
</body>

<?php
include_once '../includes/footer.php';
