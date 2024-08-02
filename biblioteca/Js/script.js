document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('search-input').addEventListener('keyup', e => {
        const searchValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const titulo = row.querySelector(".titulo").textContent.toLowerCase();
            const autor = row.querySelector(".autor").textContent.toLowerCase();

            if (titulo.includes(searchValue) || autor.includes(searchValue) || searchValue === '') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('search-input').addEventListener('keyup', e => {
        const searchValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const nombre = row.querySelector(".nombre").textContent.toLowerCase();
            const apellido = row.querySelector(".apellido").textContent.toLowerCase();

            if (nombre.includes(searchValue) || apellido.includes(searchValue) || searchValue === '') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('search-input').addEventListener('keyup', e => {
        const searchValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const titulo = row.querySelector(".titulo").textContent.toLowerCase();
            const autor = row.querySelector(".autor").textContent.toLowerCase();

            if (titulo.includes(searchValue) || autor.includes(searchValue) || searchValue === '') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});