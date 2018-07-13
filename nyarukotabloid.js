var wpNyarukoTabloidNowpage = 0;
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
    console.log(newwpNyarukoTabloidNowpage,wpNyarukoTabloidTotal);
    if (newwpNyarukoTabloidNowpage >= 0 && newwpNyarukoTabloidNowpage < wpNyarukoTabloidTotal-1) {
        wpNyarukoTabloidNowpage = newwpNyarukoTabloidNowpage;
        var gotowidth = document.body.clientWidth * wpNyarukoTabloidNowpage;
        $(".wpNyarukoTabloid").scrollLeft(gotowidth);
    }
}
document.onkeydown= function wpNyarukoTabloidKey(event) {
    if (event.keyCode == 37 || event.keyCode == 38) {
        wpNyarukoTabloidTriangleClick(false);
    } else if (event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 32) {
        wpNyarukoTabloidTriangleClick(true);
    }
}