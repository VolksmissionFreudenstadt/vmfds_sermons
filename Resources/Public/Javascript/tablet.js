function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}

function getCurrentFontSize() {
    var fontSize = parseInt($('.container').first().css('font-size').replace('px', ''));
    $('#fontSizeInfo').html(fontSize+"px");
    return fontSize;
}


$(document).ready(function(){
    getCurrentFontSize();

    $('#fontLarger').click(function(){
        $('.container').css('font-size', getCurrentFontSize()+1+"px");
    });
    $('#fontSmaller').click(function(){
        $('.container').css('font-size', getCurrentFontSize()-1+"px");
    });

});
