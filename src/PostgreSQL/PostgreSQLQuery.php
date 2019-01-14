<?php

namespace DEMO\PostgreSQL;

class PostgreSQLQuery {
    /**
    * PDO object
    * @var \PDO
    */
    private $pdo;

    /**
    * Initialize the object with a specified PDO object
    * @param \PDO $pdo
    */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
    * Return all rows in the stocks table
    * @return array
    */
    public function all() {
        $stmt = $this->pdo->query('SELECT id, symbol, company '
               . 'FROM stocks '
               . 'ORDER BY symbol');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'id' => $row['id'],
                'symbol' => $row['symbol'],
                'company' => $row['company']
            ];
        }
           return $stocks;
       }
}
