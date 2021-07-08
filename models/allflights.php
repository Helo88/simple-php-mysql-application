<?php


include_once("dbConnection.php");
$dsn = 'mysql:dbname=booking;host=127.0.0.1';
$user = 'root';
$password = '';
Database::connect($user,$password);
// echo "hello <br>";
class TRIP extends  Database {
    public static $tripID ;
    public static $seats;
    public static $peopleNo;

    function __construct() {
        $sql = "SELECT * FROM flightstables;";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        if(empty($data)){return;}
        $airports=[];
        while ($data = $statement->fetch(PDO::FETCH_ASSOC) ) {
            $d=(object)$data;
           
            
        }
    }

   public static function airports (){
        $sql = "SELECT airportname FROM flightstables;";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
        $airports=[];
        while ($data = $statement->fetch(PDO::FETCH_ASSOC) ) {
            if(empty($data)){return;}
            $airports[]=$data;
        }
        return $airports;

    }
    public static function locations (){
        $sql = "SELECT DISTINCT location FROM flightstables;";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
        $locations=[];
        while ($data = $statement->fetch(PDO::FETCH_ASSOC) ) {
            if(empty($data)){return;}
            $locations[]=$data;
        }
        return $locations;
    }
    public static function destinations (){
        $sql = "SELECT DISTINCT Destination FROM flightstables;";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
        $destinations=[];
        while ($data = $statement->fetch(PDO::FETCH_ASSOC) ) {
            if(empty($data)){return;}
            $destinations[]=$data;
        }
        return $destinations;

    }
    
    public function addtrip($airportname,$DepartDate,$LandingDate,$DepartHour,$LandingHour, $location,$Destination,$FirstClass, $EconomyClass, $BusinessClass,
    $Fseats,$Eseats,$Bseats){
        $sql = 
        "INSERT INTO flightstables ( airportname,DepartDate,LandingDate ,DepartHour, LandingHour, location,Destination,
        FirstPrices, EconomyPrices, BusinessPrices,Fseats,Eseats,Bseats
        )
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);"; //?mainly for array to string conversion
        $statement = Database::$db->prepare($sql);
        $statement->execute([$airportname,$DepartDate,$LandingDate,$DepartHour,$LandingHour, $location,$Destination,
        implode(",",$FirstClass) ,implode(",",$EconomyClass),implode(",",$BusinessClass),$Fseats,
        $Eseats,$Bseats
        ]);
    
}  

    static function calcprice ($airportname,$class,$AdultsNo,$ChildrenNo,$InfantsNo) {
        $searchClass=$class.'Prices';
        // echo $searchClass;
        $sql = "select $searchClass from flightstables  where airportname='$airportname'; ";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $prices=explode(",",$data[$searchClass]);
        // echo "pricessssss".$prices[0]*$AdultsNo+$prices[1]*$ChildrenNo+$prices[2]*$InfantsNo ."<br>";
        return $prices[0]*$AdultsNo+$prices[1]*$ChildrenNo+$prices[2]*$InfantsNo ;
            
    } 
    private static function  editDateFormat($date){
        $temp=explode("-",str_replace("/","-",$date));
        $EDepartDate=$temp[2]."-".$temp[0]."-".$temp[1];
        return $EDepartDate;
    }
   
    public static function findMatches ($DepartDate,$Departure,$Destination,$economy,$AdultsNo,$ChildrenNo,$InfantsNo){
        // echo"economy".$economy."<br>";
        // echo "find me". $DepartDate. "---". $Departure ."---". $Destination. "---".$economy. "---".$AdultsNo. "---".$ChildrenNo. "---".$InfantsNo."---"."<br>" ;
            self::$peopleNo=$AdultsNo+$ChildrenNo+$InfantsNo;
            $DepartDate=self::editDateFormat($DepartDate);
            $sql = "select A.id, A.airportname, A.DepartDate,A.LandingDate ,A.DepartHour ,A.LandingHour,A.location,A.Destination,
            A.Fseats,A.Bseats,A.Eseats
            from flightstables as A 
            where A.DepartDate ='$DepartDate' and 
            A.location='$Departure' and 
            A.Destination='$Destination'
            ; ";

            $statement = Database::$db->prepare($sql);
            $statement->execute();
            $trips=[];
            while ($data = $statement->fetch(PDO::FETCH_ASSOC) ) {
                if(empty($data)){return;}
                $trips[]=$data;
            }
            $results=[];
            // echo  count($trips)." u here <br>";
            for($x = 0; $x < count($trips); $x++) {
            if ($economy=='First'){
                // echo "first". $trips[$x]['Fseats']."<br>";
                if ($trips[$x]['Fseats'] -self::$peopleNo >=0)
                {
                    
                    array_push($trips[$x],self::calcprice($trips[$x]['airportname'],$economy,$AdultsNo,$ChildrenNo,$InfantsNo),self::$peopleNo);
                    $results[]=$trips[$x];
                    self::$tripID=$trips[$x]['id'];
                    self::$seats='Fseats';
                // self::updateRestOfSeats ($trips[$x]['airportname'],$DepartDate,$Departure,$Destination,'Fseats',$peopleNo);

                }
            }
                if($economy=='Economy'){
                    // echo "economy". $trips[$x]['Eseats']."<br>";
                    if ($trips[$x]['Eseats'] -self::$peopleNo >=0 )
                        {
                    array_push($trips[$x],self::calcprice($trips[$x]['airportname'],$economy,$AdultsNo,$ChildrenNo,$InfantsNo),self::$peopleNo);
                    $results[]=$trips[$x];
                    self::$tripID=$trips[$x]['id'];
                    self::$seats='Eseats';
                // self::updateRestOfSeats ( $trips[$x]['airportname'],$DepartDate,$Departure,$Destination,'Eseats',$peopleNo);
                        }
            }
            if($economy=='Business'){
                    // echo "Busines;;;;s". $trips[$x]['Bseats']."<br>";
                    if ($trips[$x]['Bseats'] - self::$peopleNo  >=0 )
                    {
            
                array_push($trips[$x],self::calcprice($trips[$x]['airportname'],$economy,$AdultsNo,$ChildrenNo,$InfantsNo),self::$peopleNo);
                $results[]=$trips[$x];
                self::$tripID=$trips[$x]['id'];
                self::$seats='Bseats';
                // self::updateFlightDB();
                //self::updateRestOfSeats ( $trips[$x]['airportname'],$DepartDate,$Departure,$Destination,'Bseats',$peopleNo);
                    }

            }
        }
            // echo "print query res <br>";
            // print_r($results);
            // echo "<br> <br>";
            return $results;
                
        
    }
    public static function updateFlightDB (){
        // echo"jjk".self::$tripID."-".self::$seats."--".self::$peopleNo."<br>";
        $id=self::$tripID;
        $economy=self::$seats;
        $peopleNumber=self::$peopleNo;
        // echo"econoaaamy       ".$economy. "<br>";
        $sql = "UPDATE flightstables
        SET $economy = $economy - $peopleNumber
        WHERE id='$id';";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
   
        
    }
    // check inputs function & modify input date format
    public  static function echoing ($timeIn,$airportin,$airportout,$economy,$adultsNo,$kidsNo,$infantsNo) {
        // echo "echoing past " . $timeIn ."<br> <br>"; 
        $timeIn=str_replace("/","-",$timeIn);
        $er=explode("-",$timeIn);
        $r=$er[2]."-".$er[0]."-".$er[1];
        echo "echo me". $timeIn. "---". $airportin ."---". $airportout. "---".$economy. "---".$adultsNo. "---".$kidsNo. "---".$infantsNo."---".$r."<br>" ;
        // print_r($er);
        // echo "<br>" .$er[0]. "---".$er[1]. "<br>";
    }
    public static function deleteAllrows(){
        $sql="DELETE FROM flightstables; ";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
    }
    public static function  addConstraintDepartDate (){ //timingc constraint
        $sql="
            CREATE TRIGGER rightDepartDate
            BEFORE INSERT ON flightstables
            FOR EACH ROW
        BEGIN          
            IF NEW.DepartDate < CURRENT_DATE  THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date isnot valid';
            END IF;
        END;
       ; ";
        $statement = Database::$db->prepare($sql);
        $statement->execute();

     }
     public static function  addConstraintLandingDate (){ //timingc constraint
        $sql="
            CREATE TRIGGER rightLandingDate
            BEFORE INSERT ON flightstables
            FOR EACH ROW
        BEGIN          
            IF NEW.LandingDate <=  New.DepartDate  THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date isnot valid';
            END IF;
        END;
       ; ";
        $statement = Database::$db->prepare($sql);
        $statement->execute();

     }




}
$d1=new Trip();
// to delete all rows run this once then comment it 
// TRIP::deleteAllrows();

/********************************************/
// to add trips run those then comment 'em 

// $d1->addtrip('sd4','2021-07-09','2021-07-19' ,'3:02:11', '21:02:11', 'aswan','berlin',array(260,890,80),array(70,89,90),array(160,390,870)
// ,60,130,80);
// $d1->addtrip('sd1','2021-08-09','2021-08-19' ,'3:02:11', '21:02:11', 'aswan','berlin',array(260,890,80),array(70,89,90),array(160,390,870)
// ,60,130,80);
// $d1->addtrip('sd2','2021-08-09','2021-08-19' ,'3:02:11', '21:02:11', 'aswan','berlin',array(260,890,80),array(70,89,90),array(160,390,870)
// ,60,130,80);
// $d1->addtrip('sd3','2021-08-09','2021-08-19' ,'3:02:11', '4:02:11', 'Cairo','Alex',array(260,890,80),array(70,89,90),array(160,390,870)
// ,60,130,80);
// $d1->addtrip('sd3','2021-08-09','2021-08-19' ,'3:02:11', '6:02:11', 'Luxor','Alex',array(260,890,80),array(70,89,90),array(160,390,870)
// ,60,130,80);
/**************to check function find matches************* */
// $r=$d1->findMatches ('2021-07-09','aswan','berlin','Economy',1,0,0);
// // print_r($r[1]);
// // echo "<br> <br> <br>";
// // print_r($r[0][0]);
// for($i=0;$i<count($r);$i++) {
//     print "$i \n";
//     foreach ($r[$i] as $key => $value) {
//        print   $r[$i]['airportname'] ;
//        echo "<div>jj</div>";
//     }
//     echo "<br><br>";
// }

?>