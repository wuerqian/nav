<?php
	require_once("login.php");
?>
<header>
	<input type="checkbox" id="navctrl">
	<div class="phone-nav">
		<div id="view1"></div>
		<div class="nav-left">
			<label class="hb" for="navctrl">
				<span class="line"></span>
			</label>
		</div>
		<div class="logo">
			<a href="javascript:void(0)">
				<img src="images/logo.png" alt="logo">
			</a>
		</div>
		<div class="nav-right">			
			<span class="seach-button">
				<img src="images/icon/search_black.svg" width="25" alt="seach">
				搜尋
			</span>
		</div>
	</div>
	<nav>
		<ul>
			<li class="logo">
				<div id="view4"></div>
				<a href="javascript:void(0)">
					<img src="images/logo.png" alt="logo">
				</a>
			</li>
			<li class="index-member">
				<div id="view6"></div>
				<div class="before-login">
					<a href="javascript:void(0)">註冊</a>
					<a href="javascript:void(0)">登入</a>
				</div>
				<div class="after-login">
					<div>
						<a href="member.php">
							<img src=<?php echo $memRow->member_Pic ?> alt="member-Pic" class="member-Pic">
						</a>
					</div>
					<div>
						<span><img src="images/icon/riceball_white.svg" width="30" alt="achievement-Pic" class="achievement-Pic"><?php echo $memRow->member_buyCount ?>積分</span><br>
						<span><?php echo $memRow->member_Id ?></span>
					</div>
				</div>
			</li>
			<li class="meals">
					<div id="view5"></div>
				<a href="javascript:void(0)">日食餐點</a>
			</li>
			<li class="initiate">			
				<div id="view2"></div>
				<a href="javascript:void(0)">發起飯團</a>
			</li>
			<li class="participate">
				<div id="view3"></div>
				<a href="javascript:void(0)">參加飯團</a>
			</li>
			<li class="table-hidden"><a href="member.php">會員中心</a></li>
			<li class="table-hidden"><a href="javascript:void(0)">客服雞器人</a></li>
		</ul>
	</nav>
	<label class="white-Point" for="white-Point-control">
		<ul>
			<div id="view7"></div>
			<li>
				<a href="shopping_cart.php">
					<img class="phone-hidden" src="images/icon/cart_black.svg" alt="cart">
					<img class="table-hidden" src="images/icon/cart_white.svg" alt="cart"><br>
					購物車
					<span>3</span>
				</a>
			</li>
			<li>
				<a href="javascript:void(0)">
					<img class="phone-hidden" src="images/icon/qrcode_black.svg" alt="qrcode">
					<img class="table-hidden" src="images/icon/qrcode_white.svg" alt="cart"><br>
					快速取餐
					<span>2</span>
				</a>
			</li>
			<li class="table-hidden">
				<a href="javascript:void(0)">
					<img src="images/icon/game_white.svg" alt="game"><br>
					想吃什麼？
				</a>
			</li>
			<li class="table-hidden">
				<a href="javascript:void(0)">
					<img src="images/icon/heart_white.svg" alt="mc"><br>
					我的收藏
				</a>
			</li>
			<li class="table-hidden">
				<a href="javascript:void(0)">
					<img src="images/icon/riceball_white.svg" alt="riceball"><br>
					我的飯團
				</a>
			</li>		
		</ul>
	</label>
</header>

<div class="nav_height"></div>
<!-- <script src="js/floaty.js"></script>S -->
<!-- <script src="js/svgColor.js"></script> -->
<script>

	for (var i = 1; i <= 7; i++) {
	
		var view = document.querySelector("#view" +　i);

		struct1 = document.createElement("div");     
		struct1.className = "slice s" + 3;
	
		for (var j = 2; j > 0; j--) {
	
			struct2 = document.createElement("div");     
			struct2.className = "slice s" + j;
	
			struct2.appendChild(struct1);

			struct1 = struct2;
		}
	
		view.appendChild(struct2);
		
	}

	//-----------------------whitePoint--------------------------//

	var isMousemove = false,
		mouseX,
		mouseY;

	document.body.addEventListener('mousemove', function(e){
		mouseX = e.clientX;//滑鼠x位置
		mouseY = e.clientY;//滑鼠y位置

		// console.log(mouseX);
		// console.log(mouseY);
		// console.log(" ");

		if(isMousemove){
			whitePointDown();
		}
	});  

	document.body.addEventListener('touchmove', function(e){
		var touch = e.touches[0]; //獲取第一個觸點  
		var x = Number(touch.clientX); //頁面觸點X座標  
		var y = Number(touch.clientY); //頁面觸點Y座標  
		//記錄觸點初始位置  
		mouseX = x;//滑鼠x位置
		mouseY = y;//滑鼠y位置

		// console.log(touch);
		// console.log(mouseX);
		// console.log(mouseY);
		// console.log(" ");

		if(isMousemove){
			whitePointDown();
		}
	}, true);  

	var whitePoint = document.querySelector('.white-Point'),
		childList = whitePoint.children[0].children,
		whitePointLock = true;

	whitePoint.addEventListener('mousedown', function(){ // 按下鼠標左鍵時
		whitePointDown();
	}); 
	
	whitePoint.addEventListener('touchstart', function(){ //觸摸元素時
		whitePointDown();
	});
	

	function whitePointDown(){

		if(!isOpen){

			whitePoint.style.transition = "0.05s";
			whitePoint.style.top = mouseY - 25 + 'px';
			whitePoint.style.left = mouseX - 25 + 'px';
			isMousemove = true; //處於按壓拖移小白點狀態
		}
	}


	// function whitePointDown(){

	// 	if(!isOpen){

	// 		whitePoint.style.transition = "0.05s";
	// 		whitePoint.style.top = mouseY - 25 + 'px';
	// 		whitePoint.style.left = mouseX - 25 + 'px';
	// 		isMousemove = true; //處於按壓拖移小白點狀態
	// 	}
	// }
	// document.body.addEventListener('mouseup', whitePointClose, false); //在body釋放鼠標左鍵時
	// document.body.addEventListener('touchend', whitePointClose, false); //從body元素移除手指時

	// function whitePointClose(e){

 	// 	// e.preventDefault();

	// 	var w = window.innerWidth,
	// 		h = window.innerHeight;

	// 	if(w<1024){
	// 		whitePoint.style.width = "50px";
	// 		whitePoint.style.height = "50px";
			
	// 		whitePointBeforeY = mouseY - 25;

	// 		whitePoint.style.left = w-50 + "px";
	// 		whitePointBeforeX = w-50;

	// 		for(i=0;i<childList.length;i++){
	// 			childList[i].style.display = 'none';
	// 		}
	// 	}else{

	// 		whitePoint.style.transition = "0s";
	// 		whitePoint.style.width = '14.28571428%';
	// 		whitePoint.style.height = "100px";
	// 		whitePoint.style.display = 'static';

	// 		for(i=0;i<childList.length;i++){
	// 			childList[i].style.display = 'none';
	// 		}

	// 		for(i=0;i<3;i++){
	// 			childList[i].style.display = 'inline-block';
	// 		}
	// 	}
	// }

	whitePoint.addEventListener('mouseup', function(){//釋放鼠標左鍵時

		isOpen = !isOpen; //現在是否打開小白點
		whitePointUp();

	}, false); 
	
	whitePoint.addEventListener('touchend', function(){//從元素移除手指時

		isOpen = !isOpen; //現在是否打開小白點
		whitePointUp();

	}, false); 

	var isOpen = false,
		whitePointBeforeX = 0;
		whitePointBeforeY = 75;

	function whitePointUp(){

		// e.preventDefault();

		var w = window.innerWidth,
			h = window.innerHeight,
			minwh = w > h ? h : w;

		isMousemove = false; //離開按壓拖移小白點狀態

		//取得小白點前後位置,判斷使用者想要開啟或拖移小白點
		whitePointLock = Math.abs(whitePointBeforeX - mouseX) < 50 && Math.abs(whitePointBeforeY - mouseY) < 50;

		if(w<1024){
			whitePoint.style.display = 'fixed';
			whitePoint.style.transition = "0.5s";

			if(isOpen && whitePointLock){

				whitePoint.style.width = minwh * 0.7 + 'px';
				whitePoint.style.height = minwh * 0.7  + 'px';
				
				whitePoint.style.top = (h / 2) - (minwh * 0.35) + 'px';
				whitePoint.style.left = (w / 2) - (minwh * 0.35) + 'px';
				
				for(i=0;i<childList.length;i++){
					childList[i].style.display = 'inline-block';
				}

			}else{

				whitePoint.style.width = "50px";
				whitePoint.style.height = "50px";
				
				whitePointBeforeY = mouseY - 25;

				if(mouseX < w/2){
					whitePoint.style.left = 0;
					whitePointBeforeX = 0; 
				}else{
					whitePoint.style.left = w-50 + "px";
					whitePointBeforeX = w-50;
				}

				for(i=0;i<childList.length;i++){
					childList[i].style.display = 'none';
				}
			}
		}else{

			whitePoint.style.transition = "0s";
			whitePoint.style.width = '14.28571428%';
			whitePoint.style.height = "100px";
			whitePoint.style.display = 'static';

			for(i=0;i<childList.length;i++){
				childList[i].style.display = 'none';
			}

			for(i=0;i<3;i++){
				childList[i].style.display = 'inline-block';
			}
		}
	}

	whitePoint.addEventListener('mousemove', whitePointMove, false); //在元素內移動時
	whitePoint.addEventListener('Touchmove', whitePointMove, false); //移動手指時

	function whitePointMove(){
	}

	window.addEventListener("resize", function(){
    	whitePointUp();
	});

</script>