/*<!-- 首页的jS --> */
$(function() { 
    $("#Upload").click(function(e){  
     e.preventDefault;
     $("#Upload").hide();
     if (VerificationuserName()&&VerificationId()&&VerificationUsign()) {
         go(); 
      } else{
         return false; 
       }; 
    })  
    $("body").find("#id").each(function() {
        enforceNum($(this));
    }); 
    $("#avatarUpload").uploadify({
        'debug'             : false,    //开启调试
        'auto'              : false,    //是否自动上传
        'multi'             : false,    //可以上传多个文件。
        'uploadLimit'       : 1,
         'method'           : 'post', //  服务端可以用$_POST数组获取数据
        'formData'          : {'uid':'0','uname':'0','motto':'0'}, //附带值
        'buttonText'        : '请选择图片',
        'height'            : 35,
        'width'             : 120,
        'removeCompleted'   : true,
        'progressData'      : 'percentage', //speed 设置上传进度显示方式，percentage显示上传百分比，speed显示上传速度
        'swf'               : 'uploadify/uploadify.swf',
        'uploader'          : 'upload.php',
        'fileTypeExts'      : ' *.jpg; *.jpeg; *.png;',//设置上传文件类型为常用图片格式  
        'fileSizeLimit'     : '10245KB', //设置上传文件大小单位kb 
        'onUploadSuccess' : function(file, data, response) {
            var msg = $.parseJSON(data);
             if( msg.result_code == 1 ){
                 $("#img").val( msg.result_des2);
                 $("#target").attr("src",msg.result_des2);
                 if (msg.result_des2!=null) {
                   $("#Upload").hide();
                   $("#Upload + a").hide();
                 }; 
                // $(".preview").attr("src",msg.result_des);
                $('#target').Jcrop({
                    minSize: [300,210],
                    setSelect: [0,0,900,630],
                    onChange: updatePreview, //更新缩略图，这里暂时没用到。
                    onSelect: updatePreview,
                    onSelect: updateCoords,
                    allowResize: true,
                    fadeTime    : 400,
                    dragEdges   : true,
                    aspectRatio  : 1.428//设置比例
                },
                function(){
                    // 获取实际尺寸
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];
                    console.log(bounds);  
                    // Store the API in the jcrop_api variable
                    jcrop_api = this;
                }); 
                $(".imgchoose").show(100);
                $("#avatar_submit").show(100);
                $('html,body').animate({scrollTop:$('#avatarUpload').offset().top+160},1000,'swing',function(){});
            } else {
                alert('图片上传失败');
            }
        },
        'onSelect':function(){
              $("#Upload").css("display","block");
              $("#Upload + a").css("display","block");
        },
        'onError' : function (event,ID,fileObj,errorObj) {  
            $('#id_span_msg').html("上传失败，错误码:"+errorObj.type+" "+errorObj.info);  
        },  
        'onClearQueue' : function(queueItemCount) {
            alert( $('#img1') );
        },
        'onCancel' : function(file) {
            alert('您放弃了 ' + file.name + '的上传.');
        }

    });

    $("#id").blur(function(){
     if ($(this).val()!=""||$(this).val()!=null) {
       $.ajax({
                type: "POST",
                url: "img_exists.php",
                data: {'uid':$(this).val()},
                dataType: "json",
                success: function(msg){
                    if( msg.result_code == 1 ){
                      
                    } else if (msg.result_code == 3) { 
                       $.hai_tips({
                          title : '您好 '+$("#name").val(),
                          content : document.getElementById('data'),
                           show: true, 
                           opacity:  0.7,
                           ok : function() { 
                              $.ajax({
                                type: "POST",
                                url: "remove.php",
                                data: {'uid':$("#id").val()},
                                dataType: "json",
                                success: function(msg){
                                    if( msg.result_code == 1 ){
                                       console.log("旧删除图片成功");
                                    }  
                                    
                                }
                            });
                           }, 
                           cancel : function() {
                            //  $('#avatar2').attr('href',msg.result_des.photo);
                               window.open(msg.result_des.photo,'newwindow','height=600,width=900,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no') 
                             }
                        }); 
                    }
                }
            });
       };
    })
    
 
     var photos;
     $('#avatar').click(function(e){
       e.preventDefault;
        window.open(photos,'newwindow','height=630,width=900,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no') 

     });

    $("#avatar_submit").click(function(){ 
        var img1 = $("#img").val();
        img  =  img1.replace("02","01"); 
        var x = parseInt($("#x").val())*2.5;
        var y = parseInt($("#y").val())*2.5;
        var w = parseInt($("#w").val())*2.5;
        var h = parseInt( $("#h").val())*2.5;
        if( checkCoords()){  
            $("#tips").show();
            $.ajax({
                type: "POST",
                url: "resize.php",
                data: {"img":img,"x":x,"y":y,"w":w,"h":h,'uname':$("#name").val(),'usign':$("#usign").val()},
                dataType: "json",
                success: function(msg){
                    if( msg.result_code == 1 ){
                            $('#avatar_msg').show();
                            //$('#avatar').attr('href',msg.result_des.photo);  
                             photos =  msg.result_des.photo; 
                            $('#Uimg').show();
                            $("#tips").html("裁剪成功");
                            $("#avatar_submit").hide();
                        $('html,body').animate({scrollTop:$('#avatar_msg').offset().top-300},1000,'swing',function(){
                     
                         });
                    } else {
                        alert("图片裁剪失败");
                    }
                }
            });
        }
    });


}); 
  
    //照片裁剪
    var jcrop_api, boundx, boundy;
    
    function updateCoords(c)
    {
        $('#x').val(c.x); //选中区域左上角横坐标 
        $('#y').val(c.y);
        $('#w').val(c.w); ////得到选中区域的宽度 
        $('#h').val(c.h);
    };
    function checkCoords(){
        if (parseInt($('#w').val())) return true;
        alert('请选择图片上合适的区域');
        return false;
    };
    /*更新s缩略图*/
    function updatePreview(c){  
        var rx = 150 / c.w;
        var ry = 105 / c.h;
        $('#preview3').css({
            width:  Math.round(rx * boundx)+ 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * c.x)+ 'px',
            marginTop:  '-' + Math.round(ry * c.y) + 'px'
        }); 
    };  
 function go (){
       $('#avatarUpload').uploadify('settings', 'formData', { 
        'uid':$("#id").val(),'uname':$("#name").val(),'motto':$("#usign").val()      
       }); 
      $('#avatarUpload').uploadify('upload','*');
 }

function enforceNum(_node) {
    _node.live("keyup blur", function() {
        $(_node).val($(_node).val().replace(/[^0-9-]+/, ''));
     });
} 
function VerificationuserName(_node) {
 if ( $("#name").val()=="") {
       $.hai_tips({
            title : '您好 ：'+$("#name").val(),
            content :"您的姓名不能为空",
             show: true, 
             opacity:  0.7 
          });
       return false;
 }else{
  return true;
 }
} 
function VerificationId(_node) {
 if ( $("#id").val()=="") {
       $.hai_tips({
            title : '您好 ：'+$("#name").val(),
            content :"您的工号是必填项",
             show: true, 
             opacity:  0.7 
          });
      return false;
 }else{
  return true;
 }
}  
function VerificationUsign(_node) {
   if ( $("#usign").val()=="") {
         $.hai_tips({
              title : '您好 ：'+$("#name").val(),
              content :"亲，你就写一句简单的照片签名吧。",
               show: true, 
               opacity:  0.7 
            });
         return false;
   }else{
    return true;
   }
}   