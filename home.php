<?php
require_once('Database.php');
require_once('Form.php');


// buat instance class Database
$db = new Database('localhost', 'root', '', 'latihan3');

// ambil data dari database
$query = "SELECT * FROM users";
$result = $db->query($query);


$no = 1;

require_once('header.php')
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modularisasi dengan Class Library</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Modularisasi dengan Class Library</h1>
        <br>
        <br>
        <h2>Data User</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // menampilkan data dari database ke dalam tabel
                foreach ($result as $row) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// menutup koneksi database
$db->close();

require_once('footer.php')
?>