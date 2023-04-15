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

    // SELECT FUNCTION
    public function selectData($columnName, $tableName, $whereValue = 0, $inColumn = 0, $inValue = 0, 
    $formatByGroup = 0, $formatByOrder = 0, $paginate = 0, $price = 0)
    {
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
            // if ($inColumn != 0) {
            //     $sql1 .= " WHERE ";
            //     foreach ($inColumn as $eachColumn) {
            //         $sql1 .= $eachColumn . " IN (";
            //         foreach ($inValue as $eachValue) {
            //             $sql1 .= $eachValue . ", ";
            //         }
            //         $sql1 = rtrim($sql1, ", ");
            //         $sql1 .= ") AND ";
            //     }
            //     $sql1 = rtrim($sql1, "AND ");
            // }

            // where product_price between 1000 and 2000
            // if ($price['MAX'] != 0)
            //     $sql1 .= " WHERE product_price BETWEEN " . $price['MIN'] . " AND " . $price['MAX'];

            // group by
            // if ($formatByGroup != 0) {
            //     $sql1 .= " GROUP BY ";
            //     foreach ($formatByGroup as $eachGroup) {
            //         $sql1 .= $eachGroup . ", ";
            //     }
            //     $sql1 = rtrim($sql1, ", ");
            // }

            // order by
            // if (@$formatByOrder['ASC'])
            //     $sql1 .= " ORDER BY " . $formatByOrder['ASC'] . " ASC";
            // else if (@$formatByOrder['DESC'])
            //     $sql1 .= " ORDER BY " . $formatByOrder['DESC'] . " DESC";

            // paginate
            // if ($paginate != 0) {
            //     $sql1 .= " LIMIT " . $paginate['START'] . ", " . $paginate['END'];
            // }
            $query = $this->connection->prepare($sql1);
			$query->execute();
			$dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
			
			return $dataSelected;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
