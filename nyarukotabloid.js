var wpNyarukoTabloidNowpage = 0;
var wpNyarukoTabloidTriangleLeft = document.getElementsByClassName("wpNyarukoTabloidTriangleLeft")[0];
var wpNyarukoTabloidTriangleRight = document.getElementsByClassName("wpNyarukoTabloidTriangleRight")[0];
var wpNyarukoTabloidPaper = $("#wpNyarukoTabloidPaper");
var wpNyarukoTabloid = $(".wpNyarukoTabloid")[0];
for (let i = 1; i < wpNyarukoTabloidTotal; i++) {
    const nowNyarukoTabloidItemTxtBox = document.getElementById("wpNyarukoTabloidItemTxtBox"+i);
    const nowNyarukoTabloidItemTxt = document.getElementById("wpNyarukoTabloidItemTxt"+i);
    nowNyarukoTabloidItemTxtBox.style.height = (nowNyarukoTabloidItemTxt.offsetHeight) + "px";
}
function wpNyarukoTabloidTriangleClick(isnext) {
    // document.getElementsByClassName("wpNyarukoTabloid")[0].scrollLeft = document.body.clientWidth * gotopage;
    var newwpNyarukoTabloidNowpage = 0
    if (isnext) {
        newwpNyarukoTabloidNowpage = wpNyarukoTabloidNowpage + 1;
    } else {
        newwpNyarukoTabloidNowpage = wpNyarukoTabloidNowpage - 1;
    }
    if (newwpNyarukoTabloidNowpage >= 0 && newwpNyarukoTabloidNowpage < wpNyarukoTabloidTotal-1) {
        wpNyarukoTabloidNowpage = newwpNyarukoTabloidNowpage;
        var gotowidth = (document.body.clientWidth * wpNyarukoTabloidNowpage * -1)+"px";
        // wpNyarukoTabloidPaper.css({"left":gotowidth});
        wpNyarukoTabloidPaper.stop();
        wpNyarukoTabloidPaper.animate({
            "left":gotowidth
        },300);
    }
    wpNyarukoTabloidAutoHide();
}
document.onkeydown = function wpNyarukoTabloidKey(event) {
    if (event.keyCode == 37 || event.keyCode == 38) {
        wpNyarukoTabloidTriangleClick(false);
    } else if (event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 32) {
        wpNyarukoTabloidTriangleClick(true);
    }
}
function wpNyarukoTabloidAutoHide() {
    var newriangledisplay = ["block","block"];
    if (wpNyarukoTabloidNowpage <= 0) {
        newriangledisplay[0] = "none";
    }
    if (wpNyarukoTabloidNowpage >= wpNyarukoTabloidTotal-2) {
        newriangledisplay[1] = "none";
    }
    wpNyarukoTabloidTriangleLeft.style.display = newriangledisplay[0];
    wpNyarukoTabloidTriangleRight.style.display = newriangledisplay[1];
}
wpNyarukoTabloidAutoHide();