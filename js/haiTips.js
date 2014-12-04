/**
 * @name:  hai_tips
 * @CSS:   hai_tips.css
 * @author:majinyun
 * 
 */
~(function($){
    var hExist = true; //防止重复 
    $.hai_tips = function(option){ 
        //初始化默认参数
        var defaults = {
    	    title:"温馨提醒",        //tips标题
            content:"",              //tips内容
            width:'auto',            //tips宽度
            height:'auto',           //tips高度 
            opacity:0.75,            //tips遮罩层透明度
            show:true,               //tips是否立即显示弹出层 
            overlayClose:false,       //tips点击遮罩层是否可以关闭
            overlayColor:'#4F4F4F',  //tips的遮罩层颜色
            type:null,               //消息类型：tips，配合自动关闭 time使用
            time:3,                  //自动关闭（多少秒后关闭），和type使用 ，默认3秒
            ok:null,                 //tips确定按钮回调函数，函数如果返回false将阻止弹出层关闭
            cancel:true,             //tips取消按钮回调函数，如果为true，调用默认关闭事件，函数如果返回false将阻止弹出层关闭
            closeBtn:true            //右上角tips的关闭按钮
        };
         
        var plugin = this;//避免this混乱; 
        plugin.settings = {};//参数

        //初始化
        plugin.init = function(){
            //判断弹窗是否存在
            if(!hExist){
                return false;
            }
            hExist = false;

            plugin.settings  = $.extend(defaults,option);//合并参数
            plugin.create_hai_tips();
            return this;
        };

        //创建弹出层
        plugin.create_hai_tips = function(){

            //初始化弹窗的HTML结构
            this.dialog = $('<div>',{'class':"hai_tips fixed border"});

            //判断弹窗类型
            if(this.settings.type && this.settings.type == 'tips'){
                $('<div>',{'class':'h-content'}).appendTo(this.dialog);
                this.settings.opacity = false;
            }else{
                this.header = $('<div>',{'class':'h-header'});

                //添加头部
                if(this.settings.title || this.settings.closeBtn){
                    this.header.appendTo(this.dialog);

                    //添加标题
                    if(this.settings.title){
                        $('<span>',{'class':'x-title'}).html(this.settings.title).appendTo(this.header);
                    }
                   
                    //添加右上角关闭按钮
                    if(this.settings.closeBtn){
                        $('<span>',{'class':'x-close'}).html('X').appendTo(this.header);
                    }
                }
               
                //添加内容
                $('<div>',{'class':'h-content'}).appendTo(this.dialog);
                
                //添加确定、取消、按钮
                if(this.settings.ok && typeof this.settings.ok == 'function'){
                    $('<div>',{'class':'h-buttons'}).html('<a class=\"x-ok h-btn blue\" href=\"javascript:;\">继续上传<\/a><a href=\"javascript:;\" class=\"x-cancel h-btn\">查看已传图片<\/a>').appendTo(this.dialog);
                }
            }

            this.setContent(this.settings.content);//设置内容
            this.dialog.appendTo('body');

            //初始化遮罩层
            if (plugin.settings.opacity){
                if(!plugin.overlay){
                    var view =  getWidthHeight();
                    
                    plugin.overlay = jQuery('<div>', {
                        'class':'h-overlay'
                    }).css({
                        'background-color': plugin.settings.overlayColor,
                        'position': 'absolute',
                        'width':    view.width,
                        'height':   view.height,
                        'left':     0,                                     
                        'top':      0,                               
                        'opacity':  plugin.settings.opacity,      
                        'z-index':  1000,
                        'cursor': 'pointer'                            
                    });

                    //判断点击遮罩层是否可以关闭
                    if(plugin.settings.overlayClose){
                  plugin.overlay.bind('click', function() {plugin.close();});
                    }
                    plugin.overlay.appendTo('body');
                }else{
                    plugin.overlay.show();
                }
            }
            
            //显示弹出层
            if(this.settings.show){
                this.show();
            }

            //绑定按钮
            $.each(['ok','cancel','close'],function(index, value){
                plugin.dialog.find('.x-' + value).bind('click',function(){
                    if(typeof plugin.settings[value] == 'function'){
                        if(plugin.settings[value]() === false){
                            return false;
                        }
                    }
                    plugin.close();
                });
            });
        };

        //设置tips的位置
        plugin.setPos = function(){
            var width = (this.settings.width == 'auto') ? this.dialog.outerWidth() : this.settings.width,
            height = (this.settings.height == 'auto') ? this.dialog.outerHeight() : this.settings.height,
            left = -(width / 2), top = -(height / 2);

            plugin.dialog.css({
                'margin-top': top,
                'margin-left': left,
                'width': width,
                'height': height
            });
        };

        //设置标题
        plugin.setTitle = function(title){
            var _title = plugin.dialog.find('.x-title');
            //判断标题节点是否存在
            if(_title.length > 0){
                 _title.html(title);
            }else{
                $('<span>',{'class':'x-title'}).html(title).appendTo(plugin.header);
            }
            return this;
        };
        
        //设置内容
        plugin.setContent = function(obj){
            //判断内容类型
            if(typeof obj != 'string'){
                obj = (obj instanceof jQuery) ? obj[0] : obj;
                obj = obj.cloneNode(true);
                obj.style.display = 'block';
            }
            plugin.dialog.find('.h-content').append(obj);
            return this;
        }; 
        
        //显示弹出层
        plugin.show = function(){
            this.setPos();//重置样式
            plugin.dialog.fadeIn(300);//显示弹出层
           
            //判断弹出层类型
            if(this.settings.type === 'tips' && this.settings.time){
                setTimeout(function(){
                    plugin.close();
                    hExist = true;
                },this.settings.time * 1000);
            }
        };
        
        //关闭弹出层
        plugin.close = function(){
            plugin.dialog.remove();
            if(this.overlay) this.overlay.hide();
            hExist = true;
        }; 
       
        //获取页面宽高 
        var getWidthHeight = function(){ 
        	
            //为兼容性，先判断Doctype模式
        	//当document.compatMode等于BackCompat时，取浏览器客户区宽度document.body.clientWidth；
        	//当document.compatMode等于CSS1Compat时，取浏览器客户区宽度document.documentElement.clientWidth。
        	
            if (document.compatMode == "BackCompat"){
            	this.width = document.body.clientWidth;
                if(document.body.scrollHeight > document.body.clientHeight){
                	this.height = document.body.scrollHeight;
                }else{
                	this.height = document.body.clientHeight;
                }
            }else{
            	this.width = document.documentElement.clientWidth;
                if(document.documentElement.scrollHeight > document.documentElement.clientHeight){
                	this.height = document.documentElement.scrollHeight;
                }else{
                	this.height = document.documentElement.clientHeight;
                } 
            }
            return {width:this.width,height:this.height};
        };
 
        return plugin.init(); 
    };
    
    
    
})(jQuery);