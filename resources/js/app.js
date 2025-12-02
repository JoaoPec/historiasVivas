import './bootstrap';
import './dashboard';

import Alpine from 'alpinejs';

// Garantir que Alpine está disponível globalmente
window.Alpine = Alpine;

// Flag para controlar se o Alpine já foi iniciado
let alpineStarted = false;

// Função para iniciar o Alpine de forma segura
function startAlpine() {
    if (!alpineStarted && window.Alpine) {
        try {
            Alpine.start();
            alpineStarted = true;
            console.log('Alpine.js iniciado');
        } catch (e) {
            console.error('Erro ao iniciar Alpine:', e);
        }
    }
}

// Iniciar Alpine quando o DOM estiver pronto
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        startAlpine();
    });
} else {
    // DOM já está pronto
    startAlpine();
}

// Reinicializar Alpine quando a página for carregada (útil para navegação)
window.addEventListener('load', () => {
    if (window.Alpine && alpineStarted) {
        // O Alpine automaticamente processa novos elementos quando detecta mudanças
        // Mas podemos garantir que está funcionando verificando se há elementos x-data
        try {
            const alpineElements = document.querySelectorAll('[x-data]');
            if (alpineElements.length > 0) {
                // Verificar se os elementos foram processados
                alpineElements.forEach(el => {
                    if (!el.__x) {
                        // Elemento não foi processado pelo Alpine
                        // O Alpine deve processar automaticamente, mas podemos forçar
                        // removendo e adicionando o atributo x-data temporariamente
                        const xData = el.getAttribute('x-data');
                        if (xData) {
                            el.removeAttribute('x-data');
                            // Forçar reflow
                            void el.offsetHeight;
                            el.setAttribute('x-data', xData);
                        }
                    }
                });
            }
        } catch (e) {
            console.error('Erro ao verificar elementos Alpine:', e);
        }
    }
});

// Reinicializar quando a página voltar do cache (back/forward navigation)
window.addEventListener('pageshow', (event) => {
    if (event.persisted && window.Alpine && alpineStarted) {
        // Página foi carregada do cache do navegador
        console.log('Página carregada do cache, verificando Alpine...');
        // O Alpine deve processar automaticamente, mas garantimos que está funcionando
        setTimeout(() => {
            const alpineElements = document.querySelectorAll('[x-data]');
            console.log(`Encontrados ${alpineElements.length} elementos com x-data`);
        }, 100);
    }
});

// Debug: verificar se Alpine foi carregado
if (typeof window.Alpine === 'undefined') {
    console.error('Alpine.js não foi carregado corretamente!');
} else {
    console.log('Alpine.js carregado com sucesso, versão:', Alpine.version || 'desconhecida');
}
