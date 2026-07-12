document.addEventListener('DOMContentLoaded', async () => {
    const searchInput = document.getElementById('pokedex_search_input');
    const searchDropdown = document.getElementById('pokedex_dropdown_list');
    const searchForm = document.getElementById('pokedex_search_form');

    if (!searchInput || !searchDropdown) return;

    let pokemonList = [];

    try {
        const response = await fetch('https://pokeapi.co/api/v2/pokemon?limit=1025');
        const data = await response.json();
        
        pokemonList = data.results.map(poke => {
            return poke.name.charAt(0).toUpperCase() + poke.name.slice(1);
        });
    } catch (error) {
        console.error('Błąd pobierania bazy z PokeAPI:', error);
    }

    const renderDropdown = (filterText = '') => {
        searchDropdown.innerHTML = ''; 
        
        const filtered = pokemonList.filter(name => name.toLowerCase().startsWith(filterText));
        
        if (filtered.length === 0 || filterText === '') {
            searchDropdown.classList.add('d-none');
            return;
        }

        searchDropdown.classList.remove('d-none');

        filtered.slice(0, 50).forEach(pokeName => {
            const item = document.createElement('div');
            item.className = 'dropdown-item-poke';
            item.textContent = pokeName;
            
            item.addEventListener('click', () => {
                searchInput.value = pokeName; 
                searchDropdown.classList.add('d-none'); 
                
                if (searchForm) {
                    searchForm.submit();
                }
            });
            
            searchDropdown.appendChild(item);
        });
    };

    searchInput.addEventListener('input', (e) => {
        renderDropdown(e.target.value.toLowerCase());
    });

    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
            searchDropdown.classList.add('d-none');
        }
    });
});