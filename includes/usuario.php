<?php
include_once '../includes/header.php';
?>
<style>
    /* Mobile-first styles for the user panel */
    .user-panel-container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 3rem 0;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }

    .user-panel-aside {
        background: #fff;
        padding: 3rem 2rem;
        width: 100%;
        box-sizing: border-box;
    }

    .user-info {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        margin-bottom: 2rem;
    }

    .user-image {
        position: relative;
        margin-right: 1.5rem;
        height: 48px;
        width: 48px;
    }

    .user-greeting {
        font-size: 1.3rem;
        font-weight: 400;
        white-space: nowrap;
        margin-top: 0.5rem;
    }

    .menu-links {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .menu-link {
        font-size: 1rem;
        text-decoration: none;
        display: block;
        padding: 1.25rem 0 1.25rem 1.25rem;
        border-left: 2px solid transparent;
        color: #b0a7ab;
        margin: 0.5rem 0;
        transition: border-color 0.2s, color 0.2s;
    }

    .menu-link:hover {
        color: #111;
        border-left: 2px solid #ff3190;
    }

    .menu-logout {
        font-size: 1rem;
        text-decoration: none;
        display: block;
        padding: 1.25rem 0 1.25rem 1.25rem;
        border-left: 2px solid transparent;
        color: #b0a7ab;
        margin: 0.5rem 0;
        cursor: pointer;
    }

    .menu-logout:hover {
        color: #111;
        border-left: 2px solid #ff3190;
    }

    /* Desktop breakpoint: hide the panel */
    @media (min-width: 1025px) {
        .user-panel-container {
            display: none;
        }
    }
</style>
<div class="user-panel-container">
    <aside class="user-panel-aside">
        <div class="user-info">
            <div class="user-image"> <!-- SVG or user image --> <svg width="48" height="48" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="110" height="110" fill="black" fill-opacity="0"></rect>
                    <rect width="110" height="110" fill="black" fill-opacity="0"></rect>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M55 110C85.3757 110 110 85.3757 110 55C110 24.6243 85.3757 0 55 0C24.6243 0 0 24.6243 0 55C0 85.3757 24.6243 110 55 110Z" fill="#D8D8D8"></path>
                    <mask id="mask0" maskUnits="userSpaceOnUse" x="0" y="0" width="110" height="110">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M55 110C85.3757 110 110 85.3757 110 55C110 24.6243 85.3757 0 55 0C24.6243 0 0 24.6243 0 55C0 85.3757 24.6243 110 55 110Z" fill="white"></path>
                    </mask>
                    <g mask="url(#mask0)">
                        <rect width="85.3731" height="96.8655" fill="black" fill-opacity="0" transform="translate(13.1367 21.3433)"></rect>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M66.4949 78.5818H45.1516C27.4705 78.5818 13.1367 93.0978 13.1367 111.004C13.1367 111.004 29.1442 118.209 55.8233 118.209C82.5024 118.209 98.5098 111.004 98.5098 111.004C98.5098 93.0978 84.1761 78.5818 66.4949 78.5818Z" fill="#979797"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M30.7969 46C30.7969 32.3824 42.0001 21.3433 55.82 21.3433C69.64 21.3433 80.8432 32.3824 80.8432 46C80.8432 59.6175 69.64 74.1791 55.82 74.1791C42.0001 74.1791 30.7969 59.6175 30.7969 46Z" fill="#979797"></path>
                    </g>
                </svg> </div>
            <div class="user-greeting">Olá!</div>
        </div>
        <nav class="menu-links"> <a href="#dados" class="menu-link">Dados pessoais</a> <a href="#enderecos" class="menu-link">Endereços</a> <a href="#pedidos" class="menu-link">Pedidos</a> <a href="#cartoes" class="menu-link">Cartões</a> <a href="#assinaturas" class="menu-link">Assinaturas</a> <a href="#autenticacao" class="menu-link">Autenticação</a>
            <a href="#sair" class="menu-link">Sair</a>
        </nav>
    </aside>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.menu-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                // Redireciona para painel_usuario.php e passa o hash da opção escolhida
                window.location.href = '/../wepink/includes/painel_usuario.php' + this.getAttribute('href');
            });
        });
    });
</script>
<?php include_once '../includes/footer.php'; ?>