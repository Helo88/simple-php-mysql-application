<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="discribtion" content="welecome">
     <!-- start IE combability meta -->
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <!-- start viewport mobile -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>My website booking now our flight</title>
     <!-- google fonts -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Amaranth:ital,wght@0,400;0,700;1,400;1,700&family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
     <!-- end google fonts -->
     <!-- start for date dropper -->
     <link href="css/datedropper.css" rel="stylesheet"/>
     <link href="css/my-style.css" rel="stylesheet"/>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script src="js/datedropper.js"></script>
     <!-- end for date dropper -->
     <!-- start normalization -->
     <link rel="stylesheet" href="css/normalize.css">
     <!-- start webfonts -->
     <link rel="stylesheet" href="./css/all.min.css">
     <!-- start bootstrap -->
     <link rel="stylesheet" href="./css/bootstrap.min.css">
     <!-- start style css -->
     <link rel="stylesheet" href="./css/probook.css">

</head>

     <body>
     

     <?php
	include_once('./models/allflights.php');
     $airportin = $airportout = $timeIn = $adultsNo =$kidsNo = $infantsNo=$economy= "";
    ?>
     
       
          <div class="loader-main" id="loadingMain">
               <div class="loader2"><img src="images/Settings (1).gif" alt="#" /></div>
          </div>
          <section id="booking">
               <div class="container" id="overHidden">
                    <div class="check-form" id="checkForm">
                         <div class="heading">
                              <p>where <br> do you want to</p>
                              <h1>Explore.</h1>
                         </div>
                         <form class="form-book"id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                              <div class="container-fluid">
                              <!-- start row -->
                              <div class="row">
                                   <!-- start col -->
                                   <div class="col-12 px-1">
                                        <div class="btn-group btn-group-toggle rounded-pill mb-2" data-toggle="buttons">
                                             <label class="btn btn-secondary px-4 active btn-radio">
                                             <input type="radio" name="options" id="option1" checked> Round trip
                                             </label>
                                             <label class="btn btn-secondary px-4 btn-radio">
                                             <input type="radio" name="options" id="option2"> One way
                                             </label>
                                        </div> 
                                   </div>
                                   <!-- end col -->
                                   <!-- start col -->
                                   <div class="col-12 col-lg-10 px-1">
                                        <div class="inputs-form">
                                             <div class="top">
                                                  <!-- start input airport in -->
                                                  <input readonly  id="airportIn" class="airport rounded" type= "text" placeholder="   Airport in">
                                                  <span class="icon-air"><i class="fas fa-plane-departure"></i></span>
                                                  <span id="exchange"><i class="fas fa-exchange-alt"></i></span>
                                                  <div class="show" id="showIn">
                                                       <input  required list="airporto" name="airportin" id="airportInsideIn" class="air-inside" type= "text" placeholder="   Airport in">
                                                       
                                                       <h5 class="my-2">The nearest airport </h5>
                                                       <ul class="list-group list-group-flush" id="airportListIn">
                                                        <?php
                                                        $locations =TRIP::locations();
                                                        foreach ($locations as $location) {
                                                        ?>  
                                                            <li class="list-group-item"><?=$location['location']?></li>
                                                            <!-- <li class="list-group-item">Egypt Old Airport</li>
                                                            <li class="list-group-item">Alexandria International Airport</li>
                                                            <li class="list-group-item">Port Said International Airport</li>
                                                            <li class="list-group-item">Sphinx Airport</li>
                                                            <li class="list-group-item">Borg El Arab International Airport, Alexandria</li> -->
                                                        <?php } ?>
                                                       </ul>
                                                  </div>
                                                  <!-- end input airport in -->
                                                  <!-- start input airport out -->
                                                  <input readonly  id="airportOut"  class="airport rounded" type= "text" placeholder="   Airport out">
                                                  <span class="icon-air icon-out"><i class="fas fa-plane-departure"></i></span>
                                                  <div class="show showOut" id="showOut">
                                                       <input  required id="airportInsideOut" name="airportout" class="air-inside" type= "text" placeholder="   Airport in">
                                                       <h5 class="my-2">The nearest airport </h5>
                                                       <ul class="list-group list-group-flush" id="airportListOut">
                                                        <?php
                                                        $destinations =TRIP::destinations();
                                                        foreach ($destinations as $destination) {
                                                        ?>    
                                                        <li class="list-group-item"><?=$destination['Destination']?></li>
                                                            <!-- <li class="list-group-item">Kuwait International Airport</li>
                                                            <li class="list-group-item">Dubai International Airport</li>
                                                            <li class="list-group-item">Saudi Arabian Airport</li>
                                                            <li class="list-group-item">Embassy Of The United States Of America, Cairo</li>
                                                            <li class="list-group-item">Doha Airport Arrivals Building</li>
                                                            <li class="list-group-item">Queen Alia International Airport</li> -->
                                                            <?php } ?>
                                                       </ul>
                                                  </div>
                                                  <!-- end input airport out -->
                                             </div>
                                             <!-- end top div -->
                                             <!-- start bottom div -->
                                             <div class="bottom">
                                                  <!-- start input time in -->
                                                  <input required class="my-2 rounded" id="timeIn" name="timeIn" type="text" data-large-mode="true" data-large-default="true" data-lock="from" data-translate-mode="true" data-theme="my-style"/>
                                                  
                                                  <span class="date-icon"><i class="far fa-calendar-alt"></i></span>
                                                  <!-- end input time in -->
                                                  <!-- start input time out -->
                                                  <input  required class="my-2 rounded" id="timeOut" name="timeOut" type="text" data-large-mode="true" data-large-default="true" data-lock="from" data-translate-mode="true" data-theme="my-style"/>
                                                 
                                                  <span class="date-icon date-icon-out"><i class="far fa-calendar-alt"></i></span>
                                                  <!-- end input time out -->   
                                                  <!-- start counter input -->
                                                  <button type="button" class="btn btn-primary dropdown-toggle ctr-btn" id = "adultBtn">adults</button>
                                                  <div class="show-counter" id="showCounter">
                                                       <div class="counter-inside text-center">
                                                            <div class="left">
                                                                 <span class="align-self-center"><i class="fas fa-male mx-2 "></i>  Adults &gt; 12 </span>
                                                            </div>
                                                            <div class="right">
                                                                 <span id="sub" type="button" class="btn-count">-</span>
                                                                 <input  required type="text" id="qtyBox" name="adultsNo"  value="1" class="counter">
                                                                 <span id="add" type="button" class="btn-count">+</span>
                                                            </div>
                                                            <!-- second childern -->
                                                            <div class="left">
                                                                 <span class="align-self-center"><i class="fas fa-male mx-2 "></i>  Child &lt; 12 </span>
                                                            </div>
                                                            <div class="right">
                                                                   <span id="sub1" type="button" class="btn-count">-</span>
                                                                   <input  required type="text" id="qtyBox1" name="kidsNo" readonly="" value="0" class="counter">
                                             
                                                                   <span id="add1" type="button"  class="btn-count">+</span>
                                                            </div>
                                                            <!-- second childern -->
                                                            <div class="left">
                                                                 <span class="align-self-center"><i class="fas fa-male mx-2 "></i>  Infants &lt; 2 </span>
                                                            </div>
                                                            <div class="right">
                                                                   <span id="sub2" type="button"   class="btn-count">-</span>
                                                                   <input  required type="text" id="qtyBox2" name="infantsNo" readonly="" value="0" class="counter">     
                                                                   <span id="add2" type="button"  class="btn-count">+</span>
                                                            </div>
                                                            <!-- <button type="button" class="btn btn-dark rounded-pill mx-auto mt-1" id="counterDone">Done</button> -->
                                                       </div>
                                                  </div>
                                                  <!-- end counter input -->
                                                  <button type="button" class="btn btn-primary dropdown-toggle bussness-btn" id="EconomyInput">Economy</button>
                                                  <div class="busness-show" id= "Economy">
                                                       <select  required class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" name="economy">
                                        
                                                            <option selected="selected"> <i class="fas fa-check m-2 text-danger active"></i>Economy</option>
                                                            <option><i class="fas fa-check m-2 text-success"></i>Business</option>
                                                            <option><i class="fas fa-check m-2 text-success"></i>First</option>
                                                       </select> 
                                                  </div>
                                             </div>
                                             <!-- end bottom div -->
                                        </div>
                                   </div>
                                   <!-- end col -->
                                   <!-- start col -->
                                   <div class="col-12 col-lg-2 px-1">
                                   <input  type="submit" name =submit style="display:block;width:100%">
                                        <div class="submit" id=search >
                                                            <a href="#planes" class="search-planes rounded"> 
                                                                 <span></span>
                                                                 <span></span>
                                                                 <span></span>
                                                                 <span></span>
                                                                 Search
                                                            </a>                         
                                        </div>
                                   </div>
                                   <!-- end col -->
                              </div>
                              <!-- end row -->
                            </form>
                         </div>
                    </div>
                   <?php 
               //     echo  TRIP::echoing($timeIn,$airportin,$airportout,$economy,$adultsNo,$kidsNo,$infantsNo)  
                   ?>
                    <div class="planes d-flex justify-content-center align-items-start" id="planes">
                         <div class="loader_bg" id="loading">
                              <img src="images/loading.gif" alt="jj" />
                         </div>
                         <?php
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $airportin= $_POST["airportin"];
                            $airportout= $_POST["airportout"];
                            $timeIn= $_POST["timeIn"];
                            $adultsNo= $_POST["adultsNo"];
                            $economy= $_POST["economy"];
                            $kidsNo= $_POST["kidsNo"];
                            $infantsNo= $_POST["infantsNo"];
                         //    echo TRIP::echoing($timeIn,$airportin,$airportout,$economy,$adultsNo,$kidsNo,$infantsNo) ;
                    
                    // $people=$adultsNo+$kidsNo+$infantsNo;
                  
                    if((int)$adultsNo<(int)$kidsNo || (int)$adultsNo<(int)$infantsNo ){echo'<h1 style="margin:auto; color:red">  children or infants number must br lower than adults number <h1>'  ; }
                    else {
                    $matches =TRIP::findMatches($timeIn,$airportin,$airportout,$economy,$adultsNo,$kidsNo,$infantsNo);
                    // echo "here is count".count($matches) ."<br>";
                    if(count($matches)==0) { echo'<h1 style="text-align:center; color:red">  No Results <h1>'  ;   } 
                    else {                      
                         for($i=0; $i<count($matches);$i++) {
                     


               ?>
                         <div class="ticket">
                              <div class="ticket-left">
                                   <img class="path" src="images/curved-dotted-line-png.png">
                                   <!-- start row -->
                      
                                   <div class="row">
                                
                                     
                                        <!-- start col -->
                                        <div class="col-3 text-center">
                                             <p class="p-0 m-0 text-muted"><?=$matches[$i]['airportname']?></p>
                                             <h2 class="p-0 m-0"><?=$matches[$i]['location']?></h2>
                                             <p class="date p-0 m-0"><?=$matches[$i]['DepartDate']?></p>
                                             <p class="dateH p-0 m-0"><?=$matches[$i]['DepartHour']?></p>
                                             <p class="py-1 m-0 text-muted" >passenger No : <span class="text-danger"><?=$matches[$i][1]?></span></p>
                                        </div>
                                        <!-- end col -->
                                        <!-- start col -->
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                             <img class="plane-icon"src="images/airplane.png">
                                        </div>
                                        <!-- end col -->
                                        <!-- start col -->
                                        <div class="col-3 text-center">
                                             <!-- <p class="p-0 m-0 text-muted">To</p> -->
                                             <h2 class="p-0 m-0"><?=$matches[$i]['Destination']?></h2>
                                             <p class="date p-0 m-0"><?=$matches[$i]['LandingDate']?></p>
                                             <p class="dateH p-0 m-0"> <?=$matches[$i]['LandingHour']?></p>
                                             <p class="py-1 m-0 text-muted">Flight : <span class="text-danger"><?$economy?></span></p>
                                        </div>
                                        <!-- end col -->
                                        <!-- start col -->
                                        <div class="col-3 ">
                                             <img class="barcode" src="images/parcode.png">
                                        </div>
                                        <!-- end col -->
                                        <!-- start col -->
                                        <div class="col-12 py-2 ">
                                             <a href="#" class="btn btn-outline-danger w-100" > <?php echo $matches[$i][0]; TRIP::updateFlightDB();?> </a>
                                        </div>
                                
                                        <!-- end col -->
                                      
                                  
                                        
                                   </div>
                                   <!-- end row -->
                                
                              </div>
                              
                         </div>
                         <?php  
                                             } }
                                    }}
                                    ?>
                    </div>     
               </div>
          </section>
          <script>
          $('#timeIn').dateDropper();
          $('#timeOut').dateDropper();
          </script>


          <!-- start jqueery -->
          <script src="js/jquery-3.5.1.slim.min.js"></script>
          <script src="js/popper.min.js"></script>
          <script src="js/bootstrap.js"></script>
          <script src="js/proj.js"></script>
     </body>

</html>     