<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $syntax = $_POST['syntax'];
    $example = $_POST['example'];
    $category = $_POST['category'];

    // Validasi input
    if (empty($name) || empty($description) || empty($syntax) || empty($example)) {
        $error_message = "Semua field harus diisi!";
    } else {
        // Simpan perintah ke database
        $stmt = $pdo->prepare("INSERT INTO commands (name, description, syntax, example, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $syntax, $example, $category]);

        $success_message = "Perintah berhasil ditambahkan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Perintah Linux</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h2>Tambah Perintah Linux</h2>

<?php if (isset($error_message)): ?>
    <p style="color:red"><?= htmlspecialchars($error_message) ?></p>
<?php endif; ?>

<?php if (isset($success_message)): ?>
    <p style="color:green"><?= htmlspecialchars($success_message) ?></p>
<?php endif; ?>

<form method="POST">
    <label for="name">Nama Perintah:</label><br>
    <input type="text" name="name" id="name" required><br><br>

    <label for="description">Deskripsi:</label><br>
    <textarea name="description" id="description" required></textarea><br><br>

    <label for="syntax">Sintaksis:</label><br>
    <textarea name="syntax" id="syntax" required></textarea><br><br>

    <label for="example">Contoh:</label><br>
    <textarea name="example" id="example" required></textarea><br><br>

    <label for="category">Kategori:</label><br>
    <select name="category" id="category">
        <option value="sistem">Sistem</option>
        <option value="jaringan">Jaringan</option>
        <option value="file">File</option>
        <option value="proses">Proses</option>
    </select><br><br>

    <button type="submit">Tambah Perintah</button>
</form>

</body>
</html>

