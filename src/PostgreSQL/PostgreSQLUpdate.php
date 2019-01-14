<?php

namespace DEMO\PostgreSQL;

class PostgreSQLUpdate {
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
    * Update stock based on the specified id
    * @param int $id
    * @param string $symbol
    * @param string $company
    * @return int
    */

    public function updateStock($id, $symbol, $company) {

        // sql statement to update a row in the stock table
        $sql = 'UPDATE stocks '
                . 'SET company = :company, '
                . 'symbol = :symbol '
                . 'WHERE id = :id';

        $stmt = $this->pdo->prepare($sql);

        // bind values to the statement
        $stmt->bindValue(':symbol', $symbol);
        $stmt->bindValue(':company', $company);
        $stmt->bindValue(':id', $id);
        // update data in the database
        $stmt->execute();

        // return the number of row affected
        return $stmt->rowCount();
    }
}
