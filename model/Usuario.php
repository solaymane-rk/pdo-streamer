<?php
class Usuario {
    public function __construct(private PDO $db) {}

    public function listar(): array {
        return $this->db->query("SELECT * FROM usuarios ORDER BY id DESC")->fetchAll();
    }

    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function guardar(string $username, $ultima_visita, $total_visitas, ?int $id = null): bool {
        if ($id) {
            $stmt = $this->db->prepare("UPDATE usuarios SET username = ?, ultima_visita = ?, total_visitas = ? WHERE id = ?");
            return $stmt->execute([$username, $ultima_visita, $total_visitas, $id]);
        }
        $stmt = $this->db->prepare("INSERT INTO usuarios (username, ultima_visita, total_visitas) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $ultima_visita, $total_visitas]);
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function totalVisitas($username): int {
        $stmt = $this->db->prepare("SELECT total_visitas FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);

        return (int) $stmt->fetchColumn();
    }
}