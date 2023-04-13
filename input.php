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