<?php
$id = $_GET['id'];
$data = $match->getById($id);
$teams = $team->getAll(); // Untuk dropdown team
?>

<div class="container">
    <h2>Edit Pertandingan</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

        <div class="form-group">
            <label for="home_team_id">Tim Tuan Rumah:</label>
            <select id="home_team_id" name="home_team_id" required>
                <?php foreach ($teams as $t): ?>
                    <option value="<?= $t['id'] ?>" <?= ($t['id'] == $data['home_team_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['team_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="away_team_id">Tim Tamu:</label>
            <select id="away_team_id" name="away_team_id" required>
                <?php foreach ($teams as $t): ?>
                    <option value="<?= $t['id'] ?>" <?= ($t['id'] == $data['away_team_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['team_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="match_date">Tanggal Pertandingan:</label>
            <input type="date" id="match_date" name="match_date" value="<?= htmlspecialchars($data['match_date']) ?>" required>
        </div>

        <div class="form-group">
            <label for="score_home">Skor Tuan Rumah:</label>
            <input type="number" id="score_home" name="score_home" value="<?= htmlspecialchars($data['score_home']) ?>" required>
        </div>

        <div class="form-group">
            <label for="score_away">Skor Tamu:</label>
            <input type="number" id="score_away" name="score_away" value="<?= htmlspecialchars($data['score_away']) ?>" required>
        </div>

        <button type="submit" class="btn" name="update_match">Update Pertandingan</button>
    </form>
    <a href="index.php?page=matches" class="btn">Kembali ke Daftar Pertandingan</a>
</div>