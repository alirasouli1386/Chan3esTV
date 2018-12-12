var msbrows = 0;
var bookurl = HTTP_ROOT + "/rest/bookEvent";
var calurl = HTTP_ROOT + "/rest/checkCalender";
var movie_id;
var booked_time;
var contentbooked;
var is_episode = 0;
var start_time;
var original_start_time;
var booking_with_cal;
var book_type;
var show_icon = 1;
var show_img_icon = 0;
var timezoneOffset = new Date().getTimezoneOffset();
if (document.documentMode || /Edge/.test(navigator.userAgent)) {
    msbrows = 1;
}
CheckCalender(user_id, calurl);
$(document).ready(function () { 
    $("body").on('click', '.addtocal', function (){
        $(".succs_msg").html("");
        $(".succs_msg").removeAttr("style");
        if (parseInt(user_id) > 0) {
            movie_id       = $(this).attr('data-content_id');
            is_episode     = $(this).attr('data-content_type');
            booked_time    = $(this).attr('data-booking_time');
            book_type      = $(this).attr('data-book_type');
            start_time     = $(this).attr('data-start_time');
            booking_with_cal  = $(this).attr('data-booking_with_cal');
            var show_popup = $(this).attr('data-show_popup');
            if(typeof $(this).attr('data-show_icon') !== typeof undefined){
                show_icon = $(this).attr('data-show_icon');
            }
            if(typeof $(this).attr('data-show_img_icon') !== typeof undefined){
                show_img_icon = $(this).attr('data-show_img_icon');
            }
            if($.trim(book_type) == 1){
                contentbooked = JSLANGUAGE.booked;
            }else{
                contentbooked = JSLANGUAGE.added_to_calender;
            }
            if(($.trim(booking_with_cal) == 1) && ($.trim(booked_time) == "")){
                if (typeof start_time !== typeof undefined && start_time !== false) {
                    booked_time = start_time;
                }
            }
            if (typeof start_time !== typeof undefined && start_time !== false) {
                var d  = new Date(start_time);
                d.setMinutes(d.getMinutes() - timezoneOffset);
                original_start_time = formatDate(d);
            }
            if($.trim(booked_time) !="" && timezoneOffset != "" && timezoneOffset != 0){
                var d  = new Date(booked_time);
                d.setMinutes(d.getMinutes() - timezoneOffset);
                booked_time = formatDate(d);
            }
            $("#booked_date").val(booked_time);
            if(($.trim(booking_with_cal) == 1) && ($.trim(book_type) == 1)){
                $(".flatpickr").flatpickr({
                    enableTime: true,
                    minuteIncrement: 1,
                    time_24hr: true,
                    minDate: "today",
                    maxDate: original_start_time,
                    dateFormat: "Y-m-d H:i:S",
                    defaultDate: [booked_time],
                    static: true,
                    onOpen:function(){
                        $(".succs_msg").html("");
                        $(".succs_msg").removeAttr("style");
                    }
                });
            }else{
                $(".flatpickr").flatpickr({
                    enableTime: true,
                    minuteIncrement: 1,
                    time_24hr: true,
                    minDate: "today",
                    dateFormat: "Y-m-d H:i:S",
                    defaultDate: [booked_time],
                    static: true,
                    onOpen:function(){
                        $(".succs_msg").html("");
                        $(".succs_msg").removeAttr("style");
                    }
                });
            }
            if($.trim(booking_with_cal) == 1){
                $(".calender-modal").modal('show');
                $("#close-event-modal").hide();
                $(".bookevent").show();
                $('#calender-input-form').fadeIn();
                $(".succs_msg").html("");
            }else{
                if (typeof start_time !== typeof undefined && start_time !== false) {
                    var d  = new Date(start_time);
                    d.setMinutes(d.getMinutes() - timezoneOffset);
                    start_time = formatDate(d);
                    $(".succs_msg").html("");
                    $.post(bookurl, {user_id: user_id, movie_id: movie_id, is_episode: is_episode, start_time: start_time, timezone_offset : timezoneOffset, authToken : STORE_AUTH_TOKEN }, function (res) {
                        if (res.status == "Success") {
                            if(typeof show_popup !== typeof undefined){  
                                if(show_popup == 1){
                                    $(".calender-modal").modal('show');
                                }
                            }else{
                                $(".calender-modal").modal('show');
                            }
                            if(show_icon == 1){
                                $('.addtocal[data-content_id="'+movie_id+'"]').html('<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;'+contentbooked);
                            }else if(show_img_icon == 1){ // Only for yay purpose
                                $('.addtocal[data-content_id="'+movie_id+'"]').html('<span class="booked_content_btn"></span>&nbsp;'+contentbooked);
                            }else{
                                $('.addtocal[data-content_id="'+movie_id+'"]').html(contentbooked);
                            }
                            $(".succs_msg").html(res.msg);
                            $('#calender-input-form').fadeOut();
                            $(".bookevent").hide();
                            $("#close-event-modal").show();
                        }
                    });
                } else {
                    $(".calender-modal").modal('show');
                    $("#close-event-modal").hide();
                    $(".bookevent").show();
                    $('#calender-input-form').fadeIn();
                    $(".succs_msg").html("");
                }
            }
        } else {
            $("#loginModal").modal('show');
        }
    });
    $("body").on('click', '.bookevent', function (){
        var start_time = $("#booked_date").val();
        if($.trim(start_time)){
            $.post(bookurl, {user_id: user_id, movie_id: movie_id, is_episode: is_episode, start_time: start_time, timezone_offset : timezoneOffset, authToken : STORE_AUTH_TOKEN}, function (res) {
                if (res.status == "Success") {
                    if(show_icon == 1){
                        $('.addtocal[data-content_id="'+movie_id+'"]').html('<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;'+contentbooked);
                    }else if(show_img_icon == 1){ // Only for yay purpose
                        $('.addtocal[data-content_id="'+movie_id+'"]').html('<span class="booked_content_btn"></span>&nbsp;'+contentbooked);
                    }
                    var d  = new Date(start_time);
                    d.setMinutes(d.getMinutes() + timezoneOffset);
                    start_time = formatDate(d);
                    $('.addtocal[data-content_id="'+movie_id+'"]').attr('data-booking_time', start_time); 
                    $(".succs_msg").html(res.msg);
                    $('#calender-input-form').fadeOut();
                    $(".bookevent").hide();
                    $("#close-event-modal").show();
                }else{
                    $(".succs_msg").css({"margin-bottom": "10px", "color": "red"});
                    $(".succs_msg").html(res.msg);
                }
            });
        }else{
            $(".succs_msg").css({"margin-bottom": "10px", "color": "red"});
            $(".succs_msg").html(JSLANGUAGE.booking_time_required);
        }
    });
    setInterval(function () {
        CheckCalender(user_id, calurl);
    }, 60000);
});
function CheckCalender(user_id, calurl) {
    if(parseInt(enable_user_notification) == 1){
        if(msbrows){
            calenderCheck();
        }else{
            if(notification > 0){
                if (Notification.permission !== "granted")
                {   
                    Notification.requestPermission();
                } else if (user_id > 0) {
                    calenderCheck();
                }
            } 
        }
    }
}
var permalinkAry = new Array();
function calenderCheck(){
    var reminder_msg = "Starting Now";
    $.post(calurl, {user_id: user_id, authToken : STORE_AUTH_TOKEN}, function (res) {
        if (res.code == 200) {
            if (res.movielist.length > 0) {
                count = res.movielist.length;
                reminder_msg = res.reminder_message;
                var notfiInt = setInterval(function () {
                    count--;
                    notifyBrowser(res.movielist, count, reminder_msg);
                    if (count == 0) {
                        clearInterval(notfiInt);
                    }
                }, 1000);
            }
        }
    });
}
function notifyBrowser(movielist, count, reminder_msg) {
    if(msbrows){
        ///var domString = <div class="notification-wrap"></div>
    }else{
         if (!Notification) {
            console.log('Desktop notifications not available in your browser..');
            return;
        }
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        }
        else {
            permalinkAry[count] = HTTP_ROOT + "/" + Player_Page + "/" + movielist[count].permalink;
            var notification = new Notification(movielist[count].name, {
                icon: favicon,
                body: reminder_msg,
            });
            notification.onclick = function () {
                window.open(permalinkAry[count]);
            };
            notification.onclose = function () {
                console.log('Notification closed');
            };
        }   
    }
}
function formatDate(date) {
    var d     = new Date(date);
    var month = addZero(d.getMonth() + 1);
    var day   = addZero(d.getDate());
    var year  = d.getFullYear();
    var h     = addZero(d.getHours());
    var m     = addZero(d.getMinutes());
    var s     = addZero(d.getSeconds());
    var datetime = year+"-"+month+"-"+day+" "+h+":"+m+":"+s;
    return datetime;
}
function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}