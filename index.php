<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM commands ORDER BY created_at DESC");
$commands = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Linux interactive manual page</title>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>

  <h2>Linux Interactive manual page</h2>

  <p><a href="add_command.php">Add Command</a></p>

  <form method="GET" action="index.php">
    <input type="text" name="search" placeholder="search for command..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <button type="submit">Cari</button>
  </form>

  <?php
  $search_query = '';
  if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $stmt = $pdo->prepare("SELECT * FROM commands WHERE name LIKE ? OR description LIKE ? ORDER BY created_at DESC");
    $stmt->execute(['%' . $search_query . '%', '%' . $search_query . '%']);
  } else {
    $stmt = $pdo->query("SELECT * FROM commands ORDER BY created_at DESC");
  }

  $commands = $stmt->fetchAll();
  ?>

  <ul>
    <?php foreach ($commands as $command): ?>
      <li>
        <h3><a href="command_detail.php?id=<?= $command['id'] ?>"><?= htmlspecialchars($command['name']) ?></a></h3>
        <p><?= htmlspecialchars($command['description']) ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
  <?php include 'footer.php'; ?>

</body>

</html>
