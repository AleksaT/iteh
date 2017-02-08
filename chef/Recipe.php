<?php

/**
 * Created by PhpStorm.
 * User: Aleksa
 * Date: 12/29/2016
 * Time: 12:07 AM
 */
class Recipe
{
    public $id;
    public $name;
    public $type;
    public $ing;
    public $prep;

    public function __construct($name,$type,$ing,$prep)
    {
        $this->name = $name;
        $this->type = $type;
        $this->ing = $ing;
        $this->prep = $prep;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getIng()
    {
        return $this->ing;
    }

    /**
     * @return mixed
     */
    public function getPrep()
    {
        return $this->prep;
    }

    public static function getByName($name)
    {
        include_once('conn.php');
        global $mysqli;
        $sql = "SELECT * FROM recipes WHERE name = $name";
        if (!$result = $mysqli->query($sql)) {
            echo "ERROR " . $mysqli->error;
            exit();
        }
        $recipe = null;
        while ($row = $result->fetch_object()) {
            $recipe = new Recipe($row->name, $row->type, $row->ing, $row->prep);
            $recipe->id = $row->id;
        }
        return $recipe;
    }
    public static function getAll()
    {
        include_once('conn.php');
        global $mysqli;
        $sql = "SELECT * FROM recipes";
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

    public function addNew()
    {
        include_once('conn.php');
        global $mysqli;
        $query = "INSERT INTO recipe (name, type, prep, stadium) VALUES ('"
            . $mysqli->real_escape_string($this->name) . "', '"
            . $mysqli->real_escape_string($this->country) . "', '"
            . $mysqli->real_escape_string($this->league) . "', '"
            . $mysqli->real_escape_string($this->stadium) . "')";
        if ($mysqli->query($query)) {
            return true;
        } else {
            return false;
        }
    }
}