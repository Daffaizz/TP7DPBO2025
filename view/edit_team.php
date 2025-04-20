    <?php
    require_once __DIR__ . '/../config/db.php';
    require_once __DIR__ . '/../class/Teams.php';

    if (isset($_GET['id'])) {
        $team_id = $_GET['id'];
        $team = new Team();
        $team_data = $team->getById($team_id);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $team_name = $_POST['team_name'];
        $coach_id = $_POST['coach_id'];
        $team->update($team_id, $team_name, $coach_id);
        header('Location: index.php?page=teams');
    }
    ?>

    <div class="container">
        <h2>Edit Tim</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="team_name">Nama Tim:</label>
                <input type="text" name="team_name" id="team_name" value="<?= htmlspecialchars($team_data['team_name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="coach_id">Pelatih:</label>
                <input type="text" name="coach_id" id="coach_id" value="<?= htmlspecialchars($team_data['coach_name']) ?>" required>
            </div>
            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
        <a href="index.php?page=teams" class="btn">Kembali ke Daftar Tim</a>
    </div>
