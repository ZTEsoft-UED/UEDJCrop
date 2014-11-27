##JCrop

选择图片--上传到服务器（php）--返回路径--前台获得路径显示图片--crop图--发送位置数据到后台---后台裁剪图片--返回裁剪后的路径到前台显示


###Jcrop 是一个功能强大的 jQuery 图像裁剪插件,结合后端程序(如:PHP)可以快速的实现图片裁剪的功能。
 

###图片截取的原理：

在后台来进行图片的切割,在前台使用jcrop获取切面的x轴坐标、y轴坐标、切面高度、切面宽度，
然后将这四个值传给后台。在后台要进行放大处理：将切面放大N倍，N=原图/前台展示的头像。
即
X = X*原图宽/前图宽，
Y = Y*原图高/前,
图高，
W = W*原图宽/前图宽,
H = H*原图高/前图高。




```

基本options参数设置：

名称	默认值	说明
allowSelect	true	允许新选框
allowMove	true	允许选框移动
allowResize	true	允许选框缩放
trackDocument	true	
baseClass	"jcrop"	基础样式名前缀。说明：class="jcrop-holder"，更改的只是其中的 jcrop。
addClass	null	添加样式会。例：假设值为 "test"，那么会添加样式到 class="test jcrop-holder"
bgColor	"black"	背景颜色。颜色关键字、HEX、RGB 均可。
bgOpacity	0.6	背景透明度
bgFade	false	使用背景过渡效果
borderOpacity	0.4	选框边框透明度
handleOpacity	0.5	缩放按钮透明度
handleSize	9	缩放按钮大小
handleOffset	5	缩放按钮与边框的距离
aspectRatio	0	选框宽高比。说明：width/height
keySupport	true	支持键盘控制。按键列表：上下左右（移动）、Esc（取消）、Tab（跳出裁剪框，到下一个）
cornerHandles	true	允许边角缩放
sideHandles	true	允许四边缩放
drawBorders	true	绘制边框
dragEdges	true	允许拖动边框
fixedSupport	true	
touchSupport	null	
boxWidth	0	画布宽度
boxHeight	0	画布高度
boundary	2	边界。说明：可以从边界开始拖动鼠标选择裁剪区域
fadeTime	400	过度效果的时间
animationDelay	20	动画延迟
swingSpeed	3	过渡速度
minSelect	[0,0]	选框最小选择尺寸。说明：若选框小于该尺寸，则自动取消选择
maxSize	[0,0]	选框最大尺寸
minSize	[0,0]	选框最小尺寸
onChange	function(){}	选框改变时的事件
onSelect	function(){}	选框选定时的事件
onRelease	function(){}	取消选框时的事件
下表是api方法
名称	说明
setImage(string)	设定（或改变）图像。例：jcrop_api.setImage("newpic.jpg")
setOptions(object)	设定（或改变）参数，格式与初始化设置参数一样
setSelect(array)	创建选框，参数格式为：[x,y,x2,y2]
animateTo(array)	用动画效果创建选框，参数格式为：[x,y,x2,y2]
release()	取消选框
disable()	禁用 Jcrop。说明：已有选框不会被清除。
enable()	启用 Jcrop
destroy()	移除 Jcrop
tellSelect()	获取选框的值（实际尺寸）。例子：console.log(jcrop_api.tellSelect())
tellScaled()	获取选框的值（界面尺寸）。例子：console.log(jcrop_api.tellScaled())
getBounds()	获取图片实际尺寸，格式为：[w,h]
getWidgetSize()	获取图片显示尺寸，格式为：[w,h]
getScaleFactor()	获取图片缩放的比例，格式为：[w,h]


```
