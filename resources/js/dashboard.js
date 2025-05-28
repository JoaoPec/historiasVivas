document.addEventListener('DOMContentLoaded', function() {
    // Botões dos dropdowns
    const filtersButton = document.querySelector('.filters-button');
    const sortButton = document.querySelector('.sort-button');
    const filtersDropdown = document.querySelector('.filters-dropdown');
    const sortDropdown = document.querySelector('.sort-dropdown');

    // Função para alternar visibilidade do dropdown
    function toggleDropdown(dropdown, otherDropdown) {
        dropdown.classList.toggle('hidden');
        if (otherDropdown) {
            otherDropdown.classList.add('hidden');
        }
    }

    // Event listeners para os botões
    filtersButton.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        toggleDropdown(filtersDropdown, sortDropdown);
    });

    sortButton.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        toggleDropdown(sortDropdown, filtersDropdown);
    });

    // Fechar dropdowns quando clicar fora
    document.addEventListener('click', function(e) {
        if (!filtersButton.contains(e.target) && !filtersDropdown.contains(e.target)) {
            filtersDropdown.classList.add('hidden');
        }
        if (!sortButton.contains(e.target) && !sortDropdown.contains(e.target)) {
            sortDropdown.classList.add('hidden');
        }
    });

    // Event listeners para os inputs dos dropdowns
    const filterInputs = filtersDropdown.querySelectorAll('input');
    const sortInputs = sortDropdown.querySelectorAll('input');

    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            setTimeout(() => {
                document.querySelector('form').submit();
            }, 100);
        });
    });

    sortInputs.forEach(input => {
        input.addEventListener('change', function() {
            setTimeout(() => {
                document.querySelector('form').submit();
            }, 100);
        });
    });
}); 