$(function ( ) {
     'use strict'
     // adjust slider height .
     var winH = $(window).height(),
          upperH = $('.navbar').innerHeight();
          $('#home , .slide-item').height(winH - upperH); 
})


// booking page start
     var myAirportIn = document.getElementById('airportIn'),
          myAirportOut = document.getElementById('airportOut'),
          myInsideIn = document.getElementById('airportInsideIn'),
          myInsideOut = document.getElementById('airportInsideOut'),
          myAirportListIn = document.getElementById('airportListIn'),
          myAirportListOut = document.getElementById('airportListOut'),
          myShowIn = document.getElementById('showIn'),
          myTimeIn = document.getElementById('timeIn'),
          mypickerIn = document.querySelector('.picker'),
          myTimeOut = document.getElementById('timeOut'),
          myAdultBnt = document.getElementById('adultBtn'),
          myShowCounter = document.getElementById('showCounter'),
          myEconamy = document.getElementById('Economy'),
          myEconamyBtn = document.getElementById('EconomyInput'),
          myShowOut = document.getElementById('showOut'),
          mySearch = document.getElementById('search'),
          myPlanes = document.getElementById('planes'),
          myContainerHidden = document.getElementById('overHidden'),
          myCheckForm = document.getElementById('checkForm'),
          myloadingMain = document.getElementById('loadingMain');
               console.log(myPlanes)

     // start onload --------
     window.onload = function(){
          myloadingMain.style.display = "none";
     }
     mySearch.addEventListener('click' , function() {
          $(function () {

               "use strict";
          
               /* Preloader
               -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */
     
          
          //---
          setTimeout(function () {
               var myLoading = document.getElementById('loading');
               myLoading.style.display = "none";
          }, 8000);

     })
     }) 
          

     
     // end onload --------
// start input airport in---------
     myAirportIn.onclick = function() {
          myShowIn.style.display = "block";
          myShowOut.style.display = "none";
          myShowIn.style.opacity = "1";
          myShowIn.style.transition = "all 0.4s";
          myShowCounter.style.display = "none";

     }
     myInsideIn.onclick = function() {
          myShowIn.style.display = "none";
     }

     for( var i = 0 ; i < myAirportListIn.children.length ; i++) {
          myAirportListIn.children[i].onclick = function() { 
               myInsideIn.value = this.innerHTML;
               myAirportIn.value = this.innerHTML;
               myShowIn.style.display = "none";
          }
     }
     
     //end input airport in---------
     // start input airport out---------
     myAirportOut.onclick = function() {
          myShowOut.style.display = "block";
          myShowIn.style.display = "none";
          myShowOut.style.opacity = "1";
          myShowOut.style.transition = "all 0.4s";
          myShowCounter.style.display = "none";

     }
// ------------------
     myInsideOut.onclick = function() {
          myShowOut.style.display = "none";
     }
//-------------------
for( var i = 0 ; i < myAirportListOut.children.length ; i++) {
     myAirportListOut.children[i].onclick = function() { 
          myInsideOut.value = this.innerHTML;
          myAirportOut.value = this.innerHTML;
          myShowOut.style.display = "none";
     }
}

      // end input airport out---------

     myAirportIn.addEventListener('click' , function() {
          window.onscroll = function () {
               if(document.documentElement.scrollTop < 100) {
                    myShowIn.style.top = "-180px";
               }
               else {
                    myShowIn.style.top = "40px";
               }
          } 
          
     })
     myAirportOut.addEventListener('click' , function() {
          window.onscroll = function () {
               if(document.documentElement.scrollTop < 100) {
                    myShowOut.style.top = "-180px";
               }
               else {
                    myShowOut.style.top = "40px";
               }
          } 
          
     })
     //-----------------myTime in------

     myTimeOut.onclick = function () {
          myShowIn.style.display = "none";
          myShowOut.style.display = "none";
          myShowCounter.style.display = "none";
          myEconamy.style.display = "none";


     }
     myTimeIn.onclick = function () {
          myShowIn.style.display = "none";
          myShowOut.style.display = "none";
          myShowCounter.style.display = "none";
          myEconamy.style.display = "none";


     }

          
     //--------counter input -------
     let addBtn = document.querySelector('#add');
     let subBtn = document.querySelector('#sub');
     let qty = document.querySelector('#qtyBox');
     
     addBtn.addEventListener('click',()=>{
          qty.value = parseInt(qty.value) + 1;
     });

     subBtn.addEventListener('click',()=>{
          if (qty.value <= 0) {
               qty.value = 0;
          }
          else{
               qty.value = parseInt(qty.value) - 1;
          }
     });
          //--------counter input -------
          let addBtn1 = document.querySelector('#add1');
          let subBtn1 = document.querySelector('#sub1');
          let qty1 = document.querySelector('#qtyBox1');
          
          addBtn1.addEventListener('click',()=>{
               qty1.value = parseInt(qty1.value) + 1;
          });
     
          subBtn1.addEventListener('click',()=>{
               if (qty1.value <= 0) {
                    qty1.value = 0;
               }
               else{
                    qty1.value = parseInt(qty1.value) - 1;
               }
          });

                    //--------counter input -------
                    let addBtn2 = document.querySelector('#add2');
                    let subBtn2 = document.querySelector('#sub2');
                    let qty2 = document.querySelector('#qtyBox2');
                    
                    addBtn2.addEventListener('click',()=>{
                         qty2.value = parseInt(qty2.value) + 1;
                    });
               
                    subBtn2.addEventListener('click',()=>{
                         if (qty2.value <= 0) {
                              qty2.value = 0;
                         }
                         else{
                              qty2.value = parseInt(qty2.value) - 1;
                         }
                    });

                    // ------adultsBtn ------- 
                    myAdultBnt.onclick=function(){
                         myShowCounter.style.display = "block";
                         myShowCounter.style.transition = "all 0.4s";
                         myEconamy.style.display = "none";


                    }
                  

                    //--------input degree -------
                    myEconamyBtn.onclick = function() {
                         myEconamy.style.display = "block";
                         myShowCounter.style.display = "none";
                         myShowIn.style.display = "none";
                         myShowOut.style.display = "none";
                    }

                    for( var x = 0 ; x < myEconamy.firstElementChild.children.length ; x++) {
                         myEconamy.firstElementChild.children[x].onclick = function() { 
                              myEconamyBtn.innerHTML = this.textContent;
                              myEconamy.style.display = "none";
                         }
                    }




                    /* start search btn */
                    mySearch.onclick = function() {
                         myCheckForm.classList.add('trans');
                         myContainerHidden.style.overflow = "hidden";
                    }
                    /* end search btn */

     //booking page end
     
          