$(document).ready(function () {
  var today=new Date();
  var h=0,m=0,s=0;
  var hh=0,mm=0,ss=0;

  print_h.innerHTML =today.getHours();
  print_m.innerHTML=today.getMinutes();
  print_s.innerHTML=today.getSeconds();

  function setting(){
  
    if(showhour_txt_h.innerHTML=='00') showhour_txt_h.innerHTML = today.getHours(); 
    if(showmin_txt_h.innerHTML=='00') showmin_txt_h.innerHTML = today.getMinutes(); 
    if(showsec_txt_h.innerHTML=='00') showsec_txt_h.innerHTML= today.getSeconds();  
    
    if(showhour_txt_m.innerHTML=='00') showhour_txt_m.innerHTML = today.getHours(); 
    if(showmin_txt_m.innerHTML=='00') showmin_txt_m.innerHTML = today.getMinutes();
    if(showsec_txt_m.innerHTML=='00') showsec_txt_m.innerHTML= today.getSeconds(); 
    
    if(showhour_txt_s.innerHTML=='00') showhour_txt_s.innerHTML = today.getHours(); 
    if(showmin_txt_s.innerHTML=='00') showmin_txt_s.innerHTML = today.getMinutes();
    if(showsec_txt_s.innerHTML=='00') showsec_txt_s.innerHTML= today.getSeconds();
  }
  
  
  $(".number_h_am,.number_h_pm").click(function () {//printhour
     h = $(this).closest('div').attr('value');
    hh=1;
    showhour_txt_h.innerHTML = h;
    showhour_txt_m.innerHTML = h;
    showhour_txt_s.innerHTML = h;
  
  });

  $(".MINdiv").click(function(){//printminitue
     m=$(this).closest('div').attr('value');  
      mm=1;
     showmin_txt_m.innerHTML=m;
     showmin_txt_h.innerHTML=m;
     showmin_txt_s.innerHTML=m;

  });

  $(".seconds_div").click(function(){//printsecond
     s=$(this).closest('div').attr('value');
     ss=1;
     showsec_txt_s.innerHTML=s;
     showsec_txt_m.innerHTML=s;
     showsec_txt_h.innerHTML=s;
  });

  $(".MINdiv").hover(function () { //minute mouse cursor
    var ro = document.getElementById("minute");
    var min_v = $(this).closest('div').attr('value');
    ro.style.transform = "rotate(" + 90 + min_v * 6 + "deg)";
    
  });

  $(".seconds_div").hover(function () { //second mouse cursor
    var ro = document.getElementById("second_picker");
    var sec_v = $(this).closest('div').attr('value');
    ro.style.transform = "rotate(" + 90 + sec_v * 6 + "deg)";
    
  });

  $(".number_h_am,.number_h_pm").hover(function () { //hour mouse cursor
    var ro = document.getElementById("hour");
    var h_v = $(this).closest('div').attr('value');
    if (h_v > 12) h_v = h_v - 12;
    ro.style.transform = "rotate(" + 90 + h_v * 30 + "deg)";
  });

  $(".pop_bt_cancle_h").click(function (flag) {
    $('#myModal_hour').hide();
  });

  $(".pop_bt_cancle_m").click(function (flag) {
    $('#myModal_min').hide();
  });


  $(".pop_bt_cancle_s").click(function (flag) {
    $('#myModal_second').hide();
  });


  $(".pop_bt_ok_h").click(function (flag) { //print
    $('#myModal_hour').hide();
    if(hh==0) h=today.getHours();
    console.log(hh);
    print_h.innerHTML=h;
    
    
  });

  $(".pop_bt_ok_m").click(function (flag) { //print
    $('#myModal_min').hide();
    if(mm==0) m=today.getMinutes();
    console.log(mm);
    print_m.innerHTML=m;
    });

  $(".pop_bt_ok_s").click(function (flag) { //print
    $('#myModal_second').hide();
    if(ss==0) s=today.getSeconds();
    console.log(ss);
    print_s.innerHTML=s;
  });

  $(".btn_hour").click(function () {
    setting();
    $('#myModal_hour').show();
    $('#myModal_min').hide();
    $('#myModal_second').hide();
  });
  $(".btn_min").click(function () {
    setting();
    $('#myModal_hour').hide();
    $('#myModal_min').show();
    $('#myModal_second').hide();

  });
  $(".btn_second").click(function () {
    setting();  
    $('#myModal_hour').hide();
    $('#myModal_min').hide();
    $('#myModal_second').show();

  });

});
