/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Back button on player 
 */
$(document).ready(function(){
    videojs("stream_player").ready(function(){
       var myplayer = this;
       $(".vjs-big-play-button").show();
       myplayer.on("play", function(){
          $('.player-text-div').hide(); 
       });
       $('.videocontent').mouseover(function() {
            $('#backButton').show();
       });
       // BACK BUTTON OF VIDEO PLAYER DOESN'T HIDE IN FULLSCREEN MODE.
       var player = myplayer;
       setInterval(function() {
          var user_active = player.userActive();
          if(user_active === true){ 
              $('#backButton').show();
          } else {
              $('#backButton').hide();
          }
       }, 1000);
        if ( window.self === window.top ) {
          $('#stream_player').append('<img src="img/back-button.png" id="backButton" class="backButton" data-toggle="tooltip" title="Back to Browse" allowFullScreen = true/>');
        }       
        $('#backButton').click(function(){
             if($('#backbtnlink').val() !=''){
                 window.location.href = $('#backbtnlink').val(); 
             } else {
                 parent.history.back();
                    return false;
             }
        });
        $('#backButton').bind('touchstart', function(){
             if($('#backbtnlink').val() !=''){
                 window.location.href = $('#backbtnlink').val();
                    return false; 
             } else {
                 parent.history.back();
                    return false; 
             }
        });
        myplayer.on('error', function () {
            if($('.vjs-modal-dialog-content').html()!==''){
                $(".vjs-modal-dialog-content").html("<div>"+no_compatible_source+"</div>");
            } else {
            if(document.getElementsByTagName("video")[0].error != null){
                var videoErrorCode = document.getElementsByTagName("video")[0].error.code;
                if (videoErrorCode === 2) {
                    $(".vjs-error-display").html("<div>"+a_network_error_caused+"</div>");
                } else if (videoErrorCode === 3) {
                    $(".vjs-error-display").html("<div>"+the_video_playback_was_aborted+"</div>");
                } else if (videoErrorCode === 1) {
                     $(".vjs-error-display").html("<div>"+you_aborted_the_video_playback+"</div>");
                } else if (videoErrorCode === 4) {
                      $(".vjs-error-display").html("<div>"+the_video_could_not_be_loaded+"</div>");
                } else if (videoErrorCode === 5) {
                    $(".vjs-error-display").html("<div>"+the_video_is_encrypted+"</div>");
                }
            }
        }
    });
});
});
			

