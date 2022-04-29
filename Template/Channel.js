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
                            // $('html').hide();
                            // channel.stopMedia(function () {
                            //
                            // });
                            // channel.playIPChannel(ip, port, function () {
                            //
                            // });
                            if(channel.playingvideo){
                                channel.stopMedia(function () {

                                });
                            }

                            channel.playIPChannel(ip, port, function () {
                                $('html').hide();
                            });
                            setTimeout(function () {
                                channel.playIPChannel(ip, port, function () {
                                    $('html').hide();
                                });
                            },1000)
                            // channel.stopChannel(function () {
                            //     channel.stopMedia(function () {
                            //         channel.playIPChannel(ip, port, function () {
                            //             $('html').hide();
                            //         });
                            //     });
                            // });
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
            case 602: //Portal
                channel.stopChannel(function () {
                    channel.stopMedia(function () {
                        channel.playMediaSilent();
                        common.showLoading();
                        $('html').show();
                        window.location = '<?php echo $this->request->createLink()?>';
                    });

                });

                break;
            case 461: //Back
            case 8: //Back
                if (channel.playingchannel) {
                    $('html').show();
                    channel.playing = false
                    // channel.stopMedia(function () {
                    //
                    // });

                    channel.stopChannel(function () {
                        channel.playMediaSilent();
                    });
                } else {
                    common.showLoading();
                    window.history.back();
                }
                break;
            case 1001: //Exit
                $('html').show();
                channel.playing = false
                // channel.stopMedia(function () {
                //
                // });

                channel.stopChannel(function () {
                    channel.playMediaSilent();
                });
                break;
            case 427://Tăng kênh
                if (channel.playingchannel) {
                    if (channel.index < channel.max) {
                        channel.index++;
                        var ip = $('[index=' + channel.index + ']').attr('ip');
                        var port = $('[index=' + channel.index + ']').attr('port');
                        channel.stopChannel(function () {
                            channel.playIPChannel(ip, port, function () {
                            });
                        });

                    }
                }
                break;
            case 428://Giảm kênh
                if (channel.playingchannel) {
                    if (channel.index > 0) {
                        channel.index--;
                        var ip = $('[index=' + channel.index + ']').attr('ip');
                        var port = $('[index=' + channel.index + ']').attr('port');
                        channel.stopChannel(function () {
                            channel.playIPChannel(ip, port, function () {
                            });
                        });
                    }

                }
                break;
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
    //channel.playMediaSilent();
    channel.stopMedia();
    $('[index=' + channel.index + '] img').addClass('channelselect');
    if (localStorage.getItem('roomnumber') == null) {
        window.location = HTTPSERVER;
    } else {
        $('#roomnumber').html(localStorage.getItem('roomnumber'))
    }
})