document.addEventListener('DOMContentLoaded', async () => {
    const input = document.getElementById('pokemon_name');
    const sprite = document.getElementById('pokemon_sprite');
    const dropdown = document.getElementById('custom_pokemon_list');
    
    let pokemonList = [];
    let pokemonMap = {};

    try {
        const response = await fetch('https://pokeapi.co/api/v2/pokemon?limit=1025');
        const data = await response.json();
        
        data.results.forEach((poke) => {
            const urlParts = poke.url.split('/');
            const id = urlParts[urlParts.length - 2];
            const nameCapitalized = poke.name.charAt(0).toUpperCase() + poke.name.slice(1);
            
            pokemonList.push({ name: nameCapitalized, id: id });
            pokemonMap[poke.name.toLowerCase()] = id;
        });
    } catch (error) {
        console.error('Błąd pobierania bazy z PokeAPI:', error);
    }

    // Funkcja do rysowania listy
    const renderDropdown = (filterText = '') => {
        dropdown.innerHTML = ''; 
        // Szukamy Pokemonów, które ZACZYNAJĄ SIĘ od wpisanych liter
        const filtered = pokemonList.filter(p => p.name.toLowerCase().startsWith(filterText));
        
        if (filtered.length === 0 || filterText === '') {
            dropdown.classList.add('d-none');
            return;
        }

        dropdown.classList.remove('d-none');

        // Renderujemy tylko max 50 wyników na raz, żeby przeglądarka nie zwalniała
        filtered.slice(0, 50).forEach(poke => {
            const item = document.createElement('div');
            item.className = 'dropdown-item-poke';
            item.textContent = poke.name;
            
            // Co się dzieje po kliknięciu na liście?
            item.addEventListener('click', () => {
                input.value = poke.name; // Wpisujemy nazwę do inputa
                dropdown.classList.add('d-none'); // Ukrywamy listę
                sprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/${poke.id}.png`; // Ładujemy obrazek
            });
            
            dropdown.appendChild(item);
        });
    };

    // Nasłuchiwanie wpisywania
    input.addEventListener('input', (e) => {
        const typedName = e.target.value.toLowerCase();
        renderDropdown(typedName);
        
        if (pokemonMap[typedName]) {
            sprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/${pokemonMap[typedName]}.png`;
        } else {
            sprite.src = ""; 
        }
    });

    // Ukrywanie listy, jak gracz kliknie gdzieś indziej na stronie
    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('d-none');
        }
    });
});