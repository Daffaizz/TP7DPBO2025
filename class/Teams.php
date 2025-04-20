<?php
require_once __DIR__ . '/../config/db.php';

class Team {
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM teams");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($team_name, $coach_name) {
        $stmt = $this->conn->prepare("INSERT INTO teams (team_name, coach_name) VALUES (?, ?)");
        return $stmt->execute([$team_name, $coach_name]);
    }    

    public function update($id, $team_name, $coach_name) {
        $stmt = $this->conn->prepare("UPDATE teams SET team_name = ?, coach_name = ? WHERE id = ?");
        return $stmt->execute([$team_name, $coach_name, $id]);
    }    

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM teams WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getConn() {
        return $this->conn;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM teams WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($keyword)
    {
        $db = $this->conn;
        if (!empty($keyword)) {
            $stmt = $db->prepare("SELECT * FROM teams WHERE team_name LIKE :keyword OR coach_name LIKE :keyword ORDER BY team_name");
            $stmt->execute([':keyword' => "%$keyword%"]);
        } else {
            $stmt = $db->query("SELECT * FROM teams ORDER BY team_name");
        }
        return $stmt->fetchAll();
    }

}
