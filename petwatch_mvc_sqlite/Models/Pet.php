<?php
require_once __DIR__ . '/DB.php';

class Pet {
    public static function search(string $q='', string $type='', string $status='', int $limit=10, int $offset=0): array {
        $w = []; $a = [];
        if ($q !== '')      { $w[]="(p.name LIKE ? OR p.description LIKE ?)"; $a[]="%$q%"; $a[]="%$q%"; }
        if ($type !== '')   { $w[]="p.type = ?"; $a[]=$type; }
        if ($status !== '') { $w[]="p.status = ?"; $a[]=$status; }
        $where = $w ? ('WHERE ' . implode(' AND ', $w)) : '';
        $db = DB::conn();

        // Total rows
        $count = $db->prepare("SELECT COUNT(*) FROM pets p $where");
        $count->execute($a);
        $total = (int)$count->fetchColumn();

        // Fetch rows with LIMIT/OFFSET
        $sql = "SELECT p.*, u.username AS owner_name
                FROM pets p 
                JOIN users u ON u.id=p.owner_id
                $where 
                ORDER BY p.created_at DESC 
                LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        $stmt = $db->prepare($sql);
        $stmt->execute($a);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [$rows, $total];
    }

    // ...rest of the class unchanged
}
