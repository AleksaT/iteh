<?php

/**
 * Created by PhpStorm.
 * User: Aleksa
 * Date: 1/19/2017
 * Time: 7:47 PM
 */
class Ingredients
{
    public $name;
    public $measure;
    public $id;

    function __construct($id,$name,$measure)
    {
        $this->name = $name;
        $this->id = $id;
        $this->measure = $measure;
    }

    public static function getAll($rID)
    {
        include_once('conn.php');
        global $mysqli;
        $sql = "SELECT * FROM recipeing WHERE  recipeID=$rID";
        if (!$result = $mysqli->query($sql)) {
            echo "ERROR" . $mysqli->mysql_error;
            exit();
        }
        $arrayResult = array();
        while ($row = $result->fetch_object()) {
            $recipe = new Recipe($row->name, $row->type, $row->ing, $row->prep);
            $recipe->id = $row->id;
            array_push($arrayResult, $recipe);
        }
        return $arrayResult;
    }

}