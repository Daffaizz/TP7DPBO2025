<?php
require_once 'class/Teams.php';
require_once 'class/Players.php';
require_once 'class/Matches.php';

$team = new Team();
$player = new Player();
$match = new MatchGame();

// CREATE
if (isset($_POST['add_team'])) {
    $team->create($_POST['team_name'], $_POST['coach_name']);
    header("Location: index.php?page=teams");
    exit;
}

if (isset($_POST['add_player'])) {
    $player->create($_POST['name'], $_POST['position'], $_POST['team_id']);
    header("Location: index.php?page=players");
    exit;
}

if (isset($_POST['add_match'])) {
    $match->create($_POST['team1_id'], $_POST['team2_id'], $_POST['match_date'], $_POST['score_home'], $_POST['score_away']);
    header("Location: index.php?page=matches");
    exit;
}

// UPDATE
if (isset($_POST['update_team'])) {
    $team->update($_POST['id'], $_POST['team_name'], $_POST['coach_name']);
    header("Location: index.php?page=teams");
    exit;
}

if (isset($_POST['update_player'])) {
    $player->update($_POST['id'], $_POST['name'], $_POST['position'], $_POST['team_id']);
    header("Location: index.php?page=players");
    exit;
}

if (isset($_POST['update_match'])) {
    $match->update($_POST['id'], $_POST['home_team_id'], $_POST['away_team_id'], $_POST['match_date'], $_POST['score_home'], $_POST['score_away']);
    header("Location: index.php?page=matches");
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Olahraga</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <h2>Selamat datang di Indonesia Basketball League</h2>
            <p>Temukan informasi terkini tentang tim, pemain, dan pertandingan basket Indonesia.</p>
            <a href="?page=teams" class="btn">Lihat Tim</a>
            <a href="?page=players" class="btn">Lihat Pemain</a>
            <a href="?page=matches" class="btn">Lihat Pertandingan</a>
        </div>
    </section>

    <main>
        <?php
            // Edit dan delete untuk Team
            if ($page == 'edit_team') {
                include 'view/edit_team.php';
            } elseif ($page == 'delete_team') {
                $team->delete($_GET['id']);
                header("Location: index.php?page=teams");
                exit;
            }

            // Edit dan delete untuk Player
            elseif ($page == 'edit_player') {
                include 'view/edit_player.php';
            } elseif ($page == 'delete_player') {
                $id = $_GET['id'];
                $player->delete($id);
                header("Location: index.php?page=players");
                exit;
            }
            
            // Edit dan delete untuk Match
            elseif ($page == 'edit_match') {
                include 'view/edit_match.php';
            } elseif ($page == 'delete_match') {
                $match->delete($_GET['id']);
                header("Location: index.php?page=matches");
                exit;
            }

            // Tampilan halaman utama
            elseif ($page == 'teams') include 'view/teams.php';
            elseif ($page == 'players') include 'view/players.php';
            elseif ($page == 'matches') include 'view/matches.php';
        ?>
    </main>

    <footer>
        <p>&copy; 2025 Indonesia Basketball League. All rights reserved.</p>
    </footer>

</body>
</html>