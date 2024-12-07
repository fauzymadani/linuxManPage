<?php
include 'db.php';

if (!isset($_GET['id'])) {
  die("ID perintah tidak ditemukan.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM commands WHERE id = ?");
$stmt->execute([$id]);
$command = $stmt->fetch();

if (!$command) {
  die("Perintah tidak ditemukan.");
}

// Command of the Day
$stmt = $pdo->query("SELECT * FROM commands ORDER BY RAND() LIMIT 1");
$command_of_the_day = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Perintah - <?= htmlspecialchars($command['name']) ?></title>
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
  <script>
    function copyToClipboard() {
      var commandText = document.getElementById('command-syntax').innerText;
      var tempInput = document.createElement('input');
      document.body.appendChild(tempInput);
      tempInput.value = commandText;
      tempInput.select();
      document.execCommand('copy');
      document.body.removeChild(tempInput);
      alert("Perintah telah disalin ke clipboard!");
    }
  </script>
</head>

<body>

  <h2><?= htmlspecialchars($command['name']) ?></h2>

  <p><strong>Desc:</strong> <?= htmlspecialchars($command['description']) ?></p>
  <p><strong>Syntax:</strong> <span id="command-syntax">
      <pre><?= htmlspecialchars($command['syntax']) ?></pre>
    </span></p>
  <button onclick="copyToClipboard()">Copy command</button>

  <h3>Usage Example:</h3>
  <pre><code class="language-bash"><?= htmlspecialchars($command['example']) ?></code></pre>
  <h3>Command of the day</h3>
  <p><strong><?= htmlspecialchars($command_of_the_day['name']) ?></strong></p>
  <p><?= htmlspecialchars($command_of_the_day['description']) ?></p>
  <a href="command_detail.php?id=<?= $command_of_the_day['id'] ?>">Lihat Detail</a>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      hljs.highlightAll();
    });
  </script>
</body>

</html>
