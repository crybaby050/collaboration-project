/**
 * Mbollo - Application JavaScript principale
 */

// ATTENDRE QUE LE DOM SOIT CHARGÉ
console.log('Script.js chargé !');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM chargé, initialisation...');
    
    // Récupérer les éléments après le chargement du DOM
    initMenu();
    initTheme();
    initCounters();
    initScrollAnimations();
    initTableHover();
    initPasswordToggle();
    initFormValidation();
    initButtonInteractions();

    console.log('Mbollo - Application chargée !');
});

// ============================================
// MODULE 1 : MENU RETRACTABLE
// ============================================
function initMenu() {
    // Récupérer les éléments DANS la fonction
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const menuToggleBtn = document.getElementById('menuToggleBtn');
    const closeMenuBtn = document.getElementById('closeMenuBtn');
    
    if (!sidebar || !menuToggleBtn) {
        console.log('Menu : éléments non trouvés');
        return;
    }
    
    function openMenu() {
        sidebar.classList.add('open');  // CORRIGÉ : classList au lieu de classtList
        if (overlay) overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMenu() {
        sidebar.classList.remove('open');  // CORRIGÉ : classList
        if (overlay) overlay.classList.remove('open');
        document.body.style.overflow = '';
    }
    
    menuToggleBtn.addEventListener('click', openMenu);
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
    if (overlay) overlay.addEventListener('click', closeMenu);
    
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            closeMenu();
        }
    });
    
    console.log('Menu initialisé');
}

// ============================================
// MODULE 2 : THEME CLAIR / SOMBRE
// ============================================
function initTheme() {
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const body = document.getElementById('body');
    
    if (!themeToggle) return;
    
    function setTheme(theme) {
        if (theme === 'dark') {
            body.classList.add('dark');
            body.style.backgroundColor = '#1a1a2e';
            body.style.color = '#e0e0e0';
            
            document.querySelectorAll('.bg-white').forEach(el => {
                if (!el.closest('.sidebar')) {
                    el.classList.add('dark-mode-card');
                    el.style.backgroundColor = '#16213e';
                    el.style.color = '#e0e0e0';
                }
            });
            
            document.querySelectorAll('.text-gray-800, .text-gray-900').forEach(el => {
                el.style.color = '#e0e0e0';
            });
            document.querySelectorAll('.text-gray-500, .text-gray-600, .text-gray-700').forEach(el => {
                el.style.color = '#a0a0a0';
            });
            document.querySelectorAll('.bg-gray-50').forEach(el => {
                el.style.backgroundColor = '#0f172a';
            });
            document.querySelectorAll('.border-gray-200').forEach(el => {
                el.style.borderColor = '#2d3748';
            });
            
            if (themeIcon) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            }
        } else {
            body.classList.remove('dark');
            body.style.backgroundColor = '';
            body.style.color = '';
            
            document.querySelectorAll('.dark-mode-card').forEach(el => {
                el.style.backgroundColor = '';
                el.style.color = '';
            });
            document.querySelectorAll('.text-gray-800, .text-gray-900').forEach(el => {
                el.style.color = '';
            });
            document.querySelectorAll('.text-gray-500, .text-gray-600, .text-gray-700').forEach(el => {
                el.style.color = '';
            });
            document.querySelectorAll('.bg-gray-50').forEach(el => {
                el.style.backgroundColor = '';
            });
            document.querySelectorAll('.border-gray-200').forEach(el => {
                el.style.borderColor = '';
            });
            
            if (themeIcon) {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }
    }
    
    let isDark = false;
    themeToggle.addEventListener('click', () => {
        isDark = !isDark;
        setTheme(isDark ? 'dark' : 'light');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
    
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        isDark = true;
        setTheme('dark');
    }
}

// ============================================
// MODULE 3 : ANIMATION DES COMPTEURS
// ============================================
function initCounters() {
    const counters = document.querySelectorAll('.counter');
    
    if (counters.length === 0) return;
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        if (target && target > 0) {
            counter.textContent = '0';
            animateCounter(counter, target);
        }
    });
}

function animateCounter(element, target, duration = 800) {
    let start = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start);
        }
    }, 16);
}

// ============================================
// MODULE 4 : ANIMATIONS AU SCROLL
// ============================================
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.stat-card, .animate-fade-up');
    if (animatedElements.length === 0) return;
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
}

// ============================================
// MODULE 5 : SURVOL DES LIGNES DE TABLEAU
// ============================================
function initTableHover() {
    const rows = document.querySelectorAll('tbody tr');
    if (rows.length === 0) return;
    
    rows.forEach(row => {
        row.addEventListener('mouseenter', () => {
            row.style.transform = 'scale(1.01)';
            row.style.transition = 'transform 0.2s ease';
        });
        row.addEventListener('mouseleave', () => {
            row.style.transform = 'scale(1)';
        });
    });
}

// ============================================
// MODULE 6 : AFFICHAGE/MASQUAGE MOT DE PASSE
// ============================================
function initPasswordToggle() {
    const toggleButtons = document.querySelectorAll('.password-toggle');
    if (toggleButtons.length === 0) return;
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            if (passwordInput && passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else if (passwordInput) {
                passwordInput.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
}

// ============================================
// MODULE 7 : VALIDATION DES FORMULAIRES
// ============================================
function initFormValidation() {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const email = document.getElementById('loginEmail');
            const password = document.getElementById('loginPassword');
            
            if (!email.value.trim()) {
                e.preventDefault();
                alert('Veuillez entrer votre email');
                return false;
            }
            if (!validateEmail(email.value)) {
                e.preventDefault();
                alert('Veuillez entrer un email valide');
                return false;
            }
            if (!password.value.trim()) {
                e.preventDefault();
                alert('Veuillez entrer votre mot de passe');
                return false;
            }
        });
    }
}

function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}

// ============================================
// MODULE 8 : INTERACTIONS DES BOUTONS
// ============================================
function initButtonInteractions() {
    document.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (btn.id === 'themeToggle' || btn.id === 'menuToggleBtn' || btn.id === 'closeMenuBtn') {
                return;
            }
            if (btn.closest('form')) {
                return;
            }
            const btnText = btn.innerText.trim();
            if (btnText && btnText.length < 30 && !btnText.includes('×')) {
                console.log('[DÉMO] ' + btnText);
            }
        });
    });
}