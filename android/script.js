var page=0;
var uname_global="";
var museid_global="";
$(document).ready(function(){
  moveToBottom();
  $(window).scroll(function(){
    if($(window).scrollTop()===0){
      //getContent(uname_global,museid_global);
    }
  });
  $('#send_id').click(function(){
      sendMuse();
  });
  $('#submit_id').click(function(){
      if ($('#muse_content_id').val().length>0){
          sendClosed();
      }
  });
  $('#open_submit_id').click(function(){
      if($('#muse_content_open_id').val().length>0){
          sendOpen();
      }
  });
});

function sendOpen(){
$.ajax({
    url: "write_muse_a.php", 
    type: 'POST',
    data: { receiver: $('#open_receiver_id').val(), time: getTime(),
    muse_content: $('#muse_content_open_id').val()},
    success: function(resp){
        if(resp===0){
            window.location.href="open.php?r=0&id="+$('#open_receiver_id').val();
        }else if(resp==1){
            window.location.href="open.php?r=1&id="+$('#open_receiver_id').val();
        }
    }});
}

function sendMuse(){
$.post( "send_muse.php", { receiver: $('#receiver_id').val(), time: getTime(),
    send_content: $('#send_content_id').val()});
}

function sendClosed(){
$.ajax({
    url: "write_muse.php", 
    type: 'POST',
    data: { receiver: $('#muse_receiver_id').val(), time: getTime(),
    muse_content: $('#muse_content_id').val()},
    success: function(resp){
        if(resp==0){
            window.location.href="muse.php?r=0&id="+$('#muse_receiver_id').val();
        }else if(resp==1){
            window.location.href="muse.php?r=1&id="+$('#muse_receiver_id').val();
        }
    }});
}

function getTime(){
var currentTime = new Date();
var hours = currentTime.getHours();
var minutes = currentTime.getMinutes();
var date=currentTime.getDate();
var month=currentTime.getMonth()+1;
var year=currentTime.getFullYear();
var suffix = "AM";

if (hours >= 12) {
    suffix = "PM";
    hours = hours - 12;
}

if (hours == 0) {
    hours = 12;
}

if (minutes < 10) {
    minutes = "0" + minutes;
}
    return hours+":"+minutes+suffix+", "+date+"/"+month+"/"+year;
}

function getContentInit(uname,museid){
  uname_global=uname;
  museid_global=museid;
  var cur_html=$('#id_content_div').html();
  $.ajax({
    url: 'get_content_inbox.php',
    data: {'id':museid,'uname':uname,'page':page},
    type: 'GET',
    success: function(res){
      cur_html=res+cur_html;
      $('#id_content_div').html(cur_html);
      page+=1;
    }
  });

}

function getContent(uname,museid){
  uname_global=uname;
  museid_global=museid;
  var prev_height=$(document).height();
  var cur_height=0;
  var cur_html=$('#id_content_div').html();
  $.ajax({
    url: 'get_content_inbox.php',
    data: {'id':museid,'uname':uname,'page':page},
    type: 'GET',
    success: function(res){
      if((res+'').length>0){
        cur_html=res+cur_html;
        $('#id_content_div').html(cur_html);
        cur_height=$(document).height();
        $("html,body").scrollTop(cur_height-prev_height);
        moveToTop();
        page+=1;
      }else{
        $("#get_content").html("top");
      }
    }
  });
}

function moveToBottom(){
  $('html,body').animate({scrollTop: $(document).height()+1000},"slow");
}
function moveToTop(){
  $('html,body').animate({scrollTop:0},"slow");
}
