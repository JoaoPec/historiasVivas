document.addEventListener('DOMContentLoaded', function () {
    // Verificar se os elementos existem antes de adicionar event listeners
    // O dashboard usa Alpine.js para controlar os dropdowns, então este código
    // só é necessário se os elementos existirem e não estiverem sendo controlados pelo Alpine

    const filtersButton = document.querySelector('.filters-button');
    const sortButton = document.querySelector('.sort-button');
    const filtersDropdown = document.querySelector('.filters-dropdown');
    const sortDropdown = document.querySelector('.sort-dropdown');

    // Se os elementos não existirem, não faz nada (Alpine.js está controlando)
    if (!filtersButton && !sortButton) {
        return;
    }

    // Função para alternar visibilidade do dropdown
    function toggleDropdown(dropdown, otherDropdown) {
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
        if (otherDropdown) {
            otherDropdown.classList.add('hidden');
        }
    }

    // Event listeners para os botões (apenas se existirem)
    if (filtersButton && filtersDropdown) {
        filtersButton.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleDropdown(filtersDropdown, sortDropdown);
        });
    }

    if (sortButton && sortDropdown) {
        sortButton.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleDropdown(sortDropdown, filtersDropdown);
        });
    }

    // Fechar dropdowns quando clicar fora (apenas se os elementos existirem)
    if (filtersButton && filtersDropdown) {
        document.addEventListener('click', function (e) {
            if (!filtersButton.contains(e.target) && !filtersDropdown.contains(e.target)) {
                filtersDropdown.classList.add('hidden');
            }
        });
    }

    if (sortButton && sortDropdown) {
        document.addEventListener('click', function (e) {
            if (!sortButton.contains(e.target) && !sortDropdown.contains(e.target)) {
                sortDropdown.classList.add('hidden');
            }
        });
    }

    // Event listeners para os inputs dos dropdowns (apenas se existirem)
    if (filtersDropdown) {
        const filterInputs = filtersDropdown.querySelectorAll('input');
        filterInputs.forEach(input => {
            input.addEventListener('change', function () {
                setTimeout(() => {
                    const form = document.querySelector('form');
                    if (form) {
                        form.submit();
                    }
                }, 100);
            });
        });
    }

    if (sortDropdown) {
        const sortInputs = sortDropdown.querySelectorAll('input');
        sortInputs.forEach(input => {
            input.addEventListener('change', function () {
                setTimeout(() => {
                    const form = document.querySelector('form');
                    if (form) {
                        form.submit();
                    }
                }, 100);
            });
        });
    }
}); 