###### tags: `前端設計工程師養成班`
# CD103 Web/APP前端設計工程師養成班
 
 - 上課講義
[sass講義](https://www.gitbook.com/book/sexfat/greenie-s-manual/details)

- 上課檔案
[github / cd103](https://github.com/sexfat/cd103)

- sass官網
[sass offical website](http://sass-lang.com/) 

- sass 線上中文手冊 
[線上中文手冊](http://sass.bootcss.com/docs/sass-reference/)

- sass解決中文註解的問題
[中文註解](http://jsnwork.kiiuo.com/archives/1723/sass-scss-compass-susy2-ruby-%E8%A7%A3%E6%B1%BA%E4%B8%AD%E6%96%87%E8%A8%BB%E8%A7%A3%E7%99%BC%E7%94%9F%E9%8C%AF%E8%AA%A4)

- sass  結構
https://github.com/sexfat/sass_structure

- sass 測驗
https://hackmd.io/8lJkXaqyTneafG7grty8bg?view

- 範例網站
https://www.deadwater.fr/
http://www.details.ch/
https://bewegen.com/en

# 什麼情況是要移掉class

?



[sass 線上編輯器](https://www.sassmeister.com/)



## 指令

sudo 管理者權限
cd 到下一層目錄
cd.. 回到上一層
ls    mac查詢指令 
dir   win 查詢指令
node -v  node 版本  
sass -v  sass 版本
gulp -v  gulp 版本  
mkdir 建立資料夾
建立




# 安裝sass

```
npm install -g sass
```


# 安裝 gulp
``` 
npm install gulp-cli -g
```

# 進入專案

   `cd 專案名稱`



# 安裝gulp程式在專案裡

1. 安裝 `gulp`
```
touch gulpfile.js
npm install gulp --save-dev
```

2. 安裝 `gulp-sass`
```
npm install gulp-sass --save-dev
```



3. 安裝 `browserSync`

```
npm install browser-sync gulp --save-dev
```


4. gulpfile.js

> 把底下這段放入gulpfile.js 檔案裡

```jsx=
//套件引入
var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;


// sass 編譯函式
gulp.task('sass', function () {
  return gulp.src('./sass/*.scss') //來源目錄
    .pipe(sass().on('error', sass.logError)) //經由sass 轉譯
    .pipe(gulp.dest('./css')); //目的地目錄
});





gulp.task('default', ['sass'], function () {

  browserSync.init({
    server: {
      //根目錄
      baseDir: "./",
      index: "index.html"
    }
  });

  gulp.watch(["sass/*.scss"  , "sass/**/*.scss"], ['sass']).on('change', reload);
  gulp.watch("*.html").on('change', reload);
  gulp.watch("js/*.js").on('change', reload);
  gulp.watch("images/*").on('change', reload);
  // gulp.watch("images/*").on('change', reload);
});

```


### 執行`gulp`




# sass 變數




```css=
$fontsize: 40px;


.box {
    font-size: $fontsize;
    color: rgba(188, 216, 3, 0.625);
}

body {
    font-size: $fontsize
}

```



# nesting 巢狀

```css
$basefont: 12px;
$fontsize: 40px;
$num: 50px;


body {
    font-size: $basefont;

}

h1 {
    font-size: $basefont * 3;
}

.box {
    font-size: $fontsize;
    color: rgba(188, 216, 3, 0.625);
}

body {
    font-size: $fontsize
}
```

# @import 用法

```
@import "var";

body {
    font-size: $basefont;

}

h1 {
    font-size: $basefont * 3;
}

.box {
    font-size: $fontsize;
    color: rgba(188, 216, 3, 0.625);
}

body {
    font-size: $fontsize
}
```


# @mixin


- 1.不傳值
```
@mixin margin-auto() {
    margin-left: auto;
    margin-right: auto;
}
```

`呼叫 @include margin-auto()`


-  2.傳值進來

```css
@mixin wrapper($width) {
    width: $width;
    margin-left: auto;
    margin-right: auto;
}

```

- 3. 傳多值

  - null值的用途
  - 預設值如何用
 
```css
@mixin width($width:120px , $height:null) {
    width: $width;
    height: $height;
}



.box2 {
    @include margin-auto();
    @include width(140px, 400px);
}

```




- 4 mixin 裡面在呼叫另一個函式
```
@mixin fontsize() {
    font-size: 18px
}


@mixin width($width:120px , $height:100px ) {
    width: $width;
    height: $height;
    @include margin-auto();
    @include fontsize()

}

//呼叫方式
.box2 {
    @include width(140px, 400px);
}



```

#  #{}跳脫字元 在`classname`上使用
```css
@mixin floats($classname,$dir , $width , $height) {
    #{$classname} {
       float: $dir; 
       width: $width;
       height: $height;
    }
}

.sidebar {
 @include floats('.article', right, 100px ,500px);
}
```


# extend

```css=
.btn {
 width: 100px;
 height : 40px;
 cursor: pointer;
 border: 1px solid;

}

@mixin btns(){
    width: 100px;
    height : 40px;
    cursor: pointer;
    border: 1px solid;
}



.btn-yellow {
  background-color: yellow;
 @extend .btn;
//  @include btns();
  
}

.btn-blue {
background-color: blue;
@extend .btn;
// @include btns();


}
```
# %extend

占位符號寫法

 ```
 
 %btn {
 width: 100px;
 height : 40px;
 cursor: pointer;
 border: 1px solid;
}

@extend %btn;


 
 ```



# 偽類寫法


```css=
a {
    color: rgb(0, 0, 0);

    &:hover {
        color: #d40000;
    }

    ;

}

p {
    font-size: 10px;

    &::before {
        content: '';
    }

    margin: 20px;
}
a {
    &.red {
        background-color: #f20;
    }
}
```


# 運算 

```

//注意 “單位” 跟 “除法”
.box {
    width: 10px + 5px;
    height: 10px - 5;
    max-width: 10 * 10px;
    min-height: (50px / 20);
    font: 12px / 18px;

}
```


```

span {
    font-size: floor(14.58px); //無條件捨去 
    width: round(14.58px); //四捨五入
    height: ceil(14.38px); //無條件進位
}

```



```
$basefont : 14px;

body {
    font-size:$basefont;
}

h1 {font-size: floor($basefont * 5.4) }
h2 {font-size: $basefont * 3 }
h3 { font-size: round($basefont * 1.8) }
h4 {font-size: $basefont * 1.4 }
h5 {font-size: $basefont * 1 }
```

# 比較符號
```
//比較符號

$bgc:yellow;

.box-color {
    @if $bgc==red {
        background-color: red;

    }

    @else {
        background-color: #fff;
    }
}


$width : 100px ;
.wrapper {

    @if $width >= 40px {
        height: 100px;

    }

    @else {
        height: 50px
    }
```

# for 迴圈
```css=
@mixin box-list ($num) {
    @for $i from 1 through $num {
        .box-#{$i} {
            margin: 100px * $i;
        }
    }
}

.sidebar {
    @include box-list (50);
}
```


```css=
@for $i from 1 through 100 {
    .push-left-#{$i} {
        margin-left: $i * 1px;
    }
}
```
# each迴圈
```css=
@mixin bgi($images ,$w , $h) {
    @each $img in $images {
        #{$img}-images {
            background-image: url('images/#{$img}.jpg');
            display: block;
            width: $w;
            height: $h;
        }
    }
}


@include bgi([a1 , a2 ,a3] , 10px , 100px);
```


# while 迴圈

```
$aa : 20;

@while $aa > 0 {
   .box-#{$aa}{
     width : 10px-$aa ;
   }
    $aa: $aa - 1;
}
```


```css=
@mixin content() {
    .box {
        background-color: #fff;
        @content
    }
    .box-red {
        background-color: #f20;
        @content
    }
}

@include content(){
   margin: 10px;
   padding: 20px;
   width: 20px;
};
```


# rwd
```css=

$moblie : 721px;
$medium:  1090px;
$desktop : 1920px;

@mixin rwd ($breakpoint) {
    @if $breakpoint == moblie {
        @media only screen and (max-width: $moblie) {
            @content;
        }
    }

    @else if $breakpoint== medium {
        @media all and (min-width: $medium) {
            @content;
        }
    }

    @else if $breakpoint == desktop {
        @media all and (min-width: $desktop) {
            @content
        }
    }
}


//使用方式
@include rwd(moblie){
 font-size: 30px;
}

@include rwd(desktop){
    font-size: 30px;
   }

@include rwd(medium){
    font-size: 20px;
   }





```

# each 運用

```
//list 
$list : a01,
a02,
a03,
a04;

span {
    width: length($list); 
    height: nth($list, 4);

}

// $map 

$map :(red : #f20,
green : rgb(0, 255, 21),
yellow : rgb(251, 255, 0));

.bgc {
    background-color: map-get($map, yellow);

}
//respond web

$breakpoint : (
moblie :  721px,
medium: 988px,
desktop: 1366px,
xx-desktop: 2000px 
);



@mixin respond($resp) {
  @each $viewpoint , $num  in $breakpoint {
    @if  $resp == $viewpoint {
        @media all and (min-width : $num) {
            @content;
        }
    }
  }
}
@include respond(xx-desktop){
  padding: 100px;

};
```

```
@mixin grid($attr , $num) {
    @for $i from 1 through $num {
       .col-#{$attr}-#{$i}{
          width: ($i / $num) * 100%;
       }
    }
}

//使用方式
 @include grid(md, 12);
```




# 安裝 bower 

`npm install -g bower`


# 安裝git
`https://git-scm.com/`

.gitignore





bower.json
```jsonld=
{
    "name": "cd103",
    "description": "cd103",
    "main": "",
    "license": "MIT",
    "homepage": "home",
    "ignore": [
      "**/.*",
      "node_modules",
      "bower_components",
      "libs",
      "test",
      "tests"
    ],
    "dependencies": {
      "jquery": "^3.1.1",
      "owl.carousel": "^2.1.5",
      "jqueryui": "^1.12.1",
      "font-awesome": "fontawesome#^4.6.3",
      "bootstrap-sass": "^3.3.6",
      "animate-sass": "^0.6.4"
    },
    "devDependencies": {
      "animate.css": "^3.5.2",
      "materialize": "^0.98.0",
      "hover": "^2.1.1",
      "compass-mixins": "^1.0.2",
      "jquery.stellar": "^0.6.2",
      "remodal": "^1.1.1",
      "daterangepicker": "^1.6.0",
      "gsap": "^1.18.4",
      "ScrollMagic": "^2.0.5",
      "modernizr": "^3.3.1",
      "parallax": "^2.1.3",
      "neat": "^2.0.2",
      "compass-sass-mixins": "*",
      "flipclock": "FlipClock#^0.7.7",
      "wow": "^1.1.2"
    }
  }
```


.bowerrc
```jsonld=
{
    "directory" : "libs"
}
```


## tweenmax 路徑
```jsx=
<script type="text/javascript" src="libs/gsap/src/minified/TweenMax.min.js"></script>
```



# twenmax基本

### 補間動畫
https://greensock.com/docs/Easing


### To 寫法

```jsx

TweenMax.to(".box01" ,.8 ,{x:200,ease:Elastic.easeOut});
```


### From 寫法
```jsx
TweenMax.from(".box02", .8, {
    y: 200,
    ease: SlowMo.ease.config(0.7, 0.7, false),
    delay: 4
});
```


```jsx=
    x: 200,
    y: 100,
    ease: Elastic.easeOut,
    delay: 2,
    width: 100,
    scale: 1.9,
    alpha: 0,
    repeat: 2,
    repeatDelay : 1,
    rotation : 360
```

### set / fromTo

```jsx=

TweenMax.set(".box03", {
    y: 200,
    x: 10
});


TweenMax.fromTo(".box04", 4, {
    y: -230 
}, {
    y: 150,
    delay:3,
    ease: Elastic.easeOut,
    repeat : 2,
    yoyo: true
});

TweenMax.set(".box05", {
    className: "+=addclass",//增加classname
    className: "addclass"//換掉classname
    
});
```

### 旋轉參數
```jsx=
    rotation: 360,
    transformOrigin : 'right top'
    rotationX: 720,
    scaleX: .7,
```    
### 顏色參數
```jsx=
backgroundColor: '#c603e0',
boxShadow: "0px 10px 10px black",//陰影
```


### bezier 路徑

```jsx=
TweenMax.to(".box07", 2, {
    bezier: {
        values: [{
            x: 0,
            y: 0
        }, {
            x: 250,
            y: 400
        }, {
            x: 170,
            y: 200
        },  {
            x: 0,
            y: 0
        }],
        autoRotate: false
    },
    ease: Power1.easeOut
});
```


 ### staggerFromTo 去控制時間順序

```jsx=
TweenMax.staggerFromTo('.box08', 1, {
    y: 0
}, {
    y: 100
},.8);
```

### 跑多物件

```jsx=
TweenMax.staggerFromTo('.box08 , .box07 , .box06', 1, {
    y: 0
}, {
    y: 100
},.8);
```
### jquery

```jsx=
<script type="text/javascript" src="libs/jquery/dist/jquery.min.js"></script>
```

### jquery + tweenmax
```jsx=
var _btn = $('.btn');


_btn.on('click' , function(){
    TweenMax.staggerFromTo(".box09", 1, {
        scale: 1.2,
        alpha: 0
    }, {
        scale: 1,
        alpha: 1,
        ease: Elastic.easeOut
    }, 0.2);
});
```

https://rewind2017.withyoutube.com/



```jsx=
//先new 物件
var tl = new TimelineMax({
    repeat: -1,
    repeatDelay: 3
});



tl.add(
    //a
    TweenMax.to(".box10", 1, {
        x: 200,
        y: 100,
        ease: Elastic.easeOut,

    }));
tl.add(
    //b
    TweenMax.to(".box11", 2, {
        x: 300,
        y: 200,
        rotation: 180,
        ease: Elastic.easeOut,
        scale: 1.9
    }));

```
timelinemax 第二種寫法

```jsx=
tl.to(".box10", 1, {
    x: 200,
    y: 100,
    ease: Elastic.easeOut,

}).to(".box11", 2, {
    x: 300,
    y: 200,
    rotation: 180,
    ease: Elastic.easeOut,
    scale: 1.9
});

```


```jsx=
var tw01 =  TweenMax.to(".box10", 1, {
    x: 200,
    y: 100,
    ease: Elastic.easeOut,

});



var tw02 = TweenMax.to(".box11", 2, {
    x: 300,
    y: 200,
    rotation: 180,
    ease: Elastic.easeOut,
    scale: 1.9
});


tl.add([tw01 , tw02]);

tl.stop();

//控制播放
document.getElementById('btn_play').onclick = function () {
    tl.play(0);
}
//控制播放
document.getElementById('btn_stop').onclick = function () {
    tl.stop();
}

```


###  onComplete: function



# parallax.js

載入
link: https://github.com/sexfat/cd103/blob/master/js/parallax.min.js

`<script type="text/javascript" src="js/parallax.min.js"></script>`

- html

```htmlmixed=
  <div id="parallax_box" class="section02 section" data-hover-only="true">

        <div class="box box_01" data-depth="0.3">parallax01</div>
        <div class="box box_02" data-depth="0.2">parallax02</div>
        <div class="box" data-depth="0.4">parallax03</div>
        <div class="box" data-depth="0.6">parallax04</div>


    </div>
```

- js
```jsx=
var scene = document.getElementById('parallax_box');
var parallax = new Parallax(scene);

```

- scss
```css=
.section02 {
    background-color: rgb(234, 188, 255);

    .box_01 {
        position: relative;
        top: 300px !important;
        left: 300px !important;
    }

    .box_02 {
        position: relative;
        top: 100px !important;
        left: 700px !important;
    }

}

```




###  scrollTo plugin

    `<script type="text/javascript" src=" libs/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>`
    

- 錨點
`<div id="archor"></div>`




```jsx=
//按鈕事件
document.getElementById('btn_scrollto').onclick = function () {
//注意windows 物件
    TweenMax.to(window ,1,{
        scrollTo:{
            y:"#archor",//到達錨點
            offsetY: 100//位移
        }
      })
}

```


### TextPlugin

html
```
<div class="textbox"></div>
```

js
```jsx
TweenLite.to('.textbox', 3, {
   text:"鼎泰豐驚爆漲價 餐飲業：一例一休壓頂 勢在必漲 增加文字",
   ease: Linear.easeNone 
})

```



# scrollmagic

- html

```htmlmixed=
<script type="text/javascript" src="libs/ScrollMagic/scrollmagic/minified/ScrollMagic.min.js"></script>
    <script type="text/javascript" src="libs/ScrollMagic/scrollmagic/minified/plugins/animation.gsap.min.js"></script>
    <script type="text/javascript" src="libs/ScrollMagic/scrollmagic/minified/plugins/debug.addIndicators.min.js"></script>
```

    
 
 
 - js
 ```jsx=
 // scrollmagic 初始化

var controller = new  ScrollMagic.Controller();


var tw01 = TweenMax.to('.section03 .box_01' , 1, {y: 100});


var scene_01 = new ScrollMagic.Scene({
    //觸發點
    triggerElement : '#trigger01',
    //偏移 y軸
    offset: 100,
    //偏移 0 - 1
    triggerHook: 0.3,
    //範圍
    duration: 600,
    // 動畫是否還原 預設是true
    reverse: false
}).setTween(tw01)
.addIndicators({
    name: 'section01',
    colorStart: '#f20',
    colorEnd: '#000'
})
.addTo(controller);
 ```
 
   
html 觸發點

`  <div id="trigger01"></div>`




- 結合兩段動畫


```jsx=
var section_02 = new TimelineMax({
    repeat: 2
});

section_02.to('.parallax_01', 1 , {
    width: '100%'
}).to('.parallax_02', 1 ,{
    width: '80%',
    x: '20%'
}).to('.parallax_03', 1 ,{
    width: '60%',
    x: '40%'
});





var scene_02 = new ScrollMagic.Scene({
        triggerElement: '#trigger02',
        // offset: 100,
        duration: 600,
        triggerHook: 0.5,
        reverse: false
    }).setTween(section_02)
    .addIndicators({
        name: 'section_02',
        colorStart: '#f20',
        colorEnd: '#000'
    })
    .addTo(controller);
```


# scrollmagic 結合tween 產生視差效果


html
```htmlmixed=
<div class="section section05">
        <div class="box box_01"></div>

    </div>
```


scss
```css=
@mixin boxs($width ,$height) {
    width: $width;
    height: $height;
}
.section05 {
    background-color: rgb(224, 224, 224);
    background-image: url('https://placem.at/people');
    background-size: cover;  
    
    .box_01{
        @include boxs(80px, 80px);
        position: relative;
        top: 300px;
        left: 400px;
    } 
}
```


js
```jsx=
var parallax_sc =  TweenMax.to('.section05 .box_01' ,1,{
    y: '60%',
    ease: Power1.easeOut 
})








var scene_03 = new ScrollMagic.Scene({
        triggerElement: '#trigger03',
        duration: '100%',
        triggerHook: 0,
        // reverse: true
    }).setTween(parallax_sc)
    .addIndicators({
        name: 'section03',
        colorStart: '#f20',
        colorEnd: '#000'
    })
    .addTo(controller);

```


```jsx=
var parallax_sc =  new TimelineMax();


parallax_sc.to('.section05 .box_01' ,1,{
    y: '60%',
    ease: Power1.easeOut 
}).to('.section05 .box_02' ,1,{
    y: '40%',
    ease: Power1.easeOut 
}).to('.section05 .box_03' ,1,{
    y: '50%',
    ease: Power1.easeOut 
})








var scene_03 = new ScrollMagic.Scene({
        triggerElement: '#trigger03',
        duration: '100%',
        // triggerHook: 1,
        // reverse: true
    }).setTween(parallax_sc)
    //結合其他funtion
    .on('enter', function(){
       console.log('message enter')
    })
    .on('leave', function(){
        console.log('message leave')
     })
    .addIndicators({
        name: 'section03',
        colorStart: '#f20',
        colorEnd: '#000'
    })
    .addTo(controller);
```




# setClassToggle 動態insert class



```jsx=
  var scene_04 = new ScrollMagic.Scene({
        triggerElement: '#trigger04'
        // offset: 100,
        // duration: 600,
        // triggerHook: 0.5,
        // reverse: true
    })
    // 選擇器 , classname
    .setClassToggle('.section06' , 'fadein')
    .addIndicators({
        name: 'section_04',
        colorStart: '#f20',
        colorEnd: '#000'
    })
    .addTo(controller);
```

