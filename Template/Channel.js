window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    $('#log').html(event.keyCode);
    if (channel.lockui == false) {
        switch (event.keyCode) {
            case 13:
                var ip = $('[index='+channel.index+']').attr('ip');
                var port = $('[index='+channel.index+']').attr('ip');
                console.log('ip: '+ip);
                console.log('port: '+port);
                channel.playIPChannel(ip, port);
                break;
            case 38: //Move top
                if (channel.index - 1 >= 0) {
                    channel.index -= 1;
                    channel.selectChannel();
                }
                break;
            case 40: //Move down
                if (channel.index < channel.max) {
                    channel.index += 1;
                    channel.selectChannel();
                }
                break;
            case 37: //Move left
                if (channel.index - channel.rows >= 0) {
                    channel.index -= channel.rows;
                    channel.selectChannel();
                }

                break;
            case 39: //Move right
                //$('.slick-next').click();
                channel.index += channel.rows;
                if (channel.index > channel.max) {
                    channel.index = channel.max;
                }
                channel.selectChannel();
                break;
            case 461: //Back
                window.history.back();
                break;
            case 602: //Portal
                window.location = '<?php echo $this->request->createLink()?>';
                break;
        }
    }

}

channel = {
    index: 0,
    iteminfram: 12,
    offset: 0,
    rows: 3,
    minindex: 0,
    maxindex: 12,
    max: $('.item').length - 1,
    lockui: false,
    popupshow: false,
    selectChannel: function () {
        if (this.index > this.maxindex - 1) {
            this.lockui = true;
            $('.slick-next').click();
            this.offset++;
            this.minindex += this.rows;
            this.maxindex += this.rows;
        }
        if (this.index < this.minindex) {
            this.lockui = true;
            $('.slick-prev').click();
            this.offset--;
            this.minindex -= this.rows;
            this.maxindex -= this.rows;
        }
        console.log("index: " + this.index)
        console.log("offset: " + this.offset)
        console.log("minindex: " + this.minindex)
        console.log("maxindex: " + this.maxindex)
        $('.item img').removeClass('channelselect');
        $('[index=' + channel.index + '] img').addClass('channelselect');
    },
    playIPChannel: function (ip, port) {
        var param = {
            "channelType": hcap.channel.ChannelType.IP,
            "ip": ip,
            "port": parseInt(port),
            "ipBroadcastType": hcap.channel.IpBroadcastType.UDP,
            "onSuccess": function () {
                console.log("onSuccess");
            },
            "onFailure": function (f) {
                console.log("onFailure : errorMessage = " + f.errorMessage);
            }
        };
        hcap.channel.requestChangeCurrentChannel(param);
    },
    stopChannel: function () {
        hcap.channel.stopCurrentChannel({
            "onSuccess": function () {
                //log("onSuccess : stopCurrentChannel");
            },
            "onFailure": function (f) {
                //log("onFailure : errorMessage = " + f.errorMessage);
            }
        });
    }
}
$(document).ready(function () {
    // $('.channelitem').click(function () {
    //     var ip = $(this).attr('ip');
    //     var port = $(this).attr('ip');
    //     channel.playIPChannel(ip, port);
    // });
    $('.list-channel-carousel').on('afterChange', function(event, slick, currentSlide){
        channel.lockui = false;
    });
    $('[index=' + channel.index + '] img').addClass('channelselect');
    if(localStorage.getItem('roomid') == null){
        window.location = HTTPSERVER;
    }else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
})