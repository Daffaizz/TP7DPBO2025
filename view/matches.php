<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../class/Matches.php';

$match = new MatchGame();
$search = isset($_GET['search']) ? $_GET['search'] : '';
$data = $match->search($search);

?>

<div class="container">
    <h2>🏆 Jadwal Pertandingan</h2>

    <!-- Form Pencarian Pertandingan -->
    <form method="GET" action="index.php" class="form-search">
        <input type="hidden" name="page" value="matches">
        <input type="text" name="search" placeholder="Cari berdasarkan nama tim..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit" class="btn">Cari</button>
    </form>

    <!-- Form Tambah Pertandingan -->
    <form action="index.php?page=matches" method="POST">
        <select name="team1_id" required>
            <option value="">Pilih Tim Tuan Rumah</option>
            <?php foreach ($match->getTeams() as $team): ?>
                <option value="<?= $team['id'] ?>"><?= htmlspecialchars($team['team_name']) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="team2_id" required>
            <option value="">Pilih Tim Tamu</option>
            <?php foreach ($match->getTeams() as $team): ?>
                <option value="<?= $team['id'] ?>"><?= htmlspecialchars($team['team_name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="match_date" required>
        <input type="number" name="score_home" placeholder="Skor Tuan Rumah" min="0" required>
        <input type="number" name="score_away" placeholder="Skor Tamu" min="0" required>
        <button type="submit" name="add_match" class="btn">Tambah Pertandingan</button> 

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tim Tuan Rumah</th>
                <th>Tim Tamu</th>
                <th>Tanggal</th>
                <th>Skor</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $m): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($m['team_name1']) ?></td>
                <td><?= htmlspecialchars($m['team_name2']) ?></td>
                <td><?= date('d M Y', strtotime($m['match_date'])) ?></td>
                <td><?= $m['score_home'] ?> - <?= $m['score_away'] ?></td>
                <td>
                    <a href="index.php?page=edit_match&id=<?= $m['id'] ?>" class="btn">Edit</a>
                    <a href="index.php?page=delete_match&id=<?= $m['id'] ?>" class="btn" onclick="return confirm('Yakin ingin menghapus pertandingan ini?')">Hapus</a>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
