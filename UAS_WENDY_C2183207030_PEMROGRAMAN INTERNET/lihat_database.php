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

if (isset($_GET['action']) && $_GET['action'] == 'hapus' && isset($_GET['id'])) {
    $id_to_delete = sanitize($_GET['id']);
    $delete_query = "DELETE FROM books WHERE id = '$id_to_delete'";
    $conn->query($delete_query);
}

$query = "SELECT id, title, author, published_year, isbn FROM books";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Wendy Wildany</title>
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
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #28a745; /* Warna biru muda */
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .edit-button, .hapus-button, .detail-button {
            padding: 8px 16px;
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s;
        }

        .edit-button {
            background-color: #007BFF; /* Warna biru */
        }

        .hapus-button {
            background-color: #dc3545; /* Warna merah */
        }

        .detail-button {
            background-color: #28a745; /* Warna hijau */
        }

        .edit-button:hover, .hapus-button:hover, .detail-button:hover {
            background-color: #0056b3; /* Warna biru tua saat hover */
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
        <h2>Data Buku</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>ISBN</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['author'] . "</td>";
                    echo "<td>" . $row['published_year'] . "</td>";
                    echo "<td>" . $row['isbn'] . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<a href='edit_data.php?id=" . $row['id'] . "' class='edit-button'>Edit</a>";
                    echo "<a href='lihat_database.php?action=hapus&id=" . $row['id'] . "' class='hapus-button'>Hapus</a>";
                    echo "<a href='detail_buku.php?id=" . $row['id'] . "' class='detail-button'>Detail</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <?php
    $conn->close();
    ?>

</body>
</html>

