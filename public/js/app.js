/**
 * AutoPart.tn - Main JavaScript
 */
document.addEventListener('DOMContentLoaded', function () {

    // =============================================
    // 1. AUTO-HIDE ALERTS
    // =============================================
    document.querySelectorAll('.alert:not(.alert-permanent)').forEach(function (alert) {
        setTimeout(function () {
            if (typeof bootstrap !== 'undefined') {
                var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                if (bsAlert) bsAlert.close();
            }
        }, 5000);
    });

    // =============================================
    // 2. IMAGE PREVIEW ON FILE INPUT
    // =============================================
    document.querySelectorAll('input[type="file"][accept*="image"]').forEach(function (input) {
        input.addEventListener('change', function () {
            var file = this.files[0];
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function (e) {
                var preview = input.closest('.card-body, .mb-3, .col-12')?.querySelector('img');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail mt-2 d-block';
                    img.style.maxHeight = '120px';
                    img.style.objectFit = 'contain';
                    input.parentElement.appendChild(img);
                }
            };
            reader.readAsDataURL(file);
        });
    });

    // =============================================
    // 3. QUANTITY INPUT BOUNDS
    // =============================================
    document.querySelectorAll('input[type="number"][name="quantity"]').forEach(function (input) {
        input.addEventListener('change', function () {
            var max = parseInt(this.getAttribute('max') || '999');
            var min = parseInt(this.getAttribute('min') || '1');
            if (parseInt(this.value) > max) this.value = max;
            if (parseInt(this.value) < min) this.value = min;
        });
    });

    // =============================================
    // 4. AJAX ADD TO CART
    // =============================================
    document.querySelectorAll('form[action*="panier/ajouter"]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn = form.querySelector('button[type="submit"]');
            var originalText = btn ? btn.innerHTML : '';
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Ajout...';
            }

            var formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (data.success) {
                    // Update cart count badge
                    document.querySelectorAll('.cart-count').forEach(function (badge) {
                        badge.textContent = data.count || 0;
                        badge.classList.add('animate__animated', 'animate__bounceIn');
                        setTimeout(() => badge.classList.remove('animate__animated', 'animate__bounceIn'), 600);
                    });
                    // Show toast
                    showToast('Produit ajouté au panier !', 'success');
                } else {
                    showToast(data.message || 'Erreur lors de l\'ajout.', 'danger');
                }
            })
            .catch(function () {
                // Fallback: submit normally
                form.submit();
            })
            .finally(function () {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            });
        });
    });

    // =============================================
    // 5. CART UPDATE AJAX
    // =============================================
    document.querySelectorAll('form[action*="panier/modifier"]').forEach(function (form) {
        // Already handled by button submit with quantity value
    });

    // =============================================
    // 6. CHECKOUT: FILL ADDRESS FROM SAVED
    // =============================================
    window.fillAddress = function (addr) {
        if (!addr) return;
        var fields = {
            'first_name': addr.first_name,
            'last_name':  addr.last_name,
            'phone':      addr.phone,
            'address':    addr.address_line1,
            'city':       addr.city,
            'state':      addr.state,
        };
        Object.keys(fields).forEach(function (key) {
            var el = document.querySelector('[name="' + key + '"]');
            if (el && fields[key]) el.value = fields[key];
        });
    };

    // =============================================
    // 7. ADMIN: CONFIRM DELETE
    // =============================================
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            if (!confirm(this.getAttribute('data-confirm') || 'Êtes-vous sûr ?')) {
                e.preventDefault();
            }
        });
    });

    // =============================================
    // 8. LAZY LOADING IMAGES
    // =============================================
    if ('IntersectionObserver' in window) {
        var lazyImages = document.querySelectorAll('img[data-src]');
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.src = entry.target.getAttribute('data-src');
                    entry.target.removeAttribute('data-src');
                    observer.unobserve(entry.target);
                }
            });
        });
        lazyImages.forEach(function (img) { observer.observe(img); });
    }

    // =============================================
    // 9. STICKY HEADER SHADOW
    // =============================================
    var header = document.querySelector('.header');
    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('shadow', window.scrollY > 10);
        });
    }

    // =============================================
    // 10. COUPON CODE UPPERCASE
    // =============================================
    var couponInput = document.querySelector('input[name="coupon_code"]');
    if (couponInput) {
        couponInput.addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });
    }

});

// =============================================
// TOAST NOTIFICATION
// =============================================
function showToast(message, type) {
    type = type || 'success';
    var container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        container.style.cssText = 'position:fixed;top:80px;right:20px;z-index:9999;min-width:280px;';
        document.body.appendChild(container);
    }
    var toast = document.createElement('div');
    toast.className = 'alert alert-' + (type === 'danger' ? 'danger' : 'success') + ' alert-dismissible fade show shadow';
    toast.innerHTML = message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    container.appendChild(toast);
    setTimeout(function () {
        if (toast.parentNode) toast.remove();
    }, 4000);
}
