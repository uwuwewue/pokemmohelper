document.addEventListener('DOMContentLoaded', async () => {
    const input = document.getElementById('pokemon_name');
    const sprite = document.getElementById('pokemon_sprite');
    const dropdown = document.getElementById('custom_pokemon_list');
    const dateInput = document.getElementById('catch_date');
    
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

    const renderDropdown = (filterText = '') => {
        dropdown.innerHTML = ''; 
        
        const filtered = pokemonList.filter(p => p.name.toLowerCase().startsWith(filterText));
        
        if (filtered.length === 0 || filterText === '') {
            dropdown.classList.add('d-none');
            return;
        }

        dropdown.classList.remove('d-none');

        filtered.slice(0, 50).forEach(poke => {
            const item = document.createElement('div');
            item.className = 'dropdown-item-poke';
            item.textContent = poke.name;
            
            item.addEventListener('click', () => {
                input.value = poke.name; 
                dropdown.classList.add('d-none'); 
                sprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/${poke.id}.png`; 
            });
            
            dropdown.appendChild(item);
        });
    };

    input.addEventListener('input', (e) => {
        const typedName = e.target.value.toLowerCase();
        renderDropdown(typedName);
        
        if (pokemonMap[typedName]) {
            sprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/${pokemonMap[typedName]}.png`;
        } else {
            sprite.src = ""; 
        }
    });

    const natureInput = document.getElementById('nature');
    const natureDropdown = document.getElementById('custom_nature_list');
    
    const natureList = [
        'Adamant', 'Bashful', 'Bold', 'Brave', 'Calm', 
        'Careful', 'Docile', 'Gentle', 'Hardy', 'Hasty', 
        'Impish', 'Jolly', 'Lax', 'Lonely', 'Mild', 
        'Modest', 'Naive', 'Naughty', 'Quiet', 'Quirky', 
        'Rash', 'Relaxed', 'Sassy', 'Serious', 'Timid'
    ];

    const renderNatureDropdown = (filterText = '') => {
        if (!natureDropdown) return;
        
        natureDropdown.innerHTML = ''; 
        
        const filtered = natureList.filter(n => n.toLowerCase().startsWith(filterText));
        
        if (filtered.length === 0) {
            natureDropdown.classList.add('d-none');
            return;
        }

        natureDropdown.classList.remove('d-none');

        filtered.forEach(nature => {
            const item = document.createElement('div');
            item.className = 'dropdown-item-poke'; 
            item.textContent = nature;
            
            item.addEventListener('click', () => {
                natureInput.value = nature;
                natureDropdown.classList.add('d-none');
            });
            
            natureDropdown.appendChild(item);
        });
    };

    if (natureInput) {
        natureInput.addEventListener('input', (e) => {
            renderNatureDropdown(e.target.value.toLowerCase());
        });

        natureInput.addEventListener('focus', (e) => {
            renderNatureDropdown(e.target.value.toLowerCase());
        });
    }

    document.addEventListener('click', (e) => {
        if (input && dropdown && !input.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('d-none');
        }
        if (natureInput && natureDropdown && !natureInput.contains(e.target) && !natureDropdown.contains(e.target)) {
            natureDropdown.classList.add('d-none');
        }
    });

    if (dateInput) {
        dateInput.addEventListener('input', (e) => {
            const selectedDate = e.target.value;
            const minDate = dateInput.getAttribute('min');
            const maxDate = dateInput.getAttribute('max');

            if (selectedDate) {
                if (selectedDate < minDate || selectedDate > maxDate) {
                    dateInput.classList.add('is-invalid');
                } else {
                    dateInput.classList.remove('is-invalid');
                }
            } else {
                dateInput.classList.remove('is-invalid');
            }
        });
    }

});