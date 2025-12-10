<?php
require_once __DIR__ . '/DB.php';

class User {

    public static function create(string $username, string $password, string $name, string $role='user'): bool {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = DB::conn()->prepare(
            "INSERT INTO users (username, password_hash, name, role) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$username, $hash, $name, $role]);
    }

    public static function findByUsername(string $username): array|null {
        $stmt = DB::conn()->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function all(): array {
        $stmt = DB::conn()->query("SELECT * FROM users ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
