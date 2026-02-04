<?php
class Streamer {
    public function __construct(private PDO $db) {}

    public function listar(): array {
        return $this->db->query("SELECT * FROM streamers ORDER BY id")->fetchAll();
    }

    public function cambiarDestacado($nuevoId) {
    $stmt = $this->db->prepare("UPDATE streamers SET destacado = 0");
    $stmt->execute();
        
    if ($nuevoId) {
        $stmt = $this->db->prepare("UPDATE streamers SET destacado = 1 WHERE id = ?");
        $stmt->execute([$nuevoId]);
    }
    
    return true;
}
    
}