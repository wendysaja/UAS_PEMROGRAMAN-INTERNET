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

if (isset($_GET['id'])) {
    $id_to_display = sanitize($_GET['id']);

    $detail_query = "SELECT title, author, published_year, isbn FROM books WHERE id = '$id_to_display'";
    $result = $conn->query($detail_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $detail_title = $row['title'];
        $detail_author = $row['author'];
        $detail_publish_year = $row['published_year'];
        $detail_isbn = $row['isbn'];
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak diberikan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - Perpustakaan</title>
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

        section {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        p {
            margin-bottom: 16px;
            color: #555;
        }
    </style>
</head>

<body>

    <header>
        <h1>PERPUSTAKAAN WENDY</h1>
    </header>

    <section>
        <h2>Detail Buku</h2>
        <label for="title">Judul:</label>
        <p><?php echo $detail_title; ?></p>

        <label for="author">Penulis:</label>
        <p><?php echo $detail_author; ?></p>

        <label for="publish_year">Tahun Terbit:</label>
        <p><?php echo $detail_publish_year; ?></p>

        <label for="isbn">ISBN:</label>
        <p><?php echo $detail_isbn; ?></p>
    </section>

</body>
</html>

<?php
$conn->close();
?>
