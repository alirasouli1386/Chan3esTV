console.log('watermark: Start');

(function() {
    console.log('watermark: Init defaults');
    var defaults = {
            file: 'Owned_Stamp.png',
            xpos: 0,
            ypos: 0,
            xrepeat: 0,
            opacity: 100,
        },
        extend = function() {
            var args, target, i, object, property;
            args = Array.prototype.slice.call(arguments);
            target = args.shift() || {};
            for (i in args) {
                object = args[i];
                for (property in object) {
                    if (object.hasOwnProperty(property)) {
                        if (typeof object[property] === 'object') {
                            target[property] = extend(target[property], object[property]);
                        } else {
                            target[property] = object[property];
                        }
                    }
                }
            }
            return target;
        };

    /**
     * register the thubmnails plugin
     */
    videojs.plugin('watermark', function(options) {
        console.log('watermark: Register init');

        var settings, video, div, img;
        settings = extend(defaults, options);

        /* Grab the necessary DOM elements */
        video = this.el();

        // create the watermark element
        div = document.createElement('div');
        img = document.createElement('img');
        div.appendChild(img);
        img.className = 'vjs-watermark';
        img.src = options.file;
        //img.style.bottom = "0";
        //img.style.right = "0";
        if ((options.ypos == 0) && (options.xpos == 0)) // Top left
        {
            img.style.top = "0";
            img.style.left = "0";
        } else if ((options.ypos == 0) && (options.xpos == 100)) // Top right
        {
            img.style.top = "0";
            img.style.right = "0";
        } else if ((options.ypos == 100) && (options.xpos == 100)) // Bottom right
        {
            img.style.bottom = "0";
            img.style.right = "0";
        } else if ((options.ypos == 100) && (options.xpos == 0)) // Bottom left
        {
            img.style.bottom = "0";
            img.style.left = "0";
        } else if ((options.ypos == 50) && (options.xpos == 50)) // Center
        {
            img.style.top = (this.height() / 2) + "px";
            img.style.left = (this.width() / 2) + "px";
        } else {
            img.style.top = options.ypos + "%";
            img.style.left = options.xpos + "%";
        }
        //img.style.height = "55px";
        img.style.width = "95px";
        //img.style.cursor = "pointer";
        div.style.opacity = options.opacity;

        //div.style.backgroundImage = "url("+options.file+")";
        //div.style.backgroundPosition.x = options.xpos+"%";
        //div.style.backgroundPosition.y = options.ypos+"%";
        //div.style.backgroundRepeat = options.xrepeat;
        //div.style.opacity = (options.opacity/100);

        // add the watermark to the player
        video.appendChild(div);

        //video.oncontextmenu = function(){alert("Hello!");}
        console.log('watermark: Register end');
    });
})();
var currentDate = new Date();
var getTimestamp = currentDate.getTime(); 
var checkIfValueIsSetForWaterMark = '';
if (typeof muviWaterMark !== 'undefined' && muviWaterMark !== "") {
    var checkIfValueIsSetForWaterMark = muviWaterMark
}
if (typeof muviWaterMarkTrailer !== 'undefined' && muviWaterMarkTrailer !== "") {
    var checkIfValueIsSetForWaterMark = muviWaterMarkTrailer
}
if (checkIfValueIsSetForWaterMark !== '') {
    checkIfValueIsSetForWaterMark = checkIfValueIsSetForWaterMark.replace(/%20/g, ' ');
    var setWaterMark = '';
    /*var myarray = checkIfValueIsSetForWaterMark.split(':');
    for (var i = 0; i < myarray.length; i++) {
        if (i === 0) {
            setWaterMark += myarray[i]
        } else {
            setWaterMark += '<br>' + myarray[i]
        }
    }*/
    var setWaterMark = checkIfValueIsSetForWaterMark.replace(/:/g, "<br>");    
    window.setInterval(function() {
        currentDate = new Date();
        getTimestamp = currentDate.getTime();        
        showNextQuote();
    }, 5000);
    window.setInterval(function() {
        currentDate = new Date();
        getTimestamp = currentDate.getTime();
        checkQuoteDiv();
    }, 1000);

    function checkQuoteDiv() {          
        if($("div[id^='quotes']").length==0){
            showNextQuote();
        } else {
            var quotesVal = $("div[id^='quotes']").html();
            if (quotesVal !=setWaterMark) {
                showNextQuote();
            }
        }
    }   
    function showNextQuote() {         
        if($("div[id^='quotes']").length==0){           
            if (typeof muviWaterMarkTrailer !== 'undefined' && muviWaterMarkTrailer !== "") {
                $("#video_block").append('<div id="quotes'+getTimestamp+'"></div>');
            }else {
                $("#video_block").append('<div id="quotes'+getTimestamp+'"></div>');
            }
        }else{
            $("div[id^='quotes']").removeAttr();            
            $("div[id^='quotes']").attr("id","quotes"+getTimestamp)
        }              
        if (document.getElementById("video_block") !== null) {
            var videoJsHeight = document.getElementById('video_block').offsetHeight - 40;
            var myNewarray = setWaterMark.split('<br>');
            for (var i = 0; i < myNewarray.length; i++) {
                videoJsHeight = videoJsHeight - 20
            }
            var height_off = $("#video_block").offset().top;
            var maxheight = videoJsHeight+height_off;
            var videoJsHeight = Math.floor(Math.random()*(maxheight-height_off+1)+height_off);
			
            var videoJsWidth = document.getElementById('video_block').offsetWidth - $("div[id^='quotes']").outerWidth();            
            if (videoJsWidth === 0) {
                var videoJsWidth = document.getElementById('video_block').offsetWidth - 20
            }
            var width_off = $("#video_block").offset().left;
            var maxwidth = (videoJsWidth + width_off);
            var minwidth = width_off + 20;
            var videoJsWidth = Math.floor(Math.random() * (maxwidth-minwidth+1)+minwidth);
			
            var quotes = $("div[id^='quotes']");
            quotes.html(setWaterMark).attr("style", "top:" + videoJsHeight + "px; right:" + videoJsWidth + "px; font-size: 14px !Important; color: #b3cbcb !Important; visibility:visible !important; display:block !important; -webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; z-index:9999999999 !important; position: fixed !important; border:none !Important; font-family: \"Times New Roman\", Times, serif;  font-style: normal !Important; font-weight: bold !Important;opacity:1 !important;");                        
        }
    }       
}
//remove external [stylish] extension changes 
(function() {
    setInterval(function() {
        (function() {
            if($("style").hasClass("stylish")) {
                console.log("y");
                $("style[id^='stylish']").remove();
            } else {
                console.log("n");
            }
        })();
    }, 1000);
}());