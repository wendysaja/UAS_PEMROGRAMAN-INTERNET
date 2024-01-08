<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'nama_database';


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_title = sanitize($_POST['title']);
    $new_author = sanitize($_POST['author']);
    $new_publish_year = sanitize($_POST['published_year']);
    $new_isbn = sanitize($_POST['isbn']);

    $insert_query = "INSERT INTO books (title, author, published_year, isbn) VALUES ('$new_title', '$new_author', '$new_publish_year', '$new_isbn')";
    $conn->query($insert_query);

    
    header("Location: lihat_database.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data - Perpustakaan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        nav {
            background-color: #4CAF50;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        section {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <header>
        <h1>PERPUSTAKAAN WENDY</h1>
    </header>

    <nav>
        <a href="lihat_database.php">Lihat Database</a>
        <a href="tambah_database.php">Tambah Database Baru</a>
    </nav>

    <section>
        <h2>Formulir Tambah Data Buku</h2>
        <form method="post" action="">
            <label for="title">Judul:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Penulis:</label>
            <input type="text" id="author" name="author" required>

            <label for="publish_year">Tahun Terbit:</label>
            <input type="text" id="published_year" name="published_year" required>

            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required>

            <button type="submit">Tambah Data</button>
        </form>
    </section>

</body>
</html>

