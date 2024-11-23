<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        :root {
            --bgSoft: #f0f0f0;
            --textSoft: #333;
            --borderColor: #ccc;
            --focusBorderColor: #007bff;
            --placeholderColor: #999;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--textSoft);
            background-color: var(--bgSoft);
        }

        .container {
            padding: 20px;
            max-width: 84.8vw;
            margin: 0 auto;
        }

        .header {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            background-color: #ffffff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header .title {
            margin: 0;
            font-weight: 200;
            color: var(--textSoft);
            flex: 1 1 auto;
        }

        .filter {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            width: 100%;
        }

        .form-group {
            position: relative;
            width: 150px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 8px;
            box-sizing: border-box;
            border: 1px solid var(--borderColor);
            border-radius: 4px;
            outline: none;
            font-size: 14px;
            background-color: transparent;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--focusBorderColor);
            box-shadow: 0 1px 0 0 var(--focusBorderColor);
        }

        .form-group input::placeholder,
        .form-group select::placeholder {
            color: transparent;
        }

        .form-group .label {
            position: absolute;
            top: 12px;
            left: 8px;
            font-size: 14px;
            color: var(--placeholderColor);
            pointer-events: none;
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .form-group input:focus ~ .label,
        .form-group select:focus ~ .label,
        .form-group input:not(:placeholder-shown) ~ .label,
        .form-group select:not(:placeholder-shown) ~ .label {
            top: -10px;
            left: 8px;
            font-size: 12px;
            color: var(--focusBorderColor);
            background-color: #fff;
            padding: 0 4px;
            transform: translateY(0);
        }

        .form-group input:focus ~ .underline,
        .form-group select:focus ~ .underline {
            width: 100%;
            background-color: var(--focusBorderColor);
        }

        .underline {
            height: 2px;
            width: 0;
            background-color: var(--borderColor);
            transition: width 0.3s ease;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .filter button {
            padding: 8px 12px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }
        .filter button:hover {
            background-color: #0056b3;
        }
        .filter button.clear-filter {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px; 
        }

        .filter button.clear-filter:hover {
            background-color: #5a6268;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--borderColor);
        }

        th {
            cursor: pointer;
            position: relative;
        }

        .sort-asc::after {
            content: "▲";
            position: absolute;
            right: 8px;
            top: 12px;
        }

        .sort-desc::after {
            content: "▼";
            position: absolute;
            right: 8px;
            top: 12px;
        }
    </style>
</head>
<body>
    <!-- Kullanıcılar Bölümü -->
    <div class="container">
            <!-- Kullanıcılar Bölümü -->
    <!-- BURDAKİ DİVLER ADMİNPANEL.PHP KISMINDA -->
        

        <table id="userTable" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th data-column="id" data-order="asc" onclick="sortTableUser(this)">ID</th>
                    <th data-column="email" data-order="asc" onclick="sortTableUser(this)">Email</th>
                    <th data-column="sifre" data-order="asc" onclick="sortTableUser(this)">Şifre</th>
                    <th data-column="token" data-order="asc" onclick="sortTableUser(this)">Token</th>
                    <th data-column="captcha" data-order="asc" onclick="sortTableUser(this)">Captcha</th>
                    <th data-column="captchaexpiry" data-order="asc" onclick="sortTableUser(this)">Captcha Expiry</th>
                    <th data-column="verification" data-order="asc" onclick="sortTableUser(this)">Verification</th>
                    <th data-column="ipaddress" data-order="asc" onclick="sortTableUser(this)">IP Address</th>
                    <th data-column="kayit" data-order="asc" onclick="sortTableUser(this)">Kayıt</th>
                    <th data-column="yetki" data-order="asc" onclick="sortTableUser(this)">Yetki</th>  
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../../connect.php");

                    $sql = "SELECT * FROM doner";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['eposta']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['sifre']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['token']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['captcha']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['captchaexpiry']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['verification']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ipaddress']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['kayit']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['yetki']) . '</td>';
                            echo '<td>'; 
                            //kullanıcı sil formu
                            echo '<form method="POST" action="javascript:void(0);" class="delete-user-form" data-id="' . htmlspecialchars($row['id']) . '">';
                            echo '<button type="submit" class="btndeletekullanici">Sil</button>';
                            echo '</form>';
                            //yetki formu
                            echo '<form method="POST" action="javascript:void(0);" class="yetki-user-form" data-id="' . htmlspecialchars($row['id']) . '">';
                            echo '<button type="submit" class="btnyetki">Yetki Ver</button>';
                            echo '</form>';

                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='10'>Kullanıcı mevcut değil.</td></tr>";
                    }

                    $con->close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
document.getElementById('user-filter-button').addEventListener('click', function() {
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
    switch(column) {
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
</script>  
































<script>
///AŞAĞIDAKİ SCRİPT KISIMLARI BOŞSA İŞLEV ETKİLEMİYOSA SİL GİTSİN
        document.getElementById('user-filter-button').addEventListener('click', function() {
            let id = document.getElementById('user-id').value.trim().toLowerCase();
            let email = document.getElementById('user-email').value.trim().toLowerCase();
            let verification = document.getElementById('user-verification').value;
            let ipAddress = document.getElementById('user-ip-address').value.trim().toLowerCase();
            let registrationDate = document.getElementById('user-registration-date').value;

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

            const statusMessage = document.getElementById('user-status-message');
            statusMessage.textContent = visibleRows > 0 ? `${visibleRows} sonuç bulundu.` : 'Sonuç bulunamadı.';
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

            const statusMessage = document.getElementById('user-status-message');
            statusMessage.textContent = '';
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
    </script>
</body>
</html> 