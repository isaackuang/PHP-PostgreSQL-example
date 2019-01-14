<?php

use Slim\Http\Request;
use Slim\Http\Response;

use \DEMO\Controller;

use \DEMO\PostgreSQL\Connection as Connection;
use \DEMO\PostgreSQL\PostgreSQLCreateTable as PostgreSQLCreateTable;
use \DEMO\PostgreSQL\PostgreSQLInsert as PostgreSQLInsert;
use \DEMO\PostgreSQL\PostgreSQLUpdate as PostgreSQLUpdate;
use \DEMO\PostgreSQL\PostgreSQLQuery as PostgreSQLQuery;
// Routes

// $app->get('/[{name}]', function (Request $request, Response $response, array $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");
//
//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });

$app->get("/", function (Request $request, Response $response, array $args)
{
    $slogan = "DEMO GO";
    return $response->withJson($slogan);
});

$app->get('/connect', function (Request $request, Response $response, array $args)
{

    try {
        Connection::get()->connect();
        $slogan = 'A connection to the PostgreSQL database sever has been established successfully.';
    } catch (\PDOException $e) {
        $slogan = $e->getMessage();
    }

    return $response->withJson($slogan);
});

$app->get('/createTable', function (Request $request, Response $response, array $args)
{
    try {
        // connect to the PostgreSQL database
        $pdo = Connection::get()->connect();

        $tableCreator = new PostgreSQLCreateTable($pdo);

        // create tables and query the table from the
        // database
        $tables = $tableCreator->createTables()
                                ->getTables();

        foreach ($tables as $table){
            $slogan = $slogan . $table . '<br>';
        }

    } catch (\PDOException $e) {
        $slogan = $e->getMessage();
    }

    return $response->withJson($slogan);

});

$app->get('/insertData', function (Request $request, Response $response, array $args)
{
    try {
        // connect to the PostgreSQL database
        $pdo = Connection::get()->connect();
        //
        $insertDemo = new PostgreSQLInsert($pdo);

        // insert a stock into the stocks table
        $id = $insertDemo->insertStock('MSFT', 'Microsoft Corporation');
        $slogan = 'The stock has been inserted with the id ' . $id . '<br>';

        // insert a list of stocks into the stocks table
        $list = $insertDemo->insertStockList([
            ['symbol' => 'GOOG', 'company' => 'Google Inc.'],
            ['symbol' => 'YHOO', 'company' => 'Yahoo! Inc.'],
            ['symbol' => 'FB', 'company' => 'Facebook, Inc.'],
        ]);

        foreach ($list as $id) {
        $slogan = $slogan . 'The stock has been inserted with the id ' . $id . '<br>';
        }
    } catch (\PDOException $e) {
        $slogan = $e->getMessage();
    }

    return $response->withJson($slogan);
});

$app->get('/updateData', function (Request $request, Response $response, array $args)
{
    try {
        // connect to the PostgreSQL database
        $pdo = Connection::get()->connect();
        //
        $updateDemo = new PostgreSQLUpdate($pdo);
        // insert a stock into the stocks table
        $affectedRows = $updateDemo->updateStock(2, 'GOOGL', 'Alphabet Inc.');
        $slogan = 'Number of row affected ' . $affectedRows;
    } catch (\PDOException $e) {
        $slogan = $e->getMessage();
    }

    return $response->write($slogan);
});

$app->get('/queryData', function (Request $request, Response $response, array $args)
{
    try {
        // connect to the PostgreSQL database
        $pdo = Connection::get()->connect();
        //
        $stockDB = new PostgreSQLQuery($pdo);
        // get all stocks data
        $stocks = $stockDB->all();
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }


    return $response->withJson($stocks);
});
