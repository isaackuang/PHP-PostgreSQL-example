<?php

namespace DEMO\PostgreSQL;

class PostgreSQLInsert {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * init the object with a \PDO object
     * @param type $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertStock($symbol, $company) {
        // prepare statement for insert
        $sql = 'INSERT INTO stocks(symbol,company) VALUES(:symbol,:company)';
        $stmt = $this->pdo->prepare($sql);

        // pass values to the statement
        $stmt->bindValue(':symbol', $symbol);
        $stmt->bindValue(':company', $company);

        // execute the insert statement
        $stmt->execute();

        // return generated id
        return $this->pdo->lastInsertId('stocks_id_seq');
    }

    public function insertStockList($stocks) {
        $sql = 'INSERT INTO stocks(symbol,company) VALUES(:symbol,:company)';
        $stmt = $this->pdo->prepare($sql);

        $idList = [];
        foreach ($stocks as $stock) {
            $stmt->bindValue(':symbol', $stock['symbol']);
            $stmt->bindValue(':company', $stock['company']);
            $stmt->execute();
            $idList[] = $this->pdo->lastInsertId('stocks_id_seq');
        }
        return $idList;
    }
}
