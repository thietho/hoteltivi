window.addEventListener("keyup", myEventHandler);

function myEventHandler(event) {
    //console.log(event);
    if (channel.lockui == false) {
        switch (event.keyCode) {
            case 13:
                if (channel.index < 0) {
                    common.showLoading();
                    window.location = $('.groupchannelselect').attr('href');
                } else {
                    var ip = $('[index=' + channel.index + ']').attr('ip');
                    var port = $('[index=' + channel.index + ']').attr('port');
                    console.log('index: ' + channel.index);
                    console.log('ip: ' + ip);
                    console.log('port: ' + port);

                    if (Number(localStorage.getItem('istivi'))) {
                        if (port == 1) {
                            channel.playMedia(ip);
                        } else {
                            channel.stopMedia(function () {
                                channel.playIPChannel(ip, port, function () {
                                    channel.playing = true;
                                });
                            });
                        }
                    }
                }

                break;
            case 38: //Move top
                if (channel.index < 0) {
                    if (channel.groupindex > 0) {
                        $('.list-group-channel').removeClass('groupchannelselect');
                        $($('.list-group-channel')[--channel.groupindex]).addClass('groupchannelselect');
                    }
                } else {
                    if (channel.index - 1 >= 0) {
                        channel.index -= 1;
                        channel.selectChannel();
                    }
                }

                break;
            case 40: //Move down
                if (channel.index < 0) {
                    if (channel.groupindex < $('.list-group-channel').length - 1) {
                        $('.list-group-channel').removeClass('groupchannelselect');
                        $($('.list-group-channel')[++channel.groupindex]).addClass('groupchannelselect');
                    }
                } else {
                    if (channel.index < channel.max) {
                        channel.index += 1;
                        channel.selectChannel();
                    }
                }
                break;
            case 37: //Move left
                if (channel.index - channel.rows >= 0) {
                    channel.index -= channel.rows;
                    channel.selectChannel();
                } else {
                    channel.index = -3;
                    $('.main-content .item img').removeClass('channelselect');
                    $($('.list-group-channel')[channel.groupindex]).addClass('groupchannelselect');
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
            case 8: //Back
                if (channel.playing) {
                    channel.playing = false
                    channel.stopMedia(function () {
                        channel.stopChannel(function () {
                            channel.playMediaSilent();
                            $('html').show();
                        });
                    });
                } else {
                    common.showLoading();
                    window.history.back();
                }
                break;
            case 602: //Portal
                channel.stopChannel(function () {
                    channel.stopMedia(function () {
                        channel.playMediaSilent();
                        common.showLoading();
                        window.location = '<?php echo $this->request->createLink()?>';
                    });

                });

                break;
            case 1001: //Exit
                channel.playing = false
                channel.stopMedia(function () {
                    channel.stopChannel(function () {
                        channel.playMediaSilent();
                        $('html').show();
                    });
                });
                break;
            case 427://Tăng kênh
                if (channel.playing) {
                    if (channel.index < channel.max) {
                        channel.index++;
                        var ip = $('[index=' + channel.index + ']').attr('ip');
                        var port = $('[index=' + channel.index + ']').attr('port');
                        channel.playIPChannel(ip, port, function () {

                        });
                    }
                }
                break;
            case 428://Giảm kênh
                if (channel.playing) {
                    if (channel.index > 0) {
                        channel.index--;
                        var ip = $('[index=' + channel.index + ']').attr('ip');
                        var port = $('[index=' + channel.index + ']').attr('port');
                        channel.playIPChannel(ip, port, function () {

                        });
                    }

                }
                break;
        }
    }

}

channel = {
    index: 0,
    groupindex: $('.groupchannelselect').index(),
    iteminfram: 12,
    offset: 0,
    rows: 3,
    minindex: 0,
    maxindex: 12,
    max: $('.item').length - 1,
    lockui: false,
    popupshow: false,
    playing: false,
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
        $('.main-content .item img').removeClass('channelselect');
        $('.main-content [index=' + channel.index + '] img').addClass('channelselect');
        //$('.sub-menu-title').html(channel.index);
    },
    playIPChannel: function (ip, port, callcack) {
        $('html').hide();
        $('.sub-menu-title').html(ip);
        this.stopChannel(function () {
            var param = {
                "channelType": hcap.channel.ChannelType.IP,
                "ip": ip,
                "port": parseInt(port),
                "ipBroadcastType": hcap.channel.IpBroadcastType.UDP,
                "onSuccess": function () {
                    console.log("onSuccess");
                    callcack();
                },
                "onFailure": function (f) {
                    console.log("onFailure : errorMessage = " + f.errorMessage);
                }
            };
            hcap.channel.requestChangeCurrentChannel(param);
        });

    },
    stopChannel: function (callback) {
        $('body').show();
        hcap.channel.stopCurrentChannel({
            "onSuccess": function () {
                //log("onSuccess : stopCurrentChannel");
                callback();
            },
            "onFailure": function (f) {
                //log("onFailure : errorMessage = " + f.errorMessage);
                callback();
            }
        });


    },
    media: null,
    playMedia: function (srcVideo) {
        $('body').hide();
        alert(srcVideo);
        console.log(srcVideo);
        hcap.Media.startUp({
            "onSuccess": function () {
                //log("onSuccess : startUp");
                channel.media = hcap.Media.createMedia({
                    "url": srcVideo,
                    "mimeType": "video/mp4"
                });
                alert(JSON.stringify({
                    "url": srcVideo,
                    "mimeType": "video/mp4"
                }));
                //log("Media.createMedia = " + channel.media);
                channel.media.play({
                    "repeatCount": 0,
                    "onSuccess": function () {
                        //  log("onSuccess : playVOD -> " + srcVideo);
                        channel.playing = true;
                    },
                    "onFailure": function (f) {
                        //  log("onFailure : errorMessage = " + f.errorMessage);
                    }
                });
            },
            "onFailure": function (f) {
                //  log("onFailure : errorMessage = " + f.errorMessage);
            }
        });
    },
    playMediaSilent: function () {
        var srcVideo = HTTPSERVER + 'img/keepsilent.mp4';
        hcap.Media.startUp({
            "onSuccess": function () {
                //log("onSuccess : startUp");
                channel.media = hcap.Media.createMedia({
                    "url": srcVideo,
                    "mimeType": "video/mp4"
                });

                channel.media.play({
                    "repeatCount": 0,
                    "onSuccess": function () {
                        //  log("onSuccess : playVOD -> " + srcVideo);
                        //channel.playing = true;
                    },
                    "onFailure": function (f) {
                        //  log("onFailure : errorMessage = " + f.errorMessage);
                    }
                });
            },
            "onFailure": function (f) {
                //  log("onFailure : errorMessage = " + f.errorMessage);
            }
        });
    },
    stopMedia: function (callback) {
        if (channel.media != null) {
            channel.media.stop({
                "onSuccess": function () {
                    console.log("onSuccess");
                    channel.media.destroy({
                        "onSuccess": function () {
                            console.log("onSuccess");
                            hcap.Media.shutDown({
                                "onSuccess": function () {
                                    console.log("onSuccess");
                                    //channel.playing = false;
                                    callback();
                                },
                                "onFailure": function (f) {
                                    console.log("onFailure : errorMessage = " + f.errorMessage);
                                    callback();
                                }
                            });
                        },
                        "onFailure": function (f) {
                            callback();
                            console.log("onFailure : errorMessage = " + f.errorMessage);
                        }
                    });
                },
                "onFailure": function (f) {
                    callback();
                    console.log("onFailure : errorMessage = " + f.errorMessage);
                }
            });
        } else {
            callback();
            console.log("[dawn7dew] channel.media is null");
        }
    }
}
$(document).ready(function () {
    // $('.channelitem').click(function () {
    //     var ip = $(this).attr('ip');
    //     var port = $(this).attr('ip');
    //     channel.playIPChannel(ip, port);
    // });
    $('.list-channel-carousel').on('afterChange', function (event, slick, currentSlide) {
        channel.lockui = false;
    });
    channel.playMediaSilent();
    $('[index=' + channel.index + '] img').addClass('channelselect');
    if (localStorage.getItem('roomnumber') == null) {
        window.location = HTTPSERVER;
    } else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
})