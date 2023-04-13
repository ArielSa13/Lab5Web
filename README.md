# Tugas Program Lab 5 Web (Modularisasi)

## Membuat form.php

```php
<?php

class Form
{
    public function input($name, $label)
    {
        return "<div class='form-group'>
                    <label for='$name'>$label</label>
                    <input type='text' class='form-control' name='$name' id='$name'>
                </div>";
    }

    public function submit($label)
    {
        return "<button type='submit' class='btn btn-primary'>$label</button>";
    }
}


```

<br>

- Sintaks yang diberikan pada kelas Form di atas pada file form.php digunakan untuk membentuk elemen form pada halaman web. Kelas Form ini mengandung dua metode yaitu input dan submit.

- Dengan menggunakan kelas Form ini, elemen form pada halaman web dapat dibuat dengan lebih mudah dan cepat. Kelas ini juga memudahkan pengembangan aplikasi web yang kompleks dengan mengurangi jumlah kode yang harus ditulis dan mempercepat proses pengembangan aplikasi.

<br>
<br>

## Membuat database.php

```php
<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        // membuat koneksi
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // cek apakah koneksi berhasil
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($query)
    {
        // melakukan query ke database
        $result = $this->conn->query($query);

        // cek apakah query berhasil
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        // mengembalikan hasil query dalam bentuk array
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function insert($table, $data)
    {
        // memformat data untuk dimasukkan ke database
        $columns = implode(",", array_keys($data));
        $values = implode("','", array_values($data));
        $query = "INSERT INTO $table ($columns) VALUES ('$values')";

        // melakukan query ke database
        $result = $this->conn->query($query);

        // cek apakah query berhasil
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }
    }

    public function close()
    {
        // menutup koneksi
        $this->conn->close();
    }
}

```

<br>
<br>

- File database.php pada kode program tersebut berfungsi sebagai class library untuk melakukan koneksi ke database MySQL dan menjalankan query. Dalam file ini terdapat kelas Database yang memiliki metode-metode untuk melakukan operasi pada database seperti menjalankan query dan mengambil data dari hasil query.

- Dengan adanya kelas Database, kita bisa dengan mudah membuat koneksi ke database dan menjalankan query pada database MySQL tanpa perlu menulis kembali kode yang sama berulang-ulang kali pada setiap file program.

<br>
<br>

## Membuat home.php

  <img src="https://arielsa.mra.my.id/foto/lab5/lab.png">

  <br>

```php
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
```

- Pada file index.php juga terdapat pemanggilan class library Form dan Database yang berfungsi untuk memproses inputan yang dimasukkan oleh pengguna dan menyimpan data tersebut ke dalam database.

- Dengan adanya file index.php, pengguna dapat melakukan input data users dengan mudah dan nyaman melalui halaman web yang sudah terintegrasi dengan database MySQL.

<br>
<br>

## Membuatu input.php

  <img src="https://arielsa.mra.my.id/foto/lab5/input.png">

<br>

```php
<?php
require_once('Database.php');
require_once('Form.php');


// buat instance class Database
$db = new Database('localhost', 'root', '', 'latihan3');

// ambil data dari database
$query = "SELECT * FROM users";
$result = $db->query($query);

// buat instance class Form
$form = new Form();


$no = 1;

require_once('header.php')
?>


<h2>Form Input Data</h2>
<form method="post" action="save.php">
    <?php
    // menampilkan form input nama
    echo $form->input('name', 'Nama');

    // menampilkan form input email
    echo $form->input('email', 'Email');

    // menampilkan tombol submit
    echo $form->submit('Simpan');
    ?>
</form>

<?php require_once('footer.php') ?>

```

<br>

## Membuat Save.php

<br>

```php
<?php
require_once('database.php');

// buat instance class Database
$db = new Database('localhost', 'root', '', 'latihan3');

// ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];

// simpan data ke dalam database
$data = array('name' => $name, 'email' => $email);
$db->insert('users', $data);

// kembali ke halaman utama
header('Location: index.php');

```

- File save.php pada kode program tersebut berfungsi untuk memproses data yang telah di-submit oleh pengguna melalui halaman index.php. Setelah pengguna menekan tombol "Simpan" pada formulir input data users, data akan dikirim ke halaman save.php untuk diproses.

- Pada file save.php, terdapat pemanggilan class library Database yang digunakan untuk melakukan koneksi ke database MySQL dan menjalankan query untuk menyimpan data yang diinputkan oleh pengguna.

<br>
<br>

# TERIMAKASIH
