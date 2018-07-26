var wpNyarukoTabloidNowpage = 0;
var wpNyarukoTabloidPaper = $("#wpNyarukoTabloidPaper");
var wpNyarukoTabloid = $(".wpNyarukoTabloid")[0];
var wpNyarukoTouch;

for (let i = 1; i < wpNyarukoTabloidTotal; i++) {
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
    if (newwpNyarukoTabloidNowpage >= 0 && newwpNyarukoTabloidNowpage < wpNyarukoTabloidTotal-1) {
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
        window.location.hash = wpNyarukoTabloidNowpage + 1;
    }
    wpNyarukoTabloidAutoHide();
}

function wpNyarukoTabloidGoToPage(page,isanimate=true) {
    wpNyarukoTabloidNowpage = page;
    wpNyarukoTabloidTriangleClick(false,isanimate);
}

document.onkeydown = function wpNyarukoTabloidKey(event) {
    if (event.keyCode == 37 || event.keyCode == 38) {
        wpNyarukoTabloidTriangleClick(false);
    } else if (event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 32) {
        wpNyarukoTabloidTriangleClick(true);
    }
}

function wpNyarukoTabloidAutoHide() {
    if (wpNyarukoTriangleMode == false) {
        var newriangledisplay = ["block","block"];
        if (wpNyarukoTabloidNowpage <= 0) {
            newriangledisplay[0] = "none";
        }
        if (wpNyarukoTabloidNowpage >= wpNyarukoTabloidTotal-2) {
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
    if (wpNyarukoTouch != 65536) {
        var touch = e.touches[0];
        var touchx = touch.pageX;
        var touchox = wpNyarukoTouch.pageX;
        if (touchox > touchx && (touchox - touchx) > 100) {
            wpNyarukoTabloidTriangleClick(true);
            wpNyarukoTouch = 65536;
        } else if (touchx > touchox && (touchx - touchox) > 100) {
            wpNyarukoTabloidTriangleClick(false);
            wpNyarukoTouch = 65536;
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
    } else {
        window.location.hash = wpNyarukoTabloidNowpage + 1;
    }
}

wpNyarukoTabloidAutoHide();
wpNyarukoTabloidArgGoTo();
$(window).resize(function(){
    wpNyarukoTabloidNowpage++;
    wpNyarukoTabloidGoToPage(wpNyarukoTabloidNowpage,false);
});