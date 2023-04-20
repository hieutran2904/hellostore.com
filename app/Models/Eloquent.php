<?php
class Eloquent
{
    public $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=' . $GLOBALS['DBHOST'] . ';dbname=' . $GLOBALS['DBNAME'] . ';charset=utf8', $GLOBALS['DBUSER'], $GLOBALS['DBPASS']);
        //$this->connection = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASS);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    // INSERT FUNCTION => tra ve id cua phan tu vua duoc them vao
    function insertData($tableName, $data)
    {
        try {
            $sql = "INSERT INTO $tableName (";
            foreach ($data as $key => $value) {
                $sql .= $key . ", ";
            }
            $sql = rtrim($sql, ", ");
            $sql .= ") VALUES (";
            foreach ($data as $key => $value) {
                $sql .= ":" . $key . ", ";
            }
            $sql = rtrim($sql, ", ");
            $sql .= ")";
            $stmt = $this->connection->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value); //gan gia tri cho cac bien dinh danh
            }
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // UPDATE FUNCTION

    // DELETE FUNCTION


    // SELECT FUNCTION
    public function selectData(
        $columnName,
        $tableName,
        $whereValue = [],
        $inColumn = [],
        $inValue = [],
        $formatByGroup = [],
        $formatByOrder = 0,
        $paginate = [],
        $price = ['MIN' => 0, 'MAX' => 0]
    ) {
        try {
            // select ? form table
            if ($columnName == "*")
                $sql1 = "SELECT * FROM ";
            else {
                $sql1 = "SELECT ";
                foreach ($columnName as $eachColumn) { // lay ra cac cot trong mang $columnName
                    $sql1 .= $eachColumn . ", ";
                }
                $sql1 = rtrim($sql1, ", ");
                $sql1 .= " FROM $tableName";
            }

            // where column in ()
            if ($inColumn != []) {
                $sql1 .= " WHERE ";
                $i = $j = 0;
                foreach ($inColumn as $eachColumn) {
                    $sql1 .= $eachColumn . " IN (";
                    foreach ($inValue as $eachValue) {
                        if ($i == $j){
                            $sql1 .= $eachValue . ", ";
                            break;
                        }
                        $j++;
                    }
                    $sql1 = rtrim($sql1, ", ");
                    $sql1 .= ") AND ";
                    $i++;
                }
                $sql1 = rtrim($sql1, "AND ");
            }

            // where product_price between 1000 and 2000
            if ($price['MAX'] != 0)
                $sql1 .= " WHERE product_price BETWEEN " . $price['MIN'] . " AND " . $price['MAX'];

            //group by
            if ($formatByGroup != []) {
                $sql1 .= " GROUP BY ";
                foreach ($formatByGroup as $eachGroup) {
                    $sql1 .= $eachGroup . ", ";
                }
                $sql1 = rtrim($sql1, ", ");
            }

            // order by
            if (@$formatByOrder['ASC'])
                $sql1 .= " ORDER BY " . $formatByOrder['ASC'] . " ASC";
            else if (@$formatByOrder['DESC'])
                $sql1 .= " ORDER BY " . $formatByOrder['DESC'] . " DESC";

            //paginate
            if ($paginate != []) {
                $sql1 .= " LIMIT " . $paginate['START'] . ", " . $paginate['END'];
            }

            //where column = value
            if ($whereValue != []) {
                $sql1 .= " WHERE ";
                if (array_key_exists('operator', $whereValue)) {
                    $operator = $whereValue['operator'] == '=' ? ' = ' : ' <> ';
                } else $operator = ' = ';
                foreach ($whereValue as $eachColumn => $eachValue) {
                    if ($eachColumn == 'operator') continue;
                    $sql1 .= $eachColumn . $operator . '\'' . $eachValue . '\'' . " AND ";
                }
                $sql1 = rtrim($sql1, "AND ");
            }

            $query = $this->connection->prepare($sql1);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);

            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // function alter message
    public function alertMessage($message, $type)
    {
        //custom alert message

        echo "<script>alert('$message')</script>";
        // if ($type == 'success') {
        //     echo "<script>window.location.href = 'index.php'</script>";
        // } else if ($type == 'error') {
        //     echo "<script>window.location.href = 'index.php'</script>";
        // } 
    }

}
