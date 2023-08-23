<?php 

namespace apiZ;

use PDO;
use PDOException;

class System{
    protected static $connection; /** SADECE System SINIFI İÇERİSİNDE VE SINIFI MİRAS ALAN SINIFLARDA KULLANILIR */
    /** self static değişkenlerde kullanılır oyuzden değişkeni static olarak tanımladık */
    
    /** Veri tabanı değişkenleri son */

    public static $table; /** Static bir tablo değişkeni oluşturuyoruz */
    public static $select = "*";
    public static $whereRawKey;
    public static $whereRawVal;
    public static $whereKey;
    public static $whereVal = array();
    public static $orderby = NULL;
    public static $limit = NULL;
    public static $join = "";
    public static $leftJoin = ""; 
    public static $option = true;
    function __construct()
    {
        self::__connect();
    }

    /** Database bağlantısı */
    public static function __connect(){
        try{
            self::$connection = new PDO("mysql:host=localhost; dbname=101m; charset=utf8", 'root', '');
        }catch(PDOException $e){
            echo $e -> getMessage();
        }
    }


    /**Tablo adını belirler */
    public static function table($tableName){ 
        self::$table = $tableName;
        self::$select="*";
        self::$whereRawKey = NULL;
        self::$whereRawVal = NULL;
        self::$whereKey = NULL;
        self::$whereVal = NULL;
        self::$orderby = NULL;
        self::$limit = NULL;
        self::$join = "";
        self::$leftJoin = "";
        self::$option = "";
        return new self;
    }

    /**Kolon || Kolonları belirler örn: select('id','title') id ve title kolonları seçildi */
    public static function select($columns){    /** array string cevirme */
        self::$select = (is_array($columns)) ? implode(",",$columns) : $columns;
        return new self;
    }

    /**Özel where sorgusu örn: whereRaw('title = ? and id = ?',['titleDeger','idDeger']) */
    public static function whereRaw($whereRaw,$whereRawVal){
        self::$whereRawKey = "(".$whereRaw.")";
        self::$whereRawVal = $whereRawVal;
        return new self;
    }

    /**Where alanı | opt true ise and döner false ise or */
    public static function where($columns1,$columns2 = NULL,$columns3 = NULL,$opt = true){
        if(is_array($columns1) != false){ 
            $keyList = array();
            foreach($columns1 as $key => $item){
                self::$whereVal[] = $item;
                $keyList[] = $key;
            }
            self::$whereKey = ($opt == true) ? self::$whereKey = implode(" = ? and ",$keyList)." = ?" : self::$whereKey = implode(" = ? or ",$keyList)." = ?";
        }elseif($columns2 != NULL && $columns3 == NULL){
            self::$whereVal[] = $columns2; 
            self::$whereKey=$columns1." = ?";
        }elseif ($columns3 != NULL) { 
            self::$whereVal[] = $columns3;
            self::$whereKey = $columns1." ".$columns2." ?"; 
        }
        self::$option = $opt; 
        return new self;
    }

    /**Orderby alanı default ASC örn: orderby(id,DESC) */
    public static function orderby($parameter = array()){ 
        self::$orderby=$parameter[0]." ".((!empty($parameter[1])) ? $parameter[1] : "ASC"); 
        return new self;
    }

    /**LIMIT alanı limit(1,5) */
    public static function limit($start,$end = NULL){ 
        self::$limit = $start.(($end != NULL) ? ",".$end : "");
        return new self;
    }

    /**İnner Join alanı */
    public static function join($tableName, $thisColumns, $joinColumns){ /** İNNER JOİN FUNCTİONU */
        self::$join.="INNER JOIN ".$tableName." ON ".self::$table.".".$thisColumns."=".$tableName.".".$joinColumns." ";
        return new self;
    }

    /**Left Join Alanı */
    public static function leftjoin($tableName, $thisColumns, $joinColumns){ /** LEFT JOİN FUNCTİONU */
        self::$leftJoin.="LEFT JOIN ".$tableName." ON ".self::$table.".".$thisColumns."=".$tableName.".".$joinColumns." ";
        return new self;
    }

    /** Sorgu çalıştırma alanı verilerin hepsini çeker */
    public static function get(){
        $sql = "SELECT ".self::$select." FROM ".self::$table." ";
        $sql.= (!empty(self::$join)) ? self::$join : "";
        $sql.= (!empty(self::$leftJoin)) ? self::$leftJoin : "";
        $where = NULL;
        if(!empty(self::$whereKey) && !empty(self::$whereRawKey)){
            $sql.="WHERE ".self::$whereKey." ".self::$option." ".self::$whereRawKey." ";
            $where = array_merge(self::$whereVal,self::$whereRawVal);
            
        }else{
            if(!empty(self::$whereKey)) {
                $sql.="WHERE ".self::$whereKey." ";
                $where = self::$whereVal;
            }elseif (!empty(self::$whereRawKey)) {
                $sql.="WHERE ".self::$whereRawKey." ";
                $where = self::$whereRawVal;
            }
        }

        $sql .= (!empty(self::$orderby)) ? "ORDER BY ".self::$orderby." " : "";
        $sql .= (!empty(self::$limit)) ? "LIMIT ".self::$limit : "";

        if($where != NULL){
            $entity = self::$connection -> prepare($sql);
            $sync = $entity -> execute($where);
        }else{
            $entity = self::$connection -> query($sql);
        }

        $result = $entity -> fetchAll(PDO::FETCH_ASSOC);
        if($result != false){
            $data = [];
            foreach($result as $item){
                $data[] =(object) $item;
                
            }

            if(count($data)>1){
                return $data;
            }else{
                return $data;
            }
            
        }else{
            return false;
        }   
    }

   /** Sorgu çalıştırma alanı 1 adet veri çeker */
    public static function first(){ 
        $entity = self::get();
        if($entity){
            return $entity[0];
        }else{
            return false;
        }
    }

    /**Veri ekleme */
    public static function create($arrayColumns){
        $columns = array_keys($arrayColumns); 
        $columnsVal = array_values($arrayColumns);

        $sql = "INSERT INTO ".self::$table." SET ".implode(" = ?, ",$columns)." = ? ";
        $entity = self::$connection -> prepare($sql);
        $sync = $entity -> execute($columnsVal);

        if($sync != false){
            return true;
        }else{
            return false;
        }

    }

    /**Veri güncelleme */
    public static function update($arrayColumns){
        $columns = array_keys($arrayColumns); 
        $columnsVal = array_values($arrayColumns); 

        $sql = "UPDATE ".self::$table." SET ".implode(" = ?, ",$columns)." = ?";
        $where = NULL;
        if(!empty(self::$whereKey) && !empty(self::$whereRawKey)){
            $sql.="WHERE ".self::$whereKey." ".self::$option." ".self::$whereRawKey." ";
            $where = array_merge(self::$whereVal,self::$whereRawVal);
            
        }else{
            if(!empty(self::$whereKey)) {
                $sql.="WHERE ".self::$whereKey." ";
                $where = self::$whereVal;
            }elseif (!empty(self::$whereRawKey)) {
                $sql.="WHERE ".self::$whereRawKey." ";
                $where = self::$whereRawVal;
            }
        }

        if($where != NULL){
            $arrayColumns = array_merge($columnsVal,$where);
        }

        $entity = self::$connection -> prepare($sql);
        $sync = $entity -> execute($arrayColumns);

        if($sync != false){
            return true;
        }else{
            return false;
        }
    }

    /**Veri silme */
    public static function delete(){
        $sql = "DELETE FROM ".self::$table." ";
        $where = NULL;
        if(!empty(self::$whereKey) && !empty(self::$whereRawKey)){
            $sql.="WHERE ".self::$whereKey." ".self::$option." ".self::$whereRawKey." ";
            $where = array_merge(self::$whereVal,self::$whereRawVal);
            
        }else{
            if(!empty(self::$whereKey)) {
                $sql.="WHERE ".self::$whereKey." ";
                $where = self::$whereVal;
            }elseif (!empty(self::$whereRawKey)) {
                $sql.="WHERE ".self::$whereRawKey." ";
                $where = self::$whereRawVal;
            }
        }

        $entity = self::$connection -> prepare($sql);
        $sync = $entity -> execute($where);

        if($sync != false){
            return true;
        }else{
            return false;
        }

    }

    public static function filter($val,$tf = false){
        if($tf == false){$val = strip_tags($val);} /**HTML TAGLARINI TEMİZLEME */
        $val = addslashes(trim($val)); /**SQL INJECTION KORUMASI */
        return $val;
    }

    /** Hata sayfaları görüntüleme*/
    public static function view($page,$errorData){
        $file = "errors/".$page.".php";

        if(file_exists($file)){
            include_once($file);
        }elseif(file_exists("../".$file)){
            include_once("../".$file);
        }
    }

    public static function isAllowed($ip) {
        $whitelist = array('20.199.82.120', "::1", "localhost", "127.0.0.1");

        // If the ip is matched, return true
        if(in_array($ip, $whitelist)) {
            return true;
        }

        foreach($whitelist as $i){
            $wildcardPos = strpos($i, "*");

            // Check if the ip has a wildcard
            if($wildcardPos !== false && substr($ip, 0, $wildcardPos) . "*" == $i) {
                return true;
            }
        }

        return false;
    }

    public static function getIp() {
        $ip = "";
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}

?>