<?php
require_once __DIR__ . '/../config/db.php';

class Player {
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT p.*, t.team_name FROM players p JOIN teams t ON p.team_id = t.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $position, $team_id) {
        $stmt = $this->conn->prepare("INSERT INTO players (name, position, team_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $position, $team_id]);
    }

    public function update($id, $name, $position, $team_id) {
        $stmt = $this->conn->prepare("UPDATE players SET name = ?, position = ?, team_id = ? WHERE id = ?");
        return $stmt->execute([$name, $position, $team_id, $id]);
    }

    public function delete($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM players WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting player: " . $e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM players WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByTeam($team_id) {
        $stmt = $this->conn->prepare("SELECT * FROM players WHERE team_id = ?");
        $stmt->execute([$team_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeams() {
        $stmt = $this->conn->prepare("SELECT id, team_name FROM teams");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchByTeam($keyword, $teamId) {
        $stmt = $this->conn->prepare("
            SELECT p.*, t.team_name 
            FROM players p 
            JOIN teams t ON p.team_id = t.id 
            WHERE p.team_id = ? AND p.name LIKE ?
        ");
        $stmt->execute([$teamId, '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

}
