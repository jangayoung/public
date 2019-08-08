var today = new Date();
var showmonth;
var showdate;
var showhour;
var showmin;
var pre;
var cnt=0;
var week = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
var Month = new Array('Jan', 'Feb', 'Mar', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Sep', 'Dec');
var Datearr = new Array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');


function prevMon() {
  today = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
  buildCalendar();
}

function nextYear() {
  today = new Date(today.getFullYear() + 1, today.getMonth(), today.getDate());
  buildCalendar();
}

function prevYear() {
  today = new Date(today.getFullYear() - 1, today.getMonth(), today.getDate());
  buildCalendar();
}

function nextMon() {
  today = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate());
  buildCalendar();
}

$(document).ready(function () {

  $(document.body).delegate('.sel', 'click', function (event) {//calendar date click
    var d = $(this).text();
    showdate.innerHTML = d + Datearr[d % 10];
   if(cnt==1){
     console.log(pre);
      document.getElementById(pre).classList.remove("select_Day");
   }
   pre=$(this).attr('id');
   $(this).addClass("select_Day");
   cnt=1;
   
  });

 

  $(".number_h_am,.number_h_pm").click(function () {
    $(".hours").hide();
    var h = $(this).closest('div').attr('value');
    console.log($(this).closest('div').attr('value'));
    showhour.innerHTML = h + " : ";
    $(".minutes").show();
  });

  $(".MINdiv").click(function(){//minitue
    var m=$(this).closest('div').attr('value');
    console.log($(this).closest('div').attr('value'));
    showmin.innerHTML=m;
  });

  $(".MINdiv").hover(function () { //minute mouse cursor
    var ro = document.getElementById("minute");
    var m = $(this).closest('div').attr('value');
    ro.style.transform = "rotate(" + 90 + m * 6 + "deg)";
   
  });

  $(".number_h_am,.number_h_pm").hover(function () { //hour mouse cursor
    var ro = document.getElementById("hour");
    var m = $(this).closest('div').attr('value');
    if (m > 12) m = m - 12;
    ro.style.transform = "rotate(" + 90 + m * 30 + "deg)";
  });




  $(".pop_bt_cancle").click(function (flag) {
    $('#myModal').hide();
  });

  $(".pop_bt_ok").click(function (flag) { //print
    $('#myModal').hide();
    var printmon = document.getElementById("showmonth").innerHTML;
    var printdate = document.getElementById("showdate").innerHTML;
    var printhour = document.getElementById("showhour").innerHTML;
    var printmin = document.getElementById("showmin").innerHTML;

    fin.innerHTML = printhour + printmin + "\n" + printdate + "\n" + printmon + "\n";
  });


  $("#one").click(function () {//show tab1 tab2
    $(".tab_content:first").show();
    $(".tab_content:last").hide();
  });
  $("#two").click(function () {
    $(".tab_content:first").hide();
    $(".tab_content:last").show();
  });

  $("#showhour").click(function () {
    $(".hours").show();
    $(".minutes").hide();
  });
  $("#showmin").click(function () {
    $(".hours").hide();
    $(".minutes").show();
  });

  $(".btn").click(function () {
    $('#myModal').show();

  });

});



function clockstart() {//clock
  var today = new Date();
  var m = today.getMinutes();
  var m_angle = m * 6;
  var m_angle_value = "rotate(" + m_angle + "deg)";
  document.getElementById("minute").style.transform = m_angle_value;

  var h = today.getHours();
  if (h > 12) var h = h - 12;
  var h_angle = (h * 30) + (30 / 60 * m);
  var h_angle_value = "rotate(" + h_angle + "deg)";
  document.getElementById("hour").style.transform = h_angle_value;


  setTimeout(clockstart, 10000);
}

function buildCalendar() {

  var nMonth = new Date(today.getFullYear(), today.getMonth(), 1);
  var lastDate = new Date(today.getFullYear(), today.getMonth() + 1, 0); //lastdate
  var tblCalendar = document.getElementById("calendar_tb");
  var tblCalendarYear = document.getElementById("calendarYear");
  var tblCalenderMon = document.getElementById("calendarMon");
  var showday = document.getElementById("showday");

  var tMonth = today.getMonth();
  var tMonthLabel = Month[tMonth];
  var tDate = today.getDate();
  var tDateLabel = today.getDate() + Datearr[tDate % 10 - 1];
  var tday = today.getDay();
  var labelhour = new Date().getHours(); //today hour
  var labelmin = new Date().getMinutes(); //today minute

  var todayLabel = week[tday];
  tblCalendarYear.innerHTML = today.getFullYear();
  tblCalenderMon.innerHTML = today.getMonth() + 1;

  showmonth = document.getElementById("showmonth");
  showdate = document.getElementById("showdate");
  showhour = document.getElementById("showhour");
  showmin = document.getElementById("showmin");

  showday.innerHTML = todayLabel;
  showmonth.innerHTML = tMonthLabel + " " + today.getFullYear();
  showdate.innerHTML = tDateLabel;
  
  if (labelhour < 10) labelhour = '0' + labelhour;
 
  if (labelmin < 10) labelmin = '0' + labelmin;

  showhour.innerHTML = labelhour + " : ";
  showmin.innerHTML = labelmin;


  while (tblCalendar.rows.length > 1) {
    tblCalendar.deleteRow(tblCalendar.rows.length - 1);
  } //deleteRow

  var row = null;
  row = tblCalendar.insertRow();
  var cnt = 0; //flag

  for (i = 0; i < nMonth.getDay(); i++) { //when the start day is.
    cell = row.insertCell();
    cnt = cnt + 1;
  }


  for (i = 1; i <= lastDate.getDate(); i++) { //print date
    cell = row.insertCell();
    cell.innerHTML = i;
    cell.className = "sel";
     cell.id="sel"+i;
    if (i == today.getDate()) { //check today
      if (today.getMonth() == new Date().getMonth()) {
        if (today.getFullYear() == new Date().getFullYear()) {
          console.log("here");
          cell.style.fontWeight = "bold";
          cell.style.borderBottom="solid 3px #3e6f97";

        }
      }
    }
    cnt = cnt + 1;
    if (cnt % 7 == 0)
      row = calendar_tb.insertRow(); //insert row
  }

}
