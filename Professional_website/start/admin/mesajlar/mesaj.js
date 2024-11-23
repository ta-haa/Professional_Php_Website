//////////////////////ADMİNPANEL.PHP BU KISIMDAKİ KODLARI ÇEKİYOR////////////////////////

// Mesajlar Bölümü JavaScript ///////////////ASC DESC///////////////
document.addEventListener('DOMContentLoaded', () => {
    const idInput = document.getElementById('message-id');
    const adInput = document.getElementById('message-ad');
    const gonderenInput = document.getElementById('message-gonderen');
    const mesajInput = document.getElementById('message-mesaj');
    const filterButton = document.getElementById('message-filter-button');

    filterButton.addEventListener('click', () => {
        const id = idInput.value;
        const ad = adInput.value;
        const gonderen = gonderenInput.value;
        const mesaj = mesajInput.value;

        console.log({
            id,
            ad,
            gonderen,
            mesaj
        });
    });
});

function sortTableMessage(header) {
    const table = document.getElementById('messageTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const column = header.getAttribute('data-column');
    const order = header.getAttribute('data-order');
    const newOrder = order === 'asc' ? 'desc' : 'asc';

    rows.sort((a, b) => {
        const aText = a.querySelector(`td:nth-child(${getColumnIndexMessage(column)})`).textContent.trim();
        const bText = b.querySelector(`td:nth-child(${getColumnIndexMessage(column)})`).textContent.trim();

        if (column === 'id') {
            return (newOrder === 'asc' ? aText - bText : bText - aText);
        } else {
            return (newOrder === 'asc' ? aText.localeCompare(bText) : bText.localeCompare(aText));
        }
    });

    rows.forEach(row => tbody.appendChild(row));
    header.setAttribute('data-order', newOrder);

    document.querySelectorAll('th').forEach(th => th.classList.remove('sort-asc', 'sort-desc'));
    header.classList.add(`sort-${newOrder}`);
}

function getColumnIndexMessage(column) {
    switch (column) {
        case 'id': return 1;
        case 'name': return 2;
        case 'sender': return 3;
        case 'message': return 4;
        default: return 1;
    }
}

// Mesajlar Bölümü JavaScript ///////////////FİLTER KISMI///////////////
document.addEventListener('DOMContentLoaded', () => {
    const idInput = document.getElementById('message-id');
    const adInput = document.getElementById('message-ad');
    const gonderenInput = document.getElementById('message-gonderen');
    const mesajInput = document.getElementById('message-mesaj');
    const filterButton = document.getElementById('message-filter-button');
    const clearButton = document.getElementById('clear-filter-button');
    const statusMessage = document.getElementById('status-message');

    filterButton.addEventListener('click', () => {
        const id = idInput.value.toLowerCase();
        const ad = adInput.value.toLowerCase();
        const gonderen = gonderenInput.value.toLowerCase();
        const mesaj = mesajInput.value.toLowerCase();

        const table = document.getElementById('messageTable');
        const rows = table.querySelectorAll('tbody tr');

        let visibleRows = 0;

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const cellId = cells[0].textContent.toLowerCase();
            const cellAd = cells[1].textContent.toLowerCase();
            const cellGonderen = cells[2].textContent.toLowerCase();
            const cellMesaj = cells[3].textContent.toLowerCase();

            const matchesId = cellId.includes(id);
            const matchesAd = cellAd.includes(ad);
            const matchesGonderen = cellGonderen.includes(gonderen);
            const matchesMesaj = cellMesaj.includes(mesaj);

            if (matchesId && matchesAd && matchesGonderen && matchesMesaj) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        statusMessage.textContent = visibleRows > 0 ? `${visibleRows} sonuç bulundu.` : 'Sonuç bulunamadı.';
    });

    clearButton.addEventListener('click', () => {
        idInput.value = '';
        adInput.value = '';
        gonderenInput.value = '';
        mesajInput.value = '';

        // Show all rows
        const table = document.getElementById('messageTable');
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => row.style.display = '');

        statusMessage.textContent = '';
    });
});

