var page=0;
var uname_global="";
var museid_global="";
$(document).ready(function(){
  moveToBottom();
  $(window).scroll(function(){
    if($(window).scrollTop()==0){
      //getContent(uname_global,museid_global);
    }
  });
});

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
