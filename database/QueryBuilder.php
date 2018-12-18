<?php
/**
 * Created by PhpStorm.
 * User: mrsops
 * Date: 7/12/18
 * Time: 11:48
 */

require_once __DIR__ . '/../exception/QueryException.php';
require_once __DIR__ . '/Connection.php';
require_once __DIR__. '/../core/App.php';

abstract class QueryBuilder
{
    private $connection;
    private $table;
    private $classEntity;

    /**
     * QueryBuilder constructor.
     * @param PDO $connection
     */
    public function __construct(string $table, string $classEntity)
    {
        $this->connection = App::getConnection();
        $this->table=$table;
        $this->classEntity=$classEntity
        ;
    }

    /**
     * @param string $table
     * @param string $classEntity
     * @return array
     * @throws QueryException
     */

    public function findAll():array {
        $sql= "SELECT * FROM $this->table";
        $pdostatement = $this->connection->prepare($sql);
        if($pdostatement->execute()===false){
            throw new QueryException('No se ha podido ejecutar la query');
        }

        return $pdostatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    public function save(IEntity $entity){
        try {
            $parameters = $entity->toArray();
            $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)', $this->table, implode(', ', array_keys($parameters)), ':' . implode(', :', array_keys($parameters)));
            $pdostatement = $this->connection->prepare($sql);
            $pdostatement->execute($parameters);
        }catch (PDOException $exception){
            throw new QueryException("Error al insertar en la BDA");
        }
    }


}