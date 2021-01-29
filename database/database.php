<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class database {

    private $db_host = "";
    private $db_user = "";
    private $db_password = "";
    private $db_database = "";
    public $con;
    //for file upload
    public $rootpath = '/';
    public $sitepath = '/';
    public $slash = '/'; //local(\) or online(/)

    //Create Conction object

    public function __construct($h, $u, $p, $db) {
        $this->db_host = $h;
        $this->db_user = $u;
        $this->db_password = $p;
        $this->db_database = $db;
        $this->con = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_database) or die(mysql_error());
    }

    function __destruct() {
        mysqli_close($this->con);
    }

    //Select all row and return an array
    function selectRows($table, $cols = '', $condtion = '', $limit = '', $offset = '') {
        if ($cols == "") {
            $cols = "*";
        } else if (is_array($cols)) {
            $cols = implode(",", $cols);
        }
        if (isset($condtion) && $condtion != '') {
            if (is_array($condtion)) {
                $condtion = 'where ' . implode(" and ", $condtion);
            } else if (!(strpos($condtion, "where") !== false)) {
                $condtion = 'where ' . $condtion;
            }
        }

        if (isset($limit) && $limit != '') {
            $limit = "limit $limit";
            if (isset($offset) && $offset != '') {
                $offset = "offset $offset";
            }
        }

        $query = "select $cols from $table $condtion $limit $offset";
        $result = $this->con->query($query) or die("Select Rows Error: " . mysqli_error($this->con) . " " . $query);
        if ($col_count = mysqli_num_fields($result) > 0) {
            $data = array();
            $ii = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$ii] = $row;
                $ii++;
            }
            return $data;
        } else
            return false;
    }

    //Select using query
    function selectQuery($query) {
        $result = $this->con->query($query) or die("Select Query Error: " . mysqli_error($this->con) . " " . $query);
        if ($col_count = mysqli_num_fields($result) > 0) {
            $data = array();
            $ii = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$ii] = $row;
                $ii++;
            }
            return $data;
        } else
            return false;
    }

    //Count Number of rows.
    function countRows($table, $condtion = '', $limit = '', $offset = '') {
        if (isset($condtion) && $condtion != '') {
            if (is_array($condtion)) {
                $condtion = 'where ' . implode(" and ", $condtion);
            } else if (!(strpos($condtion, "where") !== false)) {
                $condtion = 'where ' . $condtion;
            }
        }

        if (isset($limit) && $limit != '') {
            $limit = "limit $limit";
            if (isset($offset) && $offset != '') {
                $offset = "offset $offset";
            }
        }

        $query = "select count(ID) from $table $condtion $limit $offset";
        //echo $query;
        $count = 0;
        $result = $this->con->query($query) or die("Count Error: " . mysqli_error($this->con) . " " . $query);
        if (mysqli_num_fields($result) > 0) {
            $row = mysqli_fetch_array($result);
            $count = $row[0];
        }
        return $count;
    }

    //insert data
    function insertData($table, $dataarray) {
        $cols = '';
        $val = '';
        if (is_array($dataarray) && count($dataarray)) {
            $cols = implode(",", array_keys($dataarray));
            $val = "'" . implode("','", $dataarray) . "'";
        }
        $query = "insert into $table($cols) values($val)";
        //print_r($query);
        $r = $this->con->query($query) or die("Insert Error: " . mysqli_error($this->con) . " " . $query);
        if ($r == 1)
            return $this->con->insert_id;
        else
            return false;
    }

    function deleteData($table, $condtion) {
        if (isset($condtion) && $condtion != '') {
            if (is_array($condtion)) {
                $condtion = 'where ' . implode(" and ", $condtion);
            } else if (!(strpos($condtion, "where") !== false)) {
                $condtion = 'where ' . $condtion;
            }
            $query = "delete from $table $condtion";
            //echo $query;
            $r = $this->con->query($query) or die("Delete Error: " . mysqli_error($this->con) . " " . $query);
            if ($r == 1)
                return true;
            else
                return false;
        }
    }

    //update Data
    function updateData($table, $dataarray, $condtion = '') {
        $data = '';
        if (is_array($dataarray) && count($dataarray)) {
            $cols = array_keys($dataarray);
            $temp = array();
            for ($i = 0; $i < (int) count($dataarray); $i++) {
                $temp[] = $cols[$i] . "='" . $dataarray[$cols[$i]] . "'";
            }
            $data = implode(",", $temp);
        }
        if (isset($condtion) && $condtion != '') {
            if (is_array($condtion)) {
                $condtion = 'where ' . implode(" and ", $condtion);
            } else if (!(strpos($condtion, "where") !== false)) {
                $condtion = 'where ' . $condtion;
            }
        }

        $query = "update $table set $data $condtion";
        //echo $query;die;
        $r = $this->con->query($query) or die("Update Error: " . $query);
        if ($r == 1)
            return true;
        else
            return false;
    }

    //file Upload
    function fileUpload($ftemppath, $dirPath, $filename, $extension) {
        //echo $filename;
        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0777, true);
            touch("index.php");
        }
        $filename = $filename . '_' . time() . '.' . $extension;
        if (move_uploaded_file($ftemppath, $dirPath . $filename)) {
            return $filename;
        } else {
            return false;
        }
    }

    //file Size Check
    function imageSizeCheck($inputname, $fsize, $fwidth, $fheight) {
        // print_r($inputname);
        $fsize = $fsize * 1024;
        $image_info = getimagesize($_FILES['image']["tmp_name"]);
        $width = $image_info[0];
        $height = $image_info[1];
        //echo "{$_FILES['image']["size"]} $width $height";
        if ($_FILES['image']["size"] <= $fsize && $width == $fwidth && $height == $fheight) {
            return true;
        } else {
            return false;
        }
    }

    //Compress Image 
    function imageUploadCompressed($source, $destination, $quality) {
        $dir = explode($this->slash, $destination);
        array_pop($dir);
        $dir = implode($this->slash, $dir);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);
        else 
            return false;
        imagejpeg($image, $destination, $quality);
        return true;
    }

    function imageRemove($url = '') {
        $url = $this->rootpath . str_replace("/", $this->slash, $url);
        if (file_exists($url)) {
            unlink($url);
            return true;
        } else {
            return false;
        }
    }

    //order Child parent
    function flatter($node) { //support function for order category
        //Create an array element of the node                                            
        $array_element = array('ID' => (string) $node['ID'],
            'cat_parent' => (string) $node['cat_parent'], 'cat_name' => (string) $node['cat_name'], 'cat_level' => (int) $node['cat_level'], 'cat_img' => (string) $node['cat_img']);
        //Add all children after me                                                                
        $result = array($array_element);
        foreach ($node['children'] as $child) {
            $result = array_merge($result, $this->flatter($child));
        }
        return $result;
    }

    

}

global $db;

    $db = new database('localhost', 'root', '', 'multiform');


//echo $db->sitepath."<br>";
//echo $db->rootpath."<br>";
