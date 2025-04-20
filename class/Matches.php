<?php
require_once __DIR__ . '/../config/db.php';

class MatchGame {

    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT m.*, t1.team_name AS team_name1, t2.team_name AS team_name2 FROM matches m JOIN teams t1 ON m.home_team_id = t1.id JOIN teams t2 ON m.away_team_id = t2.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($home_team_id, $away_team_id, $match_date, $score_home, $score_away) {
        $stmt = $this->conn->prepare("INSERT INTO matches (home_team_id, away_team_id, match_date, score_home, score_away) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$home_team_id, $away_team_id, $match_date, $score_home, $score_away]);
    }

    public function update($id, $home_team_id, $away_team_id, $match_date, $score_home, $score_away) {
        $stmt = $this->conn->prepare("UPDATE matches SET home_team_id = ?, away_team_id = ?, match_date = ?, score_home = ?, score_away = ? WHERE id = ?");
        return $stmt->execute([$home_team_id, $away_team_id, $match_date, $score_home, $score_away, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM matches WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM matches WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTeams() {
        $stmt = $this->conn->prepare("SELECT id, team_name FROM teams");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeamById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM teams WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMatchById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM matches WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMatchByTeam($team_id) {
        $stmt = $this->conn->prepare("SELECT * FROM matches WHERE home_team_id = ? OR away_team_id = ?");
        $stmt->execute([$team_id, $team_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatchByDate($date) {
        $stmt = $this->conn->prepare("SELECT * FROM matches WHERE match_date = ?");
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatchByScore($score_home, $score_away) {
        $stmt = $this->conn->prepare("SELECT * FROM matches WHERE score_home = ? AND score_away = ?");
        $stmt->execute([$score_home, $score_away]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatchByTeamAndDate($team_id, $date) {
        $stmt = $this->conn->prepare("SELECT * FROM matches WHERE (home_team_id = ? OR away_team_id = ?) AND match_date = ?");
        $stmt->execute([$team_id, $team_id, $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatchByTeamAndScore($team_id, $score_home, $score_away) {
        $stmt = $this->conn->prepare("SELECT * FROM matches WHERE (home_team_id = ? AND score_home = ?) OR (away_team_id = ? AND score_away = ?)");
        $stmt->execute([$team_id, $score_home, $team_id, $score_away]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatchByDateAndScore($date, $score_home, $score_away) {
        $stmt = $this->conn->prepare("SELECT * FROM matches WHERE match_date = ? AND score_home = ? AND score_away = ?");
        $stmt->execute([$date, $score_home, $score_away]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword) {
        $stmt = $this->conn->prepare("SELECT m.*, t1.team_name AS team_name1, t2.team_name AS team_name2 
                                      FROM matches m 
                                      JOIN teams t1 ON m.home_team_id = t1.id 
                                      JOIN teams t2 ON m.away_team_id = t2.id 
                                      WHERE t1.team_name LIKE ? OR t2.team_name LIKE ? OR m.match_date LIKE ?");
        $searchKeyword = '%' . $keyword . '%';
        $stmt->execute([$searchKeyword, $searchKeyword, $searchKeyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}