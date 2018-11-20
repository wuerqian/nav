<?php
	require_once("Backstage-login-success.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/backstage.css">
    <title>管理員帳號</title>
</head>	
<body class="out">
    <div class="d-flex" name="top">
        <div class="container col-xl-2">
            <div class="list-group back-nav">
                <div class="back-logo"><img src="../images/logo3.png" alt="logo"></div>
                <div class="back-signout">
                    <span><?php echo $prodRowmanager->manager_Id ?></span>
                    <form action="Backstage-login-out.php">
                        <button type="submit" class="mainBTN" id="manager-out">登出</button>
                    </form>
                </div>
                <a href="backstage-meal.php" class="list-group-item list-group-item-action back-change">餐點資訊</a>
                <!-- <a href="backstage-groupon.php" class="list-group-item list-group-item-action back-change">飯團管理</a> -->
                <a href="backstage-message.php" class="list-group-item list-group-item-action back-change">留言審核</a>
                <a href="backstage-chatBot.php" class="list-group-item list-group-item-action back-change">客服雞器人</a>
                <a href="backstage-achievement.php" class="list-group-item list-group-item-action back-change">成就管理</a>
                <a href="backstage-memberOrder.php" class="list-group-item list-group-item-action back-change">訂單管理</a>
                <a href="backstage-manager.php" class="list-group-item list-group-item-action back-change focus-color">管理員帳號</a>
                <a href="takeMealAfter.php" class="list-group-item list-group-item-action back-change">會員取餐</a>
            </div>
        </div>
    
        <div class="container col-xl-10">
            <div class="back-text">
                <div class="banner"><button type="button" class="mainBTN" tabindex="-1" data-toggle="modal" data-target="#manager">新增</button></div>
                <div class="modal fade" id="manager" tabindex="-1" role="dialog" aria-labelledby="managerTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <!-- 新增跳窗 -->
                        <div class="modal-content">
                            <figure class="modal-img">
                                <img src="../images/dayCookIndex_whiteBG1.svg" alt="">
                            </figure>
                            <div class="modal-header">
                                <h5 class="modal-title" id="managerTitle">新增管理員</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="d-flex form-group">
                                        <label for="manager0Id" class="col-form-label title-width">管理員帳號</label>
                                        <input type="text" class="form-control" id="manager0Id">
                                    </div>
                                    <div class="d-flex form-group">
                                        <label for="managerPsw" class="col-form-label title-width">管理員密碼</label>
                                        <input type="text" class="form-control" id="managerPsw">
                                    </div>
                                    <div class="d-flex form-group">
                                            <label for="managerAuth" class="title-width">管理員權限</label>
                                            <select class="form-control" id="managerAuth">
                                                <option>雞奴</option>
                                                <option>雞seafood</option>
                                                <option>雞長</option>
                                            </select>
                                        </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-primary mainBTN" id="managerbtn">存檔</button>
                                <button type="button" class="btn btn-secondary subBTN" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
						document.getElementById("managerbtn").addEventListener('click',function(){
						//=====使用Ajax,新增成就 
						var xhr = new XMLHttpRequest();
						xhr.onload = function (){
							if( xhr.status == 200){
								alert("管理員資料新增成功");
								// swal("成就資料新增成功", "", "success");
							}else{
								alert(xhr.status);
							}
						}

						if(document.getElementById("managerAuth").value == "雞奴"){
							managerState = 1;
						}else if(document.getElementById("managerAuth").value == "雞seafood"){
							managerState = 2;
						}else if(document.getElementById("managerAuth").value == "雞長"){
                            managerState = 3;
						}

						xhr.open("post", "backstage-manager-Insert.php", true);
						xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
						var data_info = "managerId=" + document.getElementById("manager0Id").value + //管理員帳號
										"&managerPsw=" + document.getElementById("managerPsw").value + //管理員密碼
                                        "&managerAuth=" + managerState;	//管理員權限	
                                        	
						// alert(data_info);
                        xhr.send(data_info);
                        
                        window.history.go(0);//重新整理頁面
					});
				</script>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">管理員編號</th>
                            <th scope="col">管理員帳號</th>
                            <th scope="col">管理員密碼</th>
                            <th scope="col">管理員權限</th>
                            <th scope="col">修改</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $errMsg = "";
                            try {
								  require_once("../connectMember.php");
                                $sqlmanager = "select * from manager";
                                $productsmanager = $pdo -> query( $sqlmanager );
                            } catch (PDOException $e) {
                                $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
                                $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
                            }
                        ?>
                        <?php	
                            if( $errMsg !=""){
                                echo "<tr><td colspan='6' align='center'>$errMsg</td></tr>";
                            }else{
                                while($prodRowmanager = $productsmanager->fetchObject()){
                        ?>
                        <tr>
                            <td><?php echo $prodRowmanager->manager_No ?></td>
                            <td><?php echo $prodRowmanager->manager_Id ?></td>
                            <td><?php echo $prodRowmanager->manager_Psw ?></td>
                            <td>
                                <?php
                                    if($prodRowmanager->manager_Auth == 1){
                                    echo '雞奴';
                                    }else if($prodRowmanager->manager_Auth == 2){
                                    echo '雞seafood';
                                    }else if($prodRowmanager->manager_Auth == 3){
                                    echo '雞長';
                                    }
                                ?>
                            </td>
                            <td>
                                <i class="fas fa-pencil-alt touch" data-toggle="modal" data-target="#viewManager<?php echo $prodRowmanager->manager_No ?>"></i>
                                <div class="modal fade" id="viewManager<?php echo $prodRowmanager->manager_No ?>" tabindex="-1" role="dialog" aria-labelledby="viewManagerTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <!-- 新增跳窗 -->
                                        <div class="modal-content">
                                            <figure class="modal-img">
                                                <img src="../images/dayCookIndex_whiteBG1.svg" alt="">
                                            </figure>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewManagerTitle">管理員資料</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="d-flex form-group">
                                                        <label for="viewMealNo" class="col-form-label title-width">管理員編號</label>
                                                        <input type="text" class="form-control" id="viewMealNo<?php echo $prodRowmanager->manager_No ?>" value="<?php echo $prodRowmanager->manager_No ?>" readonly>
                                                    </div>
                                                    <div class="d-flex form-group">
                                                        <label for="viewManagerNo" class="col-form-label title-width">管理員帳號</label>
                                                        <input type="text" class="form-control change" id="viewManagerNo<?php echo $prodRowmanager->manager_No ?>" value="<?php echo $prodRowmanager->manager_Id ?>" >
                                                    </div>
                                                    <div class="d-flex form-group">
                                                        <label for="viewManagerId" class="col-form-label title-width">管理員密碼</label>
                                                        <input type="text" class="form-control change" id="viewManagerId<?php echo $prodRowmanager->manager_No ?>" value="<?php echo $prodRowmanager->manager_Psw ?>" >
                                                    </div>
                                                    <div class="d-flex form-group">
                                                        <label for="viewMealSold" class="title-width">管理員權限</label>
                                                        <select class="form-control change-select" id="viewMealSold<?php echo $prodRowmanager->manager_No ?>">
                                                            <?php
                                                                if($prodRowmanager->manager_Auth == 1){
                                                            ?>
                                                                <option>雞奴</option>
                                                                <option>雞seafood</option>
                                                                <option>雞長</option>
                                                            <?php
                                                                }else if($prodRowmanager->manager_Auth == 2){
                                                            ?>
                                                                <option>雞seafood</option>
                                                                <option>雞奴</option>
                                                                <option>雞長</option>
                                                            <?php     
                                                                }else if($prodRowmanager->manager_Auth == 3){
                                                            ?>
                                                                <option>雞長</option>
                                                                <option>雞奴</option>
                                                                <option>雞seafood</option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-primary mainBTN btn-touch" id="manager-updata<?php echo $prodRowmanager->manager_No ?>">修改</button>
                                                <script>
													document.getElementById("manager-updata<?php echo $prodRowmanager->manager_No ?>").addEventListener('click',function(){
														//=====使用Ajax,更新成就  
														var xhr = new XMLHttpRequest();
														xhr.onload = function (){
															if( xhr.status == 200){
																alert("管理員資料更新成功");
																// swal("成就資料更新成功", "", "success");
															}else{
																alert(xhr.status);
															}
														}

                                                        if(document.getElementById("viewMealSold<?php echo $prodRowmanager->manager_No ?>").value == "雞奴"){
                                                            managerState = 1;
                                                        }else if(document.getElementById("viewMealSold<?php echo $prodRowmanager->manager_No ?>").value == "雞seafood"){
                                                            managerState = 2;
                                                        }else if(document.getElementById("viewMealSold<?php echo $prodRowmanager->manager_No ?>").value == "雞長"){
                                                            managerState = 3;
                                                        }
                                                        
														xhr.open("post", "backstage-manager-Updata.php", true);
														xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
                                                        var data_info = "manager_No=" + document.getElementById("viewMealNo<?php echo $prodRowmanager->manager_No ?>").value + //管理員編號
                                                                        "&managerId=" + document.getElementById("viewManagerNo<?php echo $prodRowmanager->manager_No ?>").value + //管理員帳號
                                                                        "&managerPsw=" + document.getElementById("viewManagerId<?php echo $prodRowmanager->manager_No ?>").value + //管理員密碼
                                                                        "&managerAuth=" + managerState;	//管理員權限	

														// alert(data_info);
														xhr.send(data_info);
                                                        window.history.go(0);//重新整理頁面
                                                    });
												</script>
                                                <button type="button" class="btn btn-secondary subBTN" data-dismiss="modal">取消</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                                }//while
                            }//else	
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
  
    <!-- <button type="button" id="BackTop" class="toTop-arrow"></button> -->
    <a href="#top" class="toTop-arrow"><i class="fas fa-arrow-circle-up"></i></a>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- 按鈕切換 -->
    <!-- <script>
        $(".touch").click(function(){

            $(".change").attr("readonly",true);
            $(".change-select").attr("disabled",true);
            $('.btn-touch').click(function(){
                $(".change").attr("readonly",false);
                $(".change-select").attr("disabled",false);
                //..........
                if($(".btn-touch").html() == "確認"){ //update to db;
                    $('.btn-touch').html("修改");
                    $(".change").attr("readonly",true);
                    $(".change-select").attr("disabled",true);
                }else{
                    $('.btn-touch').html("確認");
                }
                //..........
            });
        });
    </script> -->

<!-- GoTop -->
    <!-- <script>
        $(function(){
            $('#BackTop').click(function(){ 
                $('html,body').animate({scrollTop:0}, 333);
            });
            $(window).scroll(function() {
                if ( $(this).scrollTop() > 300 ){
                    $('#BackTop').fadeIn(222);
                } else {
                    $('#BackTop').stop().fadeOut(222);
                }
            }).scroll();
        });
    </script>  -->

</body>
</html>
