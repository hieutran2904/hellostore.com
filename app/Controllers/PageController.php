<?php
class PageController extends Controller
{
    public function paginateData($table, $column, $id, $start, $end)
    {
        $sql_code1 = "SELECT * FROM {$table} WHERE {$column} = {$id} LIMIT {$start}, {$end}";
        $query = $this->connection->prepare($sql_code1);
        $query->execute();
        $pageList = $query->fetchAll(PDO::FETCH_ASSOC);
        $totalPageSelected = $query->rowCount();

        if ($totalPageSelected > 0)
            return $pageList;
        else
            return 0;
    }
}
