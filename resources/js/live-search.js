document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('user_search_input');
    const searchDropdown = document.getElementById('user_search_dropdown');

    if (!searchInput || !searchDropdown) return;

    searchInput.addEventListener('input', async (e) => {
        const query = e.target.value.trim();

        if (query.length < 2) {
            searchDropdown.classList.remove('show');
            searchDropdown.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(`/search/live?query=${query}`);
            const users = await response.json();

            searchDropdown.innerHTML = ''; 

            if (users.length === 0) {
                searchDropdown.innerHTML = '<div class="dropdown-item text-secondary bg-dark disabled">No players found</div>';
                searchDropdown.classList.add('show');
                return;
            }

            users.forEach(user => {
                const link = document.createElement('a');
                link.href = `/user/${user.username}`; 
                link.className = 'dropdown-item text-poke-light bg-dark border-bottom border-secondary py-2';
                link.textContent = user.username;
                
                link.addEventListener('mouseover', () => link.style.backgroundColor = '#343a40');
                link.addEventListener('mouseout', () => link.style.backgroundColor = '');

                searchDropdown.appendChild(link);
            });

            searchDropdown.classList.add('show');
        } catch (error) {
            console.error('Błąd wyszukiwania Live Search:', error);
        }
    });

    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
            searchDropdown.classList.remove('show');
        }
    });
});