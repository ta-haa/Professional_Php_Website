<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj Paneli</title> 
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

        .filter .status-message {
            margin-left: 10px;
            font-size: 14px;
            color: var(--textSoft);
        }

        /* Table CSS */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            cursor: pointer;
            position: relative;
            padding: 10px;
            background-color: #f8f9fa;
            color: var(--textSoft);
            border: 1px solid var(--borderColor);
        }

        th.sort-asc::after,
        th.sort-desc::after {
            content: '';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
        }

        th.sort-asc::after {
            border-bottom: 5px solid var(--textSoft);
        }

        th.sort-desc::after {
            border-top: 5px solid var(--textSoft);
        }

        td {
            padding: 10px;
            border: 1px solid var(--borderColor);
        }

        .btndeletemesaj {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btndeletemesaj:hover {
            background-color: #c82333;
        }
    </style>

 
</head>

<body>
<div class="container">
    <!-- Mesajlar Bölümü -->
    <!-- BURDAKİ DİVLER ADMİNPANEL.PHP KISMINDA -->
    <table id="messageTable">
        <thead>
            <tr>
                <th data-column="id" data-order="asc" onclick="sortTableMessage(this)">ID</th>
                <th data-column="name" data-order="asc" onclick="sortTableMessage(this)">Name</th>
                <th data-column="sender" data-order="asc" onclick="sortTableMessage(this)">Sender</th>
                <th data-column="message" data-order="asc" onclick="sortTableMessage(this)">Message</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP ile oluşturulmuş tablo verileri buraya gelecek -->
            <?php
                include("../../connect.php");

                $sql = "SELECT * FROM donercontact";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['contactid']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['contactad']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['contactemail']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['contactmesaj']) . '</td>';
                        echo '<td>';
                        echo '<form method="POST" action="mesajsil.php" style="display:inline;">'; 
                        echo "<input type='hidden' value='" . htmlspecialchars($row['contactid']) . "' name='txtmesajsil'>";
                        echo '<button type="submit" name="btnmesajsil" class="btndeletemesaj">Sil</button>'; 
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>'; 
                    }
                } else {
                    echo '<tr><td colspan="5">Mesaj bulunamadı.</td></tr>';
                }

                $con->close();
            ?>
        </tbody>
    </table>
</div>

























 
<script>
///AŞAĞIDAKİ SCRİPT KISIMLARI BOŞSA İŞLEV ETKİLEMİYOSA SİL GİTSİN
/*
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
    switch(column) {
        case 'id': return 1;
        case 'name': return 2;
        case 'sender': return 3;
        case 'message': return 4;
        default: return 1;
    }
}*/
</script>
<script>
/*
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

*/
</script>



</body>
</html>
