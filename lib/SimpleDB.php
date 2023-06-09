<?php


class SimpleDB
{

    private $pdo;
    private $sQuery;
    private $connectionStatus = false;
    private $parameters;

    public $rowCount = 0;
    public $columnCount = 0;
    public $querycount = 0;

    private $retryAttempt = 0; //Number of failed retries
    const AUTO_RECONNECT = true;
    const RETRY_ATTEMPTS = 3; //Maximum number of failed retries

    public function __construct($user_pdo_db = null) {
        global $pdo_db;


        if ($user_pdo_db != null) {
            $this->pdo = $user_pdo_db;
        } else {
            if ($pdo_db) {
                $this->pdo = $pdo_db;
            } else {
                try {
                    include_once(__DIR__ . "/_dbconnect.php");
                    $this->pdo = $pdo_db;
                } catch (PDOException $e) {
                    echo $this->ExceptionLog($e->getMessage());
                    die();
                }
            }
        }

        if ($this->pdo) {
            $this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
            $this->connectionStatus = true;
        }
    }

    private function SetFailureFlag() {
        $this->pdo = null;
        $this->connectionStatus = false;
    }

    /**
     * close pdo connection
     */
    public function closeConnection() {
        $this->pdo = null;
    }

    private function Init($query, $parameters = null, $driverOptions = array()) {
        if (!$this->connectionStatus) {
            $this->Connect();
        }
        try {
            $this->parameters = $parameters;
            $this->sQuery = $this->pdo->prepare($this->BuildParams($query, $this->parameters), $driverOptions);

            if (!empty($this->parameters)) {
                if (array_key_exists(0, $parameters)) {
                    $parametersType = true;
                    array_unshift($this->parameters, "");
                    unset($this->parameters[0]);
                } else {
                    $parametersType = false;
                }
                foreach ($this->parameters as $column => $value) {
                    //$this->sQuery->bindParam($parametersType ? intval($column) : ":" . $column, $this->parameters[$column]); //It would be query after loop end(before 'sQuery->execute()').It is wrong to use $value.
                    if($parametersType) {
                        $this->sQuery->bindParam(intval($column), $this->parameters[$column]);
                    } else if(strpos($query, ":".$column) !== false) { //bind params exist check
                        $this->sQuery->bindParam(":" . $column, $this->parameters[$column]);
                    }
                }
            }

            if (!isset($driverOptions[PDO::ATTR_CURSOR])) {
                $this->sQuery->execute();
            }
            $this->querycount++;
        } catch (PDOException $e) {
            $this->ExceptionLog($e, $this->BuildParams($query), 'Init', array('query' => $query, 'parameters' => $parameters));

        }

        $this->parameters = array();
    }

    private function BuildParams($query, $params = null) {
        if (!empty($params)) {
            $array_parameter_found = false;
            foreach ($params as $parameter_key => $parameter) {
                if (is_array($parameter)) {
                    $array_parameter_found = true;
                    $in = "";
                    foreach ($parameter as $key => $value) {
                        $name_placeholder = $parameter_key . "_" . $key;
                        // concatenates params as named placeholders
                        $in .= ":" . $name_placeholder . ", ";
                        // adds each single parameter to $params
                        $params[$name_placeholder] = $value;
                    }
                    $in = rtrim($in, ", ");
                    $query = preg_replace("/:" . $parameter_key . "/", $in, $query);
                    // removes array form $params
                    unset($params[$parameter_key]);
                }
            }

            // updates $this->params if $params and $query have changed
            if ($array_parameter_found) $this->parameters = $params;
        }
        return $query;
    }

    /**
     * @return bool
     */
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    /**
     * @return bool
     */
    public function commit() {
        return $this->pdo->commit();
    }

    /**
     * @return bool
     */
    public function rollBack() {
        return $this->pdo->rollBack();
    }

    /**
     * @return bool
     */
    public function inTransaction() {
        return $this->pdo->inTransaction();
    }

    /**
     * execute a sql query, returns an result array in the select operation, and returns the number of rows affected in other operations
     * @param string $query
     * @param null $params
     * @param int $fetchMode
     * @return array|int|null
     */
    public function query($query, $params = null, $fetchMode = PDO::FETCH_ASSOC) {
        $query = trim($query);
        $rawStatement = explode(" ", $query);
        $this->Init($query, $params);
        $statement = strtolower($rawStatement[0]);
        if ($statement === 'select' || $statement === 'show' || $statement === 'call' || $statement === 'describe') {
            return $this->sQuery->fetchAll($fetchMode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->sQuery->rowCount();
        } else {
            return NULL;
        }
    }

    /**
     * execute a sql query, returns an iterator in the select operation, and returns the number of rows affected in other operations
     * @param string $query
     * @param null $params
     * @param int $fetchMode
     * @return int|null|PDOIterator
     */
    public function iterator($query, $params = null, $fetchMode = PDO::FETCH_ASSOC) {
        $query = trim($query);
        $rawStatement = explode(" ", $query);
        $this->Init($query, $params, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $statement = strtolower(trim($rawStatement[0]));
        if ($statement === 'select' || $statement === 'show' || $statement === 'call' || $statement === 'describe') {
            return new PDOIterator($this->sQuery, $fetchMode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->sQuery->rowCount();
        } else {
            return NULL;
        }
    }

    /**
     * @param $tableName
     * @param null $params
     * @return bool|string
     */
    public function insert($tableName, $params = null) {
        $keys = array_keys($params);
        $rowCount = $this->query(
            'INSERT INTO `' . $tableName . '` (`' . implode('`,`', $keys) . '`) 
			VALUES (:' . implode(',:', $keys) . ')',
            $params
        );
        if ($rowCount === 0) {
            return false;
        }
        return $this->lastInsertId();
    }

    /**
     * @return string
     */
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }


    /**
     * @param $query
     * @param null $params
     * @return array
     */
    public function column($query, $params = null) {
        $this->Init($query, $params);
        $resultColumn = $this->sQuery->fetchAll(PDO::FETCH_COLUMN);
        $this->rowCount = $this->sQuery->rowCount();
        $this->columnCount = $this->sQuery->columnCount();
        $this->sQuery->closeCursor();
        return $resultColumn;
    }

    /**
     * @param $query
     * @param null $params
     * @param int $fetchmode
     * @return mixed
     */
    public function row($query, $params = null, $fetchmode = PDO::FETCH_ASSOC) {
        $this->Init($query, $params);
        $resultRow = $this->sQuery->fetch($fetchmode);
        $this->rowCount = $this->sQuery->rowCount();
        $this->columnCount = $this->sQuery->columnCount();
        $this->sQuery->closeCursor();
        return $resultRow;
    }

    /**
     * @param $query
     * @param null $params
     * @return mixed
     */
    public function single($query, $params = null) {
        $this->Init($query, $params);
        return $this->sQuery->fetchColumn();
    }

    public function quote($value, $parameter_type = PDO::PARAM_STR) {
        return $this->pdo->quote($value, $parameter_type);
    }

    private function ExceptionLog(PDOException $e, $sql = "", $method = '', $parameters = array()) {
        $message = $e->getMessage();
        $exception = 'Unhandled Exception. <br />';
        $exception .= $message;
        $exception .= "<br /> You can find the error back in the log.";

        if (!empty($sql)) {
            $message .= "\r\nRaw SQL : " . $sql;
        }
        if (
            self::AUTO_RECONNECT
            && $this->retryAttempt < self::RETRY_ATTEMPTS
            && stripos($message, 'server has gone away') !== false
            && !empty($method)
            && !$this->inTransaction()
        ) {
            $this->SetFailureFlag();
            $this->retryAttempt++;
            //$this->logObject->write('Retry ' . $this->retryAttempt . ' times', $this->DBName . md5($this->DBPassword));
            call_user_func_array(array($this, $method), $parameters);
        } else {
            if (($this->pdo === null || !$this->inTransaction()) && php_sapi_name() !== "cli") {
                //Prevent search engines to crawl
                header("HTTP/1.1 500 Internal Server Error");
                header("Status: 500 Internal Server Error");
                echo $exception;
                exit();
            } else {
                throw $e;
            }
        }
    }
}