<?php
$stmt = $pdo->query("SELECT * FROM commands ORDER BY RAND() LIMIT 1");
$command_of_the_day = $stmt->fetch();
?>

<div id="command-of-the-day">
  <h3>Command of the day</h3>
  <p><strong><?= htmlspecialchars($command_of_the_day['name']) ?></strong></p>
  <p><?= htmlspecialchars($command_of_the_day['description']) ?></p>
  <a href="command_detail.php?id=<?= $command_of_the_day['id'] ?>">Lihat Detail</a>
</div>
