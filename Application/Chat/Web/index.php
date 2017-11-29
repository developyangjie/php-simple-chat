<!doctype html>
<html>
<head>
<meta http-equiv="content-Type" content="text/html;charset=gdk" >
<TITLE>我是一个弹幕</TITLE>

<style type="text/css">
  *{margin:0;padding:0;}
  body{background:url("1.png") no-repeat top center; font-size:12px;font-family:"微软雅黑"; }
  /*d_screen start*/
 .dm{width:100%;height:100%;position:absolute;top:0;left:0;display:none;}
 .dm .d_screen 
 .d_del{width:38px;height:38px;background:#600;display:block;text-align:center;line-height:38px;
  text-decoration:none;font-size:20px;color:#fff;border-radius:19px;border:1px solid #fff;position:absolute;top:10px;right:20px;z-index:3;display:none;}
 .dm .d_screen .d_del:hover{background:#f00;}
 .dm .d_screen .d_mask{width:100%;height:100%;background:#000;position:absolute;top:0;left:0;opacity:0.5;
 filter:alpha(opacity=50) z-index:1;}
 .dm .d_screen .d_show{position: relative;z-index:2;}
 .dm .d_screen .d_show div{font-size:22px;line-height:36px;font-weight:500;color:#fff;position:absolute;left:0;top:0;}
  /*end d_scree*/

   /*.send start*/
 .send{width:100%;height:76px;position:absolute;bottom:0;left:0;}
 .send .s_fiter{width:100%;height:76px;background:#000;position:bottom:0;left:0;opacity:0.8;filter:alpha(opacity=80);}
 .send .s_con{width:100%;height:76px;position:absolute;top:0;left:0;z-index:2;text-align:center;line-height:76px;}
 .send .s_con 
 .s_txt{width:605px;height:36px;border-radius:4px 0 0 4px;outline:none;border:1px solid #5bba32;}
 .send .s_con .s_sub{width:100px;height:37px;background:#65c33d;border:0;outline:none;font-size:14px;color:#fff;font-family:"微软雅黑";cursor:pointer;border-radius:0 4px 4px 0;border:1px solid #5bba32;}
 .send .s_con .s_sub:hover{background:#3eaf0e;}
  /*end .send*/
</style>
</head>
<body>
<center><br><br><br><br><br><br><br><br><br><br><br>
<h1><a href="#" id="btn">弹幕（点我呀！！）</a></h1>
</center>
<!--dm start-->
	<div class="dm">
	<!--d_screen start-->
		<div class="d_screen">
			<a href="#" class="d_del">X</a>
			<div class="d_mask"></div>
			<div class="d_show">
			</div>
		</div>
		<!--end d_screen-->

		<!--send start-->
		<div class="send">
			<div class="s_fiter">
				<div class="s_con">
					<input type="text" class="s_txt"/><input type="button" value="发布评论" class="s_sub"/>
				</div>
			</div>
		</div>
		<!--end send-->
	</div>
	<!--end dm-->

<!--引入类库-->
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
	// 假设服务端ip为127.0.0.1
	ws = new WebSocket("ws://127.0.0.1:2346");
	ws.onopen = function() {
	};
	ws.onmessage = function(e) {
		var nr = e.data;
		var div="<div>"+nr+"</div>";
		$(".d_show").append(div);
		init_screen();
	};
	
	$(function(){
	init_screen();
		//alert("您好");
		$("#btn,.d_del").click(function(){
			$(".dm,.d_del,#btn").toggle(1000);
		});
		$(".s_sub").click(function(){
		   var text=$(".s_txt").val();
			ws.send(text);
		})
	});
//初始化弹幕

	function init_screen(){
		var _top=0;
		$(".d_show").find("div").show().each(function(){
			var _left=$(window).width()-$(this).width();
			var _height=$(window).height();

			_top=_top+76;
			if(_top>=_height-100){
				_top=0;
			}

			$(this).css({left:_left,top:_top,color:getReandomColor()});
			var time=10000;
			if($(this).index()%2==0){
				time=15000;
			}
			$(this).animate({left:"-"+_left+"px"},time,function(){

			
			});
		});
	}

	//随机获取颜色值
	function getReandomColor(){
		return '#'+(function(h){
		return new Array(7-h.length).join("0")+h
		})((Math.random()*0x1000000<<0).toString(16))
	}
</script>
</body>
</html>