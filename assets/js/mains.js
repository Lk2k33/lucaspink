document.addEventListener('DOMContentLoaded', function() {
    // Menu dropdown hover
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('mouseenter', function() {
            this.querySelector('.dropdown-menu').classList.add('show');
        });
        
        dropdown.addEventListener('mouseleave', function() {
            this.querySelector('.dropdown-menu').classList.remove('show');
        });
    });
    
    // Carrinho flutuante
    const cartIcon = document.querySelector('.bi-cart');
    let cartItems = 0;
    
    // Simular adição ao carrinho
    document.querySelectorAll('.btn-pink').forEach(button => {
        if (!button.closest('.modal')) {
            button.addEventListener('click', function(e) {
                if (!this.href) {
                    e.preventDefault();
                    cartItems++;
                    updateCartCount();
                    
                    // Animação
                    const productCard = this.closest('.product-card');
                    if (productCard) {
                        const productImage = productCard.querySelector('img');
                        const flyer = productImage.cloneNode();
                        flyer.style.position = 'absolute';
                        flyer.style.width = '50px';
                        flyer.style.height = '50px';
                        flyer.style.objectFit = 'cover';
                        flyer.style.borderRadius = '50%';
                        flyer.style.zIndex = '1000';
                        flyer.style.transition = 'all 0.5s ease';
                        
                        const rect = productImage.getBoundingClientRect();
                        flyer.style.left = rect.left + 'px';
                        flyer.style.top = rect.top + 'px';
                        
                        document.body.appendChild(flyer);
                        
                        const cartRect = cartIcon.getBoundingClientRect();
                        
                        setTimeout(() => {
                            flyer.style.left = (cartRect.left + 10) + 'px';
                            flyer.style.top = (cartRect.top + 10) + 'px';
                            flyer.style.opacity = '0.5';
                            flyer.style.transform = 'scale(0.2)';
                        }, 10);
                        
                        setTimeout(() => {
                            flyer.remove();
                        }, 600);
                    }
                }
            });
        }
    });
    
    function updateCartCount() {
        if (cartItems > 0) {
            let badge = cartIcon.querySelector('.cart-badge');
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
                cartIcon.parentNode.appendChild(badge);
            }
            badge.textContent = cartItems;
        }
    }
    
    // Newsletter form
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            // Simular envio
            setTimeout(() => {
                alert('Obrigado por assinar nossa newsletter! Um e-mail de confirmação foi enviado.');
                this.reset();
            }, 500);
        });
    }
    
    // Modal newsletter form
    const modalNewsletterForm = document.querySelector('.newsletter-form');
    if (modalNewsletterForm) {
        modalNewsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            // Simular envio
            setTimeout(() => {
                alert('Obrigado! Seu cupom de 10% de desconto é: WEPINK10');
                this.reset();
                bootstrap.Modal.getInstance(document.getElementById('newsletterModal')).hide();
            }, 500);
        });
    }
});