/**
 * Created by ericzheng on 14/12/9.
 */
window.splitStr = function (txt, length) {
    if (txt === undefined || txt === null || !length) {
        return '';
    }
    var charLen = 0,splitAtLength = 0,isNeedSplit;
    for (var i = 0; i < txt.length; i++) {
        var c = txt.charCodeAt(i);//转换成字节
        if ((c >= 0x0001 && c <= 0x007e) || (0xff60 <= c && c <= 0xff9f)) {//单字节加1
            charLen++;
        } else {
            charLen += 2;
        }
        if (charLen <= length) {
            splitAtLength++;
        }else if(charLen>length+3){
            isNeedSplit = true;
            break;
        }
    }
    return isNeedSplit ? (txt.substring(0, splitAtLength) + "...") : txt;
};