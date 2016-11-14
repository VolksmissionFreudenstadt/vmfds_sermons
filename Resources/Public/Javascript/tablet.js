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

function pad ( val ) { return (val > 9 ? val : "0" + val); }

function timeFormat(val) {
    return (val < 0 ? '-' : '') + pad(parseInt(Math.abs(val)/60,10)) + ':' + pad(Math.abs(val)%60);
}

function setTimer(id, val) {
    $(id).html(timeFormat(val));
}


var sec = 0;
var secOnSlide = 0;
var timedSlide = false;
var slideLimit = 0;
var paused = false;
var slideActive = false;
var slideCount = 0;

function checkToolbarColor() {
    if (slideActive) {
        if ((timedSlide) && (secOnSlide<61) && (secOnSlide>=0)) {
            $('#toolbar').css('background-color', 'orange');
        }
        if (secOnSlide<0) {
            $('#toolbar').css('background-color', 'red');
        }
    } else {
        $('#toolbar').css('background-color', 'black');
    }
}

function scrollTo (id) {
    $('html, body').animate({
        scrollTop: id.offset().top
    }, 20);
}

var current;

$(document).ready(function(){

    $('#slideNav').hide();

    slideCount= $('a.slideHeader').length;

    getCurrentFontSize();

    $('#fontLarger').click(function(){
        $('.container').css('font-size', getCurrentFontSize()+1+"px");
    });
    $('#fontSmaller').click(function(){
        $('.container').css('font-size', getCurrentFontSize()-1+"px");
    });


    setInterval( function(){
        if (!paused) {
            setTimer('#mainTimer', ++sec);
            if (slideActive) {
                timedSlide ? secOnSlide-- : secOnSlide++;
                setTimer('#slideTimer', secOnSlide);
                checkToolbarColor();
            }
        }
        var date = new Date();
        $('#timerTime').html(date.toLocaleTimeString() + ' Uhr');
    }, 1000);

    $('#resetTimer').click(function(){
        sec = 0;
        setTimer('#mainTimer', sec);
        if (slideActive) {
            secOnSlide = timedSlide ? slideLimit : 0;
            setTimer('#slideTimer', secOnSlide);
        }
        checkToolbarColor();
    });

    $('#startPauseTimer').click(function(){
        paused = !paused;
        if (paused) {
            $('#startPauseTimer i').removeClass('fa-play');
            $('#startPauseTimer i').addClass('fa-pause');
        } else {
            $('#startPauseTimer i').removeClass('fa-pause');
            $('#startPauseTimer i').addClass('fa-play');
        }
    });


    $('.panel-heading a').click(function(){
        if (!$($(this).attr('href')).hasClass('in')) {
            if ($(this).data('slide-number')) {
                // opening a slide
                $('#slideNav').show();
                current = this;
                $('#slideUp').click(function(){
                    scrollTo($(current).closest('.panel-default').prev('.panel-default').find('.panel-heading a').first());
                });
                $('#slideDown').click(function(){
                    scrollTo($(current).closest('.panel-default').next('.panel-default').find('.panel-heading a').first());
                });
                $('#slideBible').click(function(){
                    scrollTo($(current).closest('.panel-default').find('.rowBible').first());
                });
                $('#slideNotes').click(function(){
                    scrollTo($(current).closest('.panel-default').find('.rowNotes').first());
                });

                checkToolbarColor();
                $('#currentSlideNumber').html('<i class="fa fa-picture-o" aria-hidden="true"></i> ' + $(this).data('slide-number')+ '/' + slideCount);
                secOnSlide = 0;
                timedSlide = false;
                slideActive = true;
                var limit = $(this).data('timelimit');
                if (limit !== '') {
                    secOnSlide = limit;
                    slideLimit = limit;
                    timedSlide = true;
                }
                setTimer('#slideTimer', secOnSlide);
            }

        } else {
            // closing a slide
            $('#slideNav').hide();

            slideActive = false;
            $('#currentSlideNumber').html('');
            $('#slideTimer').html('');
            checkToolbarColor();
        }
    });

});

