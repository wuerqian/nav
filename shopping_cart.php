<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>日食購物車</title>
    <link rel="stylesheet" href="css/shopping_cart.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

    <?php
        require_once("nav.php");
    ?>

    <div class="shopping_step">    
        <div class="step_list">
            <div class="step_box">
                <div>
                    <span>Step1</span>
                </div>
                <span>購物明細</span>
            </div>
            <div class="step_box">
                <div>
                    <span>Step2</span>
                </div>
                <span>確認訂單</span>
            </div>
            <div class="step_box">
                <div>
                    <span>Step3</span>
                </div>
                <span>購物完成</span>
            </div>
        </div>

        <div class="step_contain">
            <div class="step_contain_mask">
                <div class="shopping_details">
                    <table>
                        <tr>
                            <th>商品</th>
                            <th class="phone_hide">商品名稱</th>
                            <th>數量</th>
                            <th>單價</th>
                            <th>功能</th>
                        </tr>
                    </table>
                    <table class="shopping_list">
                    </table>
                    <div class="shopping_message">
                        <span class="taketime">預計等待時間：15分</span>
                        <div class="shopping_message_box">
                            <span class="shopping_number">共 1 件</span>
                            <span class="shopping_sum">總計 NT$200</span>
                            <span>使用購物金</span>
                            <span class="groupon_bonus">NT$ 10</span>
                            <input type="hidden" value="<?php echo $memRow->member_Bonus ?>" id="groupon_bonus_hidden">
                        </div>
                        <span class="memOrder_amount">結帳金額 NT$200</span>
                    </div>
                    <div class="shopping_choose">
                        <button class="continue_shopping_button">繼續購物</button>
                        <button id="shopping_Next_button">下一步</button>
                    </div>                   
                </div>
                
                <div class="confirm_order">
                    <table>
                        <tr>
                            <th>商品</th>
                            <th>商品名稱</th>
                            <th>數量</th>
                            <th>單價</th>
                        </tr>
                    </table>
                    <table class="shopping_list">
                    </table>
                    <div class="shopping_message">
                        <span class="taketime">預計等待時間：15分</span>
                        <div class="shopping_message_box">
                            <span class="shopping_number">共 1 件</span>
                            <span class="shopping_sum">總計 NT$200</span>
                            <span>使用購物金</span>
                            <span class="groupon_bonus">NT$ 10</span>
                        </div>
                        <span class="memOrder_amount">結帳金額 NT$200</span>
                    </div>
                    <div class="shopping_choose">
                        <button class="continue_shopping_button" id="shopping_pre_button">上一步</button>
                        <button id="checkout_immediately_button">立即結帳</button>
                    </div>  
                </div>
                
                <div class="shopping_completed">
                    <div>
                        <p class="p1">謝謝您的訂購<br class="table_hide">請於現場付款(自取)</p>
                        <p class="p2" id="order-data" >訂單編號：25<br>下單日期：2018/09/27</p>
                        <div class="take_meal_way">
                            <div class="take_meal_qr">
                                <p>手機上顯示此QRcode來取餐</p>
                                <img src="" alt="QRcode" id="take_meal_qr">
                                <p>(此QRcode會暫存於快速取餐中)</p>
                            </div>
                            <p>或是</p>
                            <div class="take_meal_code">
                                <p>記住以下代碼以取餐</p>
                                <p id="take_meal_code">Meal0020239</p>
                            </div>
                        </div>
                        <button id="order_record_button">查看訂購記錄</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/mojs/0.265.6/mo.min.js'></script>
    <script src="js/iconCliCK.js"></script>	
    <script src="js/cart_new.js"></script>
    <script>
        document.getElementById("checkout_immediately_button").addEventListener("click", function(){
            
            
            //取得目前時間
            // var t = new Date();
            // var current = t.getFullYear() + "/" + (t.getMonth()+1) + "/" + t.getDate();
            // var memOrderTime = t.getFullYear() + "-" + (t.getMonth()+1) + "-" + t.getDate() + " " + t.getHours() + ":" + t.getMinutes() + ":" + t.getSeconds();   
            // // var memOrderTakeTime = t.getFullYear() + "-" + (t.getMonth()+1) + "-" + t.getDate() + " " + t.getHours() + ":" + t.getMinutes() + ":" + (t.getSeconds() + itemTime);   
            // // 2018-11-17 22:52:04
            // //=====使用Ajax,新增購物車訂單 
            // var xhr = new XMLHttpRequest();
            // xhr.onload = function (){
            //     if( xhr.status == 200){
            //         // alert("下單成功");
            //         swal("下單成功", "", "success");
            //     }else{
            //         alert(xhr.status);
            //     }
            // }
            // xhr.open("post", "cartDataUpdate.php", true);
            // xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");

            // var data_info = "memOrderAmount=" + (total - Bonus) + //訂單金額
            //                 "&memOrderTime=" + memOrderTime + //下單時間
            //                 "&memOrderTakeTime=" + itemTime + //取餐等待時間                    
            //                 "&mealNo=" + storage.getItem('addItemList') + //餐點編號
            //                 "&mealQuantity=" + mealQuantity_list + //餐點數量
            //                 "&memberbuyCount=" + itemSum + //餐點購買總數
            //                 "&memberBonus=" + Bonus; //會員所消耗購物金
            // console.log(data_info);
            // xhr.send(data_info);
            
            // 從資料庫取得目前最後的訂單編號
            <?php 
                $errMsg = "";
                try {
                    // require_once("connectBooks.php");
                    $sqlMemberOrder = "select * from memberOrder 
                                       where member_No = " . $_SESSION["member_No"] .
                                      " order by memOrder_No DESC";
                    $productsMemberOrder = $pdo -> query( $sqlMemberOrder );
                } catch (PDOException $e) {
                    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
                    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
                }
            ?>
            <?php	
                if( $errMsg !=""){
                    echo "<tr><td colspan='6' align='center'>$errMsg</td></tr>";
                }else{
                    $prodRowMemberOrder = $productsMemberOrder->fetchObject();
                }
            ?>

             //取得目前時間
            var t = new Date();
            var current = t.getFullYear() + "/" + (t.getMonth()+1) + "/" + t.getDate();   
            
             //顯示訂單資訊
            orderData = document.getElementById("order-data");
            orderData.innerHTML = "訂單編號：<?php echo $prodRowMemberOrder->memOrder_No+1 ?><br>下單日期：" + current; 
            
             //顯示訂單代碼
            takeMealCode = document.getElementById("take_meal_code");
            var Mealc = "Meal" + t.getFullYear() + <?php echo $prodRowMemberOrder->memOrder_No+1 ?> + t.getDate();         
            takeMealCode.innerText = Mealc;

            //製作qrcode
            function QRCode(content, width, height){
                // 編碼
                content = encodeURIComponent(content);
                return 'http://chart.apis.google.com/chart?cht=qr&chl=' + content + '&chs=' + width + 'x' + height;
            }

            imgName = <?php echo $prodRowMemberOrder->memOrder_No+1 ?>; //檔名為訂單編號

            var msg = "http://140.115.236.72/demo-projects/CD103/CD103G3/takeMeal.php?memOrderNo=" + Mealc, //放入qrcode的內容
            imgSrc = QRCode(msg, 150, 150), //設定qrcode內容和寬高
            qrcodeimg = document.getElementById('take_meal_qr');  //取得要放入qrcode的標籤    

            qrcodeimg.src = imgSrc; //顯示qrcode
        
            //下載儲存QRcode圖片
            var xhr = new XMLHttpRequest();
            xhr.onload = function (){
                if( xhr.status == 200){
                    // alert("儲存成功");
                    swal("儲存成功", "", "success");
                }else{
                    alert(xhr.status);
                }
            }
            xhr.open("post", "imgDownload.php", true);
            xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");

            var data_info = "imgName=" + imgName + //檔案名稱 
                            "&imgSrc=" + msg; //檔案位置
            console.log(data_info);
            xhr.send(data_info);      
        });
    </script>
</body>
</html>
