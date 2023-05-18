<?php

declare(strict_types=1);

class MyOrm {
    private $dbString = '';
    private $connection = null;


    public function __construct(string $dbDriver, string $userName, string $passWord, bool $verbose = false) {
        try {
            $this->connection = new PDO($dbDriver, $userName, $passWord);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo 'Errors encountered. ' .$e->getMessage();
            die();
        }   
    }


    public function connect(){

        return $this->connection;
    }
    
 

    public function select(array $fields = null): MyOrm {
        $this->dbString .= ' SELECT ';
            if($fields === null) {
             $fields = ' * ';
             $this->dbString .= $fields;
            } else {
             $arrayCount = count($fields)-1;
             $counter=0;
             foreach($fields as $field) {
                    $this->dbString .= $field;
                    if($counter < $arrayCount) 
                        $this->dbString .= ', ';
                 $counter++;
                }
            //$this->dbString .= ';';
            return $this;
        }
        return $this;
    }

    public function from(string $tableName): MyOrm {
        $this->dbString .= ' FROM ' .$tableName;
        return $this;
    }

    public function insert(): MyOrm {
        $this->dbString .= ' INSERT ';
        return $this;
    }

    public function update(string $tableName): MyOrm {
        $this->dbString .= ' UPDATE ' .$tableName;
        return $this;
    }

    public function set(string $variable): MyOrm {
        $this->dbString .= ' SET '. $variable;
        return $this;
    }

    

    public function into(string $tableName): MyOrm {
        $this->dbString .= ' INTO ' .$tableName;
        return $this;
    }

    
    public function where(string $colName): MyOrm {
        $this->dbString .= ' WHERE ' .$colName;
        return $this;
    }


    
    public function isEqualTo(string $variable): MyOrm {
        $this->dbString .= ' = ' . $variable;

        return $this;
    }

    public function isLike(string $variable): MyOrm {
        $this->dbString .= " LIKE '%$variable%' ";
        return $this;
    }

    public function delete(): MyOrm {
        $this->dbString .= ' DELETE ';
        return $this;
    }


    public function sc():MyOrm{
        $this->dbString .= ';';
        return $this;
    }

    public function showQuery(): string {
        return $this->dbString;
    }

    public function values(string $variable): MyOrm {
        $this->dbString .= " VALUES " . $variable;

        return $this;
    }

    public function resetQuery(): string {
        $this->dbString = " ";
        return $this->dbString;
    }








    





































    }


    