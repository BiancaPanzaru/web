<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/admin.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
      <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">User Management</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="logout.php">Log Out</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">Add New</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Caută utilizatori...">
    </div>
    <div class="container my-4"> 

    <table class="table" id="userTable">
        <thead>
            <tr>
                <th data-column="0">ID<span class="sort-indicator"></span></th>
                <th data-column="1">Nume<span class="sort-indicator"></span></th>
                <th data-column="2">Email<span class="sort-indicator"></span></th>
                <th data-column="4">Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            <?php
               include "connection.php";
               $sql = "select * from users";
               $result = $conn->query($sql);
               if(!$result){
                die("Invalid query");
               }
               while($row=$result->fetch_assoc()){
                echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[fullname]</td>
                    <td>$row[username]</td>
                    <td>
                        <a class='btn btn-succes' href='edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-succes' href='delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>";
             }
            ?>
        </tbody>
    </table>
            </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('userTable');
            const headers = table.querySelectorAll('th');

            headers.forEach(header => {
                header.addEventListener('click', () => {
                    const column = header.dataset.column;
                    const direction = header.dataset.direction || 'asc';
                    const newDirection = direction === 'asc' ? 'desc' : 'asc';

                    // Remove sort indicators from other columns
                    headers.forEach(h => {
                        if (h !== header) {
                            h.classList.remove('asc', 'desc');
                        }
                        delete h.dataset.direction;
                    });

                    header.classList.remove('asc', 'desc');
                    header.classList.add(newDirection);
                    header.setAttribute('data-direction', newDirection);

                    const sortedRows = Array.from(table.rows).slice(1).sort((rowA, rowB) => {
                        const valueA = rowA.cells[column].textContent.trim();
                        const valueB = rowB.cells[column].textContent.trim();

                        return direction === 'asc' ? valueA.localeCompare(valueB) : valueB.localeCompare(valueA);
                    });

                    while (table.rows.length > 1) {
                        table.deleteRow(1);
                    }

                    table.append(...sortedRows);
                });
            });
        });

        // Funcție pentru căutarea live a utilizatorilor
        document.getElementById('searchInput').addEventListener('input', function () {
            const input = this.value.toUpperCase();
            const table = document.getElementById('userTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;
                for (let j = 0; j < cells.length; j++) {
                    const cellValue = cells[j].textContent.toUpperCase();
                    if (cellValue.indexOf(input) > -1) {
                        found = true;
                        break;
                    }
                }
                if (found) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
