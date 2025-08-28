<?php 
class Db {
    private $hostname = 'localhost';
    private $username = 'mvjobvac_mycareers';
    private $password = 'LkCarrers@123';
    private $database = 'mvjobvac_mycareers';
    private $conn = NULL;
    public function __construct() { 
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database); 
        if(!$this->conn) {
            echo 'Database not connected';
        }
    }
    public function getTouristCity(){
        $query = "SELECT * FROM users where id in (SELECT user_id FROM documents)";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function getVisitingPlaces(){
        $query = "SELECT * FROM documents Where status = '1'  order by unix_timestamp(date_created) desc";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function getVisitinPlaceData($cityid, $placeid , $keyword){
        $sWhere = '';
        $where = array();
        if($cityid > 0) {
            $where[] = 'V.user_id = '.$cityid;
        }
        if($placeid > 0) {
            $where[] = 'V.id = '.$placeid;
        }
        if($keyword != '') {
            $keyword = trim($keyword);
            $where[] = "( V.tag LIKE '%$keyword%' OR  V.position LIKE '%$keyword%'  OR  C.recruiter LIKE '%$keyword%' )";
        }
        $sWhere     = implode(' AND ', $where);
        if($sWhere) {
            $sWhere = 'WHERE '.$sWhere;
        } 
        if(($cityid > 0) || ($placeid > 0) || ($keyword != '')) {
            $query = "SELECT * FROM documents $sWhere ";
            $result = mysqli_query($this->conn, $query);
            return $result;
        }
    }
}
?>