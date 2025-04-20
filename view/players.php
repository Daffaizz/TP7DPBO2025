<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../class/Players.php';
require_once __DIR__ . '/../class/Teams.php';

$player = new Player();
$team = new Team();

$teams = $team->getAll();
$search = isset($_GET['search']) ? $_GET['search'] : '';
?>

<div class="container">
    <h2>🧍 Daftar Pemain per Tim</h2>

    <!-- Form Pencarian Pemain -->
    <form method="GET" action="index.php" class="form-search">
        <input type="hidden" name="page" value="players">
        <input type="text" name="search" placeholder="Cari pemain..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn">Cari</button>
    </form>

    <!-- Form Tambah Pemain -->
    <form action="index.php?page=players" method="POST">
        <input type="text" name="name" placeholder="Nama Pemain" required>
        <input type="text" name="position" placeholder="Posisi" required>
        <select name="team_id" required>
            <?php foreach ($teams as $t): ?>
                <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['team_name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="add_player" class="btn">Tambah Pemain</button>
    </form>

    <!-- Daftar Pemain per Tim -->
    <?php foreach ($teams as $t): ?>
        <?php
            if ($search) {
                $players = $player->searchByTeam($search, $t['id']); // method baru
            } else {
                $players = $player->getByTeam($t['id']);
            }
            if (count($players) === 0) continue;
        ?>
        <h3>🏀 <?= htmlspecialchars($t['team_name']) ?></h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($players as $i => $p): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['position']) ?></td>
                    <td>
                        <a href="index.php?page=edit_player&id=<?= $p['id'] ?>" class="btn">Edit</a>
                        <a href="index.php?page=delete_player&id=<?= $p['id'] ?>" class="btn" onclick="return confirm('Yakin ingin menghapus pemain ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>