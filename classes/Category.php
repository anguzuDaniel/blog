<?php

class Category
{
    /**
     * @param mixed $conn
     * @param mixed $num
     * 
     * @return [type]
     */
    public static function getAll($conn, $column = '*')
    {
        $sql = "SELECT $column 
                FROM category 
                ORDER BY name";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
}
