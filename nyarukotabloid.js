var wpNyarukoTabloidNowpage = 0;
var wpNyarukoTabloidPaper = $("#wpNyarukoTabloidPaper");
var wpNyarukoTabloid = $(".wpNyarukoTabloid")[0];
var wpNyarukoTouch;

for (let i = 0; i < wpNyarukoTabloidTotal; i++) {
    const nowNyarukoTabloidItemTxtBox = document.getElementById("wpNyarukoTabloidItemTxtBox"+i);
    const nowNyarukoTabloidItemTxt = document.getElementById("wpNyarukoTabloidItemTxt"+i);
    nowNyarukoTabloidItemTxtBox.style.height = (nowNyarukoTabloidItemTxt.offsetHeight) + "px";
}

function wpNyarukoTabloidTriangleClick(isnext,isanimate=true) {
    // document.getElementsByClassName("wpNyarukoTabloid")[0].scrollLeft = document.body.clientWidth * gotopage;
    var newwpNyarukoTabloidNowpage = 0;
    if (isnext) {
        newwpNyarukoTabloidNowpage = wpNyarukoTabloidNowpage + 1;
    } else {
        newwpNyarukoTabloidNowpage = wpNyarukoTabloidNowpage - 1;
    }
    if (newwpNyarukoTabloidNowpage >= 0 && newwpNyarukoTabloidNowpage < wpNyarukoTabloidTotal) {
        wpNyarukoTabloidNowpage = newwpNyarukoTabloidNowpage;
        var gotowidth = (document.body.clientWidth * wpNyarukoTabloidNowpage * -1)+"px";
        wpNyarukoTabloidPaper.stop();
        if (isanimate) {
            wpNyarukoTabloidPaper.animate({
                "left":gotowidth
            },300);
        } else {
            wpNyarukoTabloidPaper.css("left",gotowidth);
        }
        // window.location.hash = wpNyarukoTabloidNowpage + 1;
    }
    wpNyarukoTabloidAutoHide();
}

function wpNyarukoTabloidGoToPage(page,isanimate=true) {
    wpNyarukoTabloidNowpage = page;
    wpNyarukoTabloidTriangleClick(false,isanimate);
}

document.onkeydown = function wpNyarukoTabloidKey(event) {
    if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 87 || event.keyCode == 65) {
        wpNyarukoTabloidTriangleClick(false);
    } else if (event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 32 || event.keyCode == 83 || event.keyCode == 68 || event.keyCode == 13) {
        wpNyarukoTabloidTriangleClick(true);
    } else if (event.keyCode >= 48 && event.keyCode <= 57) {
        var keypage = event.keyCode - 48;
        if (keypage == 0) keypage = 10;
        wpNyarukoTabloidGoToPage(keypage);
    } else if (event.keyCode >= 96 && event.keyCode <= 105) {
        var keypage = event.keyCode - 96;
        if (keypage == 0) keypage = 10;
        wpNyarukoTabloidGoToPage(keypage);
    }
}
var wpNyarukoTabloidMouseWI = 0;
var wpNyarukoTabloidMouseWO = false;
var wpNyarukoTabloidMouseWD = null;
document.onmousewheel = function wpNyarukoTabloidMouse(e) {
    clearTimeout(wpNyarukoTabloidMouseWD);
    wpNyarukoTabloidMouseWD = setTimeout(function(){
        wpNyarukoTabloidMouseWI = 0;
        wpNyarukoTabloidMouseWO = true;
    },500);
    wpNyarukoTabloidMouseWI++;
    // console.log("wpNyarukoTabloidMouseWI",wpNyarukoTabloidMouseWI);
    if (wpNyarukoTabloidMouseWO && wpNyarukoTabloidMouseWI > 10) {
        wpNyarukoTabloidMouseWI = 0;
        clearTimeout(wpNyarukoTabloidMouseWD);
        e = e || window.event;
        var scroll = 0;
        if (e.wheelDelta) {//E/O/C
            scroll = e.wheelDelta;
        } else if (e.detail) {//FF
            scroll = e.detail;
        }
        if (scroll > 0) {
            wpNyarukoTabloidTriangleClick(false);
        } else if (scroll < 0) {
            wpNyarukoTabloidTriangleClick(true);
        }
    }
}

function wpNyarukoTabloidAutoHide() {
    if (wpNyarukoTriangleMode == false) {
        var newriangledisplay = ["block","block"];
        if (wpNyarukoTabloidNowpage < 0) {
            newriangledisplay[0] = "none";
        }
        if (wpNyarukoTabloidNowpage > wpNyarukoTabloidTotal) {
            newriangledisplay[1] = "none";
        }
        document.getElementsByClassName("wpNyarukoTabloidTriangleBoxLeft")[0].style.display = newriangledisplay[0];
        document.getElementsByClassName("wpNyarukoTabloidTriangleBoxRight")[0].style.display = newriangledisplay[1];
    }
}

wpNyarukoTabloid.addEventListener("touchstart",function(e){
    wpNyarukoTouch = e.touches[0];
},false);
wpNyarukoTabloid.addEventListener("touchmove",function(e){
    if (wpNyarukoTouch != Number.MAX_VALUE) {
        var touch = e.touches[0];
        var touchx = touch.pageX;
        var touchox = wpNyarukoTouch.pageX;
        if (touchox > touchx && (touchox - touchx) > 100) {
            wpNyarukoTabloidTriangleClick(true);
            wpNyarukoTouch = Number.MAX_VALUE;
        } else if (touchx > touchox && (touchx - touchox) > 100) {
            wpNyarukoTabloidTriangleClick(false);
            wpNyarukoTouch = Number.MAX_VALUE;
        }
    }
},false);
wpNyarukoTabloid.addEventListener("touchend",function(e){
    wpNyarukoTouch = 0;
},false);

function wpNyarukoTabloidTriangleStyle(isr,tid,issty) {
    var lr = isr ? "R" : "L";
    var nc = "_" + lr + "_" + tid;
    var nbox = $("#wpNyarukoTabloidTriangleBox"+nc);
    var nt = $("#wpNyarukoTabloidTriangle"+nc);
    if (issty) {
        nt.css("border-color","#FFF");
        nbox.css("background-color","rgba(0, 0, 0, 0.5)");
    } else {
        nt.css("border-color","rgba(255, 255, 255, 0.3)");
        nbox.css("background-color","transparent");
    }
}

function wpNyarukoTabloidArgGoTo() {
    var agtstr = window.location.hash.slice(1);
    var agtnum = parseInt(agtstr);
    if (!isNaN(agtnum)) {
        wpNyarukoTabloidGoToPage(agtnum,false);
    }
    // else {
    //     window.location.hash = wpNyarukoTabloidNowpage + 1;
    // }
}

wpNyarukoTabloidAutoHide();
wpNyarukoTabloidArgGoTo();
$(window).resize(function(){
    wpNyarukoTabloidNowpage++;
    wpNyarukoTabloidGoToPage(wpNyarukoTabloidNowpage,false);
});