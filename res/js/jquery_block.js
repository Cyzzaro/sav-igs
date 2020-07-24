function disableselect() {
    return !1
}

function reEnable() {
    return !0
}
$(function() {
        $("*").bind("contextmenu", function() {
            return !1
        })
    }),
    document.onselectstart = new Function("return false"),
    window.sidebar && (document.onmousedown = reEnable, document.onclick = reEnable)