<?php
/*
 * This file contains common functionality found in many parts of the webapp.
 *
 */
#
session_start();

if(isset($_SESSION["ID"]))
{
    if(time()-$_SESSION["login_time_stamp"] > 1800)
{
    session_unset();
    session_destroy();
    header("Location: /index.php");
}
}


$ini_path = "./rezepti_config.ini";

// Parse with sections
$ini_array = parse_ini_file($ini_path, true);

$servername = $ini_array["database"]["servername"];
$username = $ini_array["database"]["username"];
$password = $ini_array["database"]["password"];
$dbname = $ini_array["database"]["dbname"];

class DatabaseConnection {
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public $connection;

    // constructor
    function __construct($ini_array) {
        $this->servername = $ini_array["database"]["servername"];
        $this->username = $ini_array["database"]["username"];
        $this->password = $ini_array["database"]["password"];
        $this->dbname = $ini_array["database"]["dbname"];
        // actually connect
        $this->connection = new mysqli(
            $this->servername, 
            $this->username, 
            $this->password, 
            $this->dbname
        );
        if ($this->connection->connect_error) {
          die("Connection failed: " . $this->connection->connect_error);
        }

    }

    // destructor
    function __destruct() {
        $this->connection->close();
    }

    function query_login(string $inEmail){
        $stmt = $this-> connection -> prepare("SELECT `ID`, `username`, `password` FROM `user_pass` WHERE email=?");
        $stmt -> bind_param("s", $inEmail);
        $stmt->execute();
        return $stmt;
    }

    // query the db and display the result
    function query_database(string $query) {
        $result = $this->connection->query($query);
        return $result;
    }

    /**
     * Function to query the recipie ingridients from the database
     * @param string $rec_id
     * @return sql statement object
     */
    function query_ingridients(string $rec_id){
        $stmt = $this-> connection -> prepare("SELECT `name`
                                               FROM `ingredient`, `recipie_ingredient`, `recipie`  
                                               WHERE ingredient.ID = recipie_ingredient.ingredient 
                                               AND recipie.ID = recipie_ingredient.recipie 
                                               AND recipie.slug = ?"
                                             );
        $stmt -> bind_param("s", $rec_id);
        $stmt->execute();
        return $stmt;       
    }

    /**
     * Function to query the recipie tags from the database
     * @param string $rec_id
     * @return sql statement object
     */
    function query_tags(string $rec_id){
        $stmt = $this-> connection -> prepare("SELECT `name`
                                               FROM `tag`, `recipie_tag`, `recipie`  
                                               WHERE tag.ID = recipie_tag.tag 
                                               AND recipie.ID = recipie_tag.recipie 
                                               AND recipie.slug = ?"
                                             );
        $stmt -> bind_param("s", $rec_id);
        $stmt->execute();
        return $stmt;       
    }

    /**
     * Function to query the recipie categories from the database
     * @param string $rec_id
     * @return sql statement object
     */
    function query_categories(string $rec_id){
        $stmt = $this-> connection -> prepare("SELECT `name`
                                               FROM `category`, `recipie_category`, `recipie`  
                                               WHERE category.ID = recipie_category.category 
                                               AND recipie.ID = recipie_category.recipie 
                                               AND recipie.slug = ?"
                                             );
        $stmt -> bind_param("s", $rec_id);
        $stmt->execute();
        return $stmt;       
    }

    /**
     * Function to get a single country from the database by id
     * @param int $id
     * @return String
     */
    function get_country_by_id(int $id) {
        $query = ("SELECT * FROM country WHERE ID = " . $id);
        $result = $this->connection->query($query);
        $return = $result->fetch_all(MYSQLI_ASSOC);
        if ($return) {
            return $return[0];
        }
        else {
            // no result
            return false;
        }
    }

    /**
     * Function to query all data belonging to a certain user identified by id
     * @param int $id
     * @return sql statement object
     */
    function query_all_user_data(int $id){
        $stmt = $this-> connection -> prepare("SELECT * FROM `user_pass` WHERE user_pass.ID=?");
        $stmt -> bind_param("d", $id);
        $stmt->execute();
        return $stmt;
    }
    
    function query_all_reci_data(){
        $stmt = $this-> connection -> prepare("SELECT * FROM `recipie`, `recipie_category`, `recipie_country`, `recipie_ingredient`, `recipie_tag`, `ingredient`, `country`, `category`, `tag`
                                               WHERE ID=?");
        $stmt -> bind_param("d", $id);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Function to query all recipies belonging to a certain user identified by id
     * @param int $id
     * @return sql statement object
     */
    function query_recipies_user(int $id){
        $stmt = $this-> connection -> prepare("SELECT * FROM `recipie` WHERE (SELECT `user` FROM user_recipie WHERE user_recipie.user = ? AND user_recipie.recipie = recipie.id)");
        $stmt -> bind_param("d", $id);
        $stmt->execute();
        return $stmt;
    }
    
    /**
     * Function to query all data belonging to a certain user identified by email
     * @return sql statement object
     */
    function query_all_user_data_email(){
        $stmt = $this-> connection -> prepare("SELECT * FROM `user_pass` WHERE email LIKE ? LIMIT 10");
        $search = "{$_POST['MAIL']}%";
        $stmt -> bind_param("s", $search);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Function to get the user that has created a recipie
     * @param $recipie_uuid
     * @return sql statement object
     */
    function get_user_for_recipie($recipie_uuid){
        $stmt = $this-> connection -> prepare("SELECT * FROM `user_pass` WHERE user_pass.ID in (SELECT user FROM user_recipie WHERE user_recipie.recipie = ?)");
        $stmt -> bind_param("s", $recipie_uuid);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Function to create a new category
     * @return None
     */
    function create_category(){
        $stmt = $this -> connection -> prepare("INSERT INTO `user_pass` (`username`, `password`, `email`) VALUES (?, ?, ?)");
        $stmt -> bind_param("sss", $username, $hash, $email);
        $stmt->execute();
    }

    /**
     * Function to get a recipie by its id
     * @param string $id
     * @return array
     */
    function get_recipie_by_id(string $id) {
        $query = ("SELECT * FROM recipie WHERE slug = \"" . $id . "\"");
        $result = $this->connection->query($query);
        $return = $result->fetch_all(MYSQLI_ASSOC);
        if ($return) {
            return $return[0];
        }
        else {
            // no result
            return false;
        }
    }

    /**
     * Function to get a category by its name
     * @param string $name
     * @return array
     */
    function get_category_by_name(string $name) {
        $stmt = $this -> connection -> prepare("
        SELECT * FROM `category` WHERE name = ?;
        ");
        $stmt -> bind_param("s", 
            $name,
        );
        $result = $stmt -> execute();
        $result = $stmt -> get_result()->fetch_row();
        if (!isset($result[0])) {
            return NULL;
        }
        $stmt->close();
        return $result;
    }

    function get_country_by_name(string $name) {
        $stmt = $this -> connection -> prepare("
        SELECT * FROM `country` WHERE name = ?;
        ");
        $stmt -> bind_param("s", 
            $name,
        );
        $result = $stmt -> execute();
        $result = $stmt -> get_result()->fetch_row();
        if (!isset($result[0])) {
            return NULL;
        }
        $stmt->close();
        return $result;
    }
    function get_or_create_ingredient_by_name(string $name) {
        $stmt = $this -> connection -> prepare("
        SELECT * FROM `ingredient` WHERE name LIKE ?;
        ");
        $stmt -> bind_param("s", 
            $name,
        );
        $result = $stmt -> execute();
        $result = $stmt -> get_result()->fetch_row();
        $stmt->close();
        if (!isset($result[0])) {
            // create tag
            $stmt = $this -> connection -> prepare("
                INSERT INTO `ingredient` (`ID`, `name`) VALUES (NULL, ?);
            ");
            $stmt -> bind_param("s", 
                $name,
            );
            $result = $stmt -> execute();
            $stmt->close();
            $stmt = $this -> connection -> prepare("
            SELECT * FROM `ingredient` WHERE name LIKE ?;
            ");
            $stmt -> bind_param("s", 
                $name,
            );
            $result = $stmt -> execute();
            $result = $stmt -> get_result()->fetch_row();
        }
        return $result;
    }
    function get_or_create_tag_by_name(string $name) {
        $stmt = $this -> connection -> prepare("
        SELECT * FROM `tag` WHERE name LIKE ?;
        ");
        $stmt -> bind_param("s", 
            $name,
        );
        $result = $stmt -> execute();
        $result = $stmt -> get_result()->fetch_row();
        $stmt->close();
        if (!isset($result[0])) {
            // create tag
            $stmt = $this -> connection -> prepare("
                INSERT INTO `tag` (`ID`, `name`) VALUES (NULL, ?);
            ");
            $stmt -> bind_param("s", 
                $name,
            );
            $result = $stmt -> execute();
            $stmt->close();
            $stmt = $this -> connection -> prepare("
            SELECT * FROM `tag` WHERE name LIKE ?;
            ");
            $stmt -> bind_param("s", 
                $name,
            );
            $result = $stmt -> execute();
            $result = $stmt -> get_result()->fetch_row();
            $stmt->close();
        }
        return $result;
    }
}

function exit_with_not_found() {
    http_response_code(404);
    header("Location: /404.php");
    exit;
}

function exit_with_bad_request() {
    http_response_code(400);
    header("Location: /400.php");
    exit;
}

function test_for_bad_chars(string $input) {
    $RE_HTML_CHARS = '/(<.*>)|(&lt)|(&gt)/m';
    $matches = preg_match_all($RE_HTML_CHARS, $input);
    return ($matches > 0);
}

function test_for_bad_chars_array(array $input) {
    $RE_HTML_CHARS = '/(<.*>)|(&lt)|(&gt)/m';
    foreach ($input as $item) {
    $matches = preg_match_all($RE_HTML_CHARS, $item);
    }
    return ($matches > 0);
}

function escape_newlines(string $input) {
    //$re = '/\n/m';
    //$subst = "\\n";
    //$result = preg_replace($re, $subst, $input);
    $result = preg_replace("/\r|\n/", "", $input);
    return $result;
}

?>
