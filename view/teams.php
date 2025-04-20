<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../class/Teams.php';

$team = new Team();
$search = isset($_GET['search']) ? $_GET['search'] : '';
$data = $team->search($search);

?>

<div class="container">
    <h2>📋 Daftar Tim</h2>

    <!-- Form Pencarian Tim -->
    <form method="GET" action="index.php" class="form-search">
        <input type="hidden" name="page" value="teams">
        <input type="text" name="search" placeholder="Cari nama tim..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit" class="btn">Cari</button>
    </form>

    <!-- Form Tambah Tim -->
    <form action="index.php?page=teams" method="POST">
        <input type="text" name="team_name" placeholder="Nama Tim" required>
        <input type="text" name="coach_name" placeholder="Nama Pelatih" required>
        <button type="submit" name="add_team" class="btn">Tambah Tim</button>
    </form>

    <!-- Tabel Daftar Tim -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tim</th>
                <th>Pelatih</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $t): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($t['team_name']) ?></td>
                <td><?= htmlspecialchars($t['coach_name']) ?></td>
                <td>
                    <!-- Tombol Update dan Delete -->
                    <a href="index.php?page=edit_team&id=<?= $t['id'] ?>" class="btn">Edit</a>
                    <a href="index.php?page=delete_team&id=<?= $t['id'] ?>" class="btn" onclick="return confirm('Yakin ingin menghapus tim ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
