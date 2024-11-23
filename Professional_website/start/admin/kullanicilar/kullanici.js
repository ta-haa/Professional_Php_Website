//////////////////////ADMİNPANEL.PHP BU KISIMDAKİ KODLARI ÇEKİYOR////////////////////////

// Kullanicilar Bölümü JavaScript ///////////////ASC DESC///////////////
document.getElementById('user-filter-button').addEventListener('click', function () {
    let id = document.getElementById('user-id').value;
    let email = document.getElementById('user-email').value;
    let verification = document.getElementById('user-verification').value;
    let ipAddress = document.getElementById('user-ip-address').value;
    let registrationDate = document.getElementById('user-registration-date').value;

    console.log({ id, email, verification, ipAddress, registrationDate });
});

function sortTableUser(header) {
    const table = document.getElementById('userTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const column = header.getAttribute('data-column');
    const order = header.getAttribute('data-order');
    const newOrder = order === 'asc' ? 'desc' : 'asc';

    rows.sort((a, b) => {
        const aText = a.querySelector(`td:nth-child(${getColumnIndexUser(column)})`).textContent.trim();
        const bText = b.querySelector(`td:nth-child(${getColumnIndexUser(column)})`).textContent.trim();

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

function getColumnIndexUser(column) {
    switch (column) {
        case 'id': return 1;
        case 'email': return 2;
        case 'sifre': return 3;
        case 'token': return 4;
        case 'captcha': return 5;
        case 'captchaexpiry': return 6;
        case 'verification': return 7;
        case 'ipaddress': return 8;
        case 'kayit': return 9;
        default: return 1;
    }
}
// Kullanicilar Bölümü JavaScript ///////////////FİLTER KISMI///////////////
document.getElementById('user-filter-button').addEventListener('click', function () {
    let id = document.getElementById('user-id').value.trim().toLowerCase();
    let email = document.getElementById('user-email').value.trim().toLowerCase();
    let verification = document.getElementById('user-verification').value;
    let ipAddress = document.getElementById('user-ip-address').value.trim().toLowerCase();
    let registrationDate = document.getElementById('user-registration-date').value;
    const kullanicistatusMessage = document.getElementById('user-status-message');

    const table = document.getElementById('userTable');
    const rows = table.querySelectorAll('tbody tr');

    let visibleRows = 0;

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const cellId = cells[0].textContent.trim().toLowerCase();
        const cellEmail = cells[1].textContent.trim().toLowerCase();
        const cellVerification = cells[6].textContent.trim().toLowerCase();
        const cellIp = cells[7].textContent.trim().toLowerCase();
        const cellRegistrationDate = cells[8].textContent.trim().split(' ')[0]; // only date part

        const matchesId = id === '' || cellId.includes(id);
        const matchesEmail = email === '' || cellEmail.includes(email);
        const matchesVerification = verification === '' || cellVerification.includes(verification);
        const matchesIp = ipAddress === '' || cellIp.includes(ipAddress);

        let matchesRegistrationDate = true;
        if (registrationDate) {
            const [inputYear, inputMonth, inputDay] = registrationDate.split('-');
            const inputFormattedDate = `${inputYear}-${inputMonth}-${inputDay}`;
            matchesRegistrationDate = cellRegistrationDate === inputFormattedDate;
        }

        if (matchesId && matchesEmail && matchesVerification && matchesIp && matchesRegistrationDate) {
            row.style.display = '';
            visibleRows++;
        } else {
            row.style.display = 'none';
        }
    });


    kullanicistatusMessage.textContent = visibleRows > 0 ? `${visibleRows} sonuç bulundu.` : 'Sonuç bulunamadı.';
});

document.getElementById('user-clear-button').addEventListener('click', () => {
    document.getElementById('user-id').value = '';
    document.getElementById('user-email').value = '';
    document.getElementById('user-verification').value = '';
    document.getElementById('user-ip-address').value = '';
    document.getElementById('user-registration-date').value = '';

    const table = document.getElementById('userTable');
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach(row => row.style.display = '');

    const kullanicistatusMessage = document.getElementById('user-status-message');
    kullanicistatusMessage.textContent = '';
});

function sortTableUser(header) {
    const table = header.closest('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const column = header.getAttribute('data-column');
    const order = header.getAttribute('data-order') === 'asc' ? 'desc' : 'asc';

    rows.sort((a, b) => {
        const cellA = a.querySelector(`td:nth-child(${header.cellIndex + 1})`).textContent.trim();
        const cellB = b.querySelector(`td:nth-child(${header.cellIndex + 1})`).textContent.trim();

        if (order === 'asc') {
            return cellA.localeCompare(cellB, 'tr', { numeric: true });
        } else {
            return cellB.localeCompare(cellA, 'tr', { numeric: true });
        }
    });

    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));

    table.querySelectorAll('th').forEach(th => th.classList.remove('sort-asc', 'sort-desc'));
    header.classList.add(order === 'asc' ? 'sort-asc' : 'sort-desc');
    header.setAttribute('data-order', order);
} 