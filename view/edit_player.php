<?php
$id = $_GET['id'];
$data = $player->getById($id);
$teams = $team->getAll(); 
?>

<div class="container">
    <h2>Edit Pemain</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

        <div class="form-group">
            <label for="name">Nama Pemain:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="position">Posisi:</label>
            <input type="text" id="position" name="position" value="<?= htmlspecialchars($data['position']) ?>" required>
        </div>

        <div class="form-group">
            <label for="team_id">Tim:</label>
            <select id="team_id" name="team_id" required>
                <?php foreach ($teams as $t): ?>
                    <option value="<?= $t['id'] ?>" <?= ($t['id'] == $data['team_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['team_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="update_player" class="btn">Update Pemain</button>
    </form>
    <a href="index.php?page=players" class="btn">Kembali ke Daftar Pemain</a>
</div>
