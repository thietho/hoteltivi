common = {
    escapeUnicode: function(str) {
        str = str.toLowerCase();
        str = str.replace(/Ã |Ã¡|áº¡|áº£|Ã£|Ã¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ/g, "a");
        str = str.replace(/Ã¨|Ã©|áº¹|áº»|áº½|Ãª|á»�|áº¿|á»‡|á»ƒ|á»…/g, "e");
        str = str.replace(/Ã¬|Ã­|á»‹|á»‰|Ä©/g, "i");
        str = str.replace(/Ã²|Ã³|á»�|á»�|Ãµ|Ã´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»�|á»›|á»£|á»Ÿ|á»¡/g, "o");
        str = str.replace(/Ã¹|Ãº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯/g, "u");
        str = str.replace(/á»³|Ã½|á»µ|á»·|á»¹/g, "y");
        str = str.replace(/Ä‘/g, "d");
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
        /* tÃ¬m vÃ  thay tháº¿ cÃ¡c kÃ­ tá»± Ä‘áº·c biá»‡t trong chuá»—i sang kÃ­ tá»± - */
        str = str.replace(/-+-/g, "-"); //thay tháº¿ 2- thÃ nh 1-
        str = str.replace(/^\-+|\-+$/g, "");
        //cáº¯t bá»� kÃ½ tá»± - á»Ÿ Ä‘áº§u vÃ  cuá»‘i chuá»—i
        return str;
    },

    /*******************************************************************/
    /***************************** VALIDATION **************************/
    validateEmail: function(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    },
    /*******************************************************************/
    /***************************** END VALIDATION **************************/

    showLoading: function() {
        if($('#hloverlay').length==0){
            $('html').append('<div id="hloverlay"></div>');
            $('html').append('<div id="hlloader"></div>');
        }
    },

    endLoading: function() {
        $('#hloverlay').remove();
        $('#hlloader').remove();
    },

    strReplace: function(search, replace, str) {
        return str.replaceAll(search, replace);
    },

    stringtoNumber: function(str) {
        str = ("" + str).replace(/,/g, "");
        var num = str * 1;
        return Number(num);
    },

    formateNumber: function(num) {
        if (num == "")
            return 0;

        num = String(num).replace(/,/g, "");
        num = Number(num);
        ar = ("" + num).split("\.");
        div = ar[0];
        mod = ar[1];
        //console.log(div + '--' + mod);
        arr = new Array();
        block = "";

        for (i = div.length - 1; i >= 0; i--) {

            block = div[i] + block;

            if (block.length == 3) {
                arr.unshift(block);
                block = "";
            }

        }
        arr.unshift(block);

        divnum = arr.join(",");
        divnum = this.trim(divnum, ",")
        divnum = divnum.replace("-,", "-")

        if (mod == undefined) {

            return divnum;
        } else {
            var p = mod.substr(0, 4);
            return divnum + "\." + p;
        }

    },

    formatDouble: function(num, c, d, t) {
        var n = num,
            c = isNaN(c = Math.abs(c)) ? 0 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    },

    currencyFormate: function(num) {
        var n = this.formatDouble(num);
        return currencyprefix + n + currencysubfix;
    },

    isNumber: function(char) {
        if (char != 8 && char != 0 && (char < 45 || char > 57)) {
            //display error message
            //$("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
        } else true
    },

    trim: function(str, chars) {
        return this.ltrim(this.rtrim(str, chars), chars);
    },

    ltrim: function(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
    },

    rtrim: function(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
    },

    loopString: function(str, numloop) {
        var s = '';
        for (var i = 0; i < numloop; i++) {
            s += str;
        }
        return s;
    },

    numberReady: function() {
        $(".number").change(function(e) {
            num = common.formateNumber($(this).val().replace(/,/g, ""));
            $(this).val(num)
        });
        $(".number").keypress(function(e) {
            return common.isNumber(e.which);
        });
        $('.number').focus(function(e) {
            if (this.value == 0)
                this.value = "";
        });
        $('.number').blur(function(e) {
            if (this.value == "")
                this.value = 0;
        });
        $(".number").each(function(index) {
            $(this).val(common.formateNumber($(this).val()));
        });
    },

    toDateNumber: function(num) {
        if (num < 10)
            return "0" + num;
        else
            return num;
    },
    parseToDate: function(str, formate,chr) {
        switch (formate) {
            case 'DMY':
                var arr = str.split(chr);
                return new Date(arr[2] + '-' + arr[1] + '-' + arr[0]);
            case 'MDY':
                var arr = str.split('-');
                return new Date(arr[2] + '-' + arr[0] + '-' + arr[1]);
        }
    },
    dateToMySQL: function(dt) {
        dt = new Date(dt);
        return dt.getFullYear() + '-' + this.toDateNumber(dt.getMonth()+1) + '-' + dt.getDate();
    },
    dateShow: function(dt) {
        dt = new Date(dt);
        if (dt == "Invalid Date") {
            return ''
        } else {
            return this.toDateNumber(dt.getDate()) + "-" + this.toDateNumber(dt.getMonth() + 1) + "-" + dt.getFullYear();
        }
    },
    dateTimeShow: function(dt) {
        dt = new Date(dt);
        if (dt == "Invalid Date") {
            return ''
        } else {
            return this.toDateNumber(dt.getDate()) + "-" + this.toDateNumber(dt.getMonth() + 1) + "-" + dt.getFullYear() +
                ' ' + dt.getHours() + ':' + dt.getMinutes();
        }
    },
    timeShow: function(dt) {
        dt = new Date(dt);
        var time = "";
        if (dt.getHours() < 12) {
            time = dt.getHours() + ":" + this.toDateNumber(dt.getMinutes()) + " am";
        } else {
            if (dt.getHours() == 12)
                time = dt.getHours() + ":" + this.toDateNumber(dt.getMinutes()) + " pm";
            else
                time = time = dt.getHours() - 12 + ":" + this.toDateNumber(dt.getMinutes()) + " pm";
        }

        return time;
    },

    dateView: function(datemysql) {
        var t = datemysql.split(/[- :]/);
        var dt = Date(Number(t[0]), Number(t[1]) - 1, Number(t[2]), Number(t[3]), Number(t[4]), Number(t[5]));
        return this.dateShow(dt)
    },

    timeView: function(time) {
        var t = time.split(':');
        return t[0] + ':' + t[1];
    },

    showFullDate: function(dt) {
        var d = new Date(dt);
        var day = new Array();
        day[0] = "Sunday";
        day[1] = "Monday";
        day[2] = "Tueday";
        day[3] = "Wednesday";
        day[4] = "Thursday";
        day[5] = "Friday";
        day[6] = "Saturday";
        var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";

        return day[d.getDay()] + " " + d.getDate() + " " + month[d.getMonth()] + " " + this.timeShow(d);
    },

    PrintElem: function(elem) {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + document.title + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    },

    PrintHtml: function(html) {
        var mywindow = window.open('', 'PRINT', 'height=500,width=800');

        mywindow.document.write('<html><head><title>' + document.title + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(html);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/
        setTimeout(function() {
            mywindow.print();
            mywindow.close();
        }, 2000)


        return true;
    },
    //File
    getFileName: function(fullPath) {
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            return filename;
        }
    },

    download: function(data, filename, type) {
        var file = new Blob([data], { type: type });
        if (window.navigator.msSaveOrOpenBlob) // IE10+
            window.navigator.msSaveOrOpenBlob(file, filename);
        else { // Others
            var a = document.createElement("a"),
                url = URL.createObjectURL(file);
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            setTimeout(function() {
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }, 0);
        }
    },
    openModal: function(title, content, textOK, textCancel, element, callback) {
        var html = '<div class="modal" id="modalPopup">\n' +
            '    <div class="modal-dialog">\n' +
            '        <div class="modal-content">\n' +
            '            <!-- Modal Header -->\n' +
            '            <div class="modal-header">\n' +
            '                <h4 class="modal-title">' + title + '</h4>\n' +
            '                <button type="button" class="close" data-dismiss="modal">&times;</button>\n' +
            '            </div>\n' +
            '            <!-- Modal body -->\n' +
            '            <div class="modal-body">' + content + '</div>\n' +
            '            <!-- Modal footer -->\n' +
            '            <div class="modal-footer">\n' +
            '                <button type="button" class="btn btn-success" id="btnOk" "><i class="fa fa-check"></i> ' + textOK + '</button>\n' +
            '                <button type="button" class="btn btn-inverse" data-dismiss="modal"><i class="fa fa-close"></i> ' + textCancel + '</button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>';
        $('body').append(html);
        $('#modalPopup').modal();
        $('#btnOk').unbind('click');
        $('#btnOk').click(function() {
            callback(element);
        });
    },
    closeModal: function() {
        $('#modalPopup').modal('hide');
        $('#modalPopup').remove();
    },
    resetProgressBar: function() {
        $('.bar').html('');
        $('.progress .bar').css(
            'width', 0
        );
    },
    decodeBase64Unicode: function(str) {
        return decodeURIComponent(atob(str).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    },
    ward: new Object(),
    processLocation:function (groupeid,wardid){
        common.showLoading();
        $.getJSON(HTTPSERVER+'Location/GetProvinces.api',function(data){
            var str = '<option value="0">Chọn Thành phố/Tỉnh</option>';
            for(var i in data){
                str += '<option value="'+data[i].id+'">'+data[i].core_provinve_fullname+'</option>';
            }
            $('#'+groupeid+' .province').html(str);
            if(wardid!=undefined || wardid != ''){
                $.getJSON(HTTPSERVER+'Location/GetWard.api?wardid='+wardid,function(data){
                    common.ward = data;
                    $('#'+groupeid+' .province').val(common.ward.core_ward_provinceid);
                    $('#'+groupeid+' .province').select2();
                    $('#'+groupeid+' .province').change();
                    common.endLoading();
                })
            }else {
                common.endLoading();
            }

        });
        $('#'+groupeid+' .province').change(function(){
            common.showLoading();
            var provinceid = $(this).val();
            $.getJSON(HTTPSERVER+'Location/GetDistricts.api?provinceid='+provinceid,function(data){
                var str = '<option value="0">Quận/Huyện</option>';
                for(var i in data){
                    str += '<option value="'+data[i].id+'">'+data[i].core_district_fullname+'</option>';
                }
                $('#'+groupeid+' .district').html(str);
                common.endLoading();
                if(common.ward.core_ward_districtid != undefined){
                    $('#'+groupeid+' .district').val(common.ward.core_ward_districtid);
                    $('#'+groupeid+' .district').select2();
                    $('#'+groupeid+' .district').change();
                }
            });
        });
        $('#'+groupeid+' .district').change(function(){
            common.showLoading();
            var districtid = $(this).val();
            $.getJSON(HTTPSERVER+'Location/GetWards.api?districtid='+districtid,function(data){
                var str = '<option value="0">Phường/Xã</option>';
                for(var i in data){
                    str += '<option value="'+data[i].id+'">'+data[i].core_ward_fullname+'</option>';
                }
                $('#'+groupeid+' .ward').html(str);
                common.endLoading();
                if(common.ward.core_ward_districtid != undefined){
                    $('#'+groupeid+' .ward').val(common.ward.id);
                    $('#'+groupeid+' .ward').select2();
                }
            });
        });
        $('#'+groupeid+' .province').select2();
        $('#'+groupeid+' .district').select2();
        $('#'+groupeid+' .ward').select2();
    },
    logout:function (){
        $.confirm({
            title: 'Bạn có muốn đăng xuất không?',
            content: '',
            buttons: {
                goLogout: {
                    text: 'Đăng xuất',
                    btnClass: 'btn-blue',
                    action: function () {
                        common.showLoading();
                        $.getJSON(HTTPSERVER+'Member/Logout.api',function (result){
                            common.endLoading();
                            $.alert({
                                title: 'Đăng xuất thành công!',
                                content: '',
                                onClose: function () {
                                    // before the modal is hidden.
                                    window.location = result.linklogout;
                                },
                            });

                        });
                    }
                },
                goCancel: {
                    text: 'Hủy',
                    btnClass: 'btn-default',
                    action: function () {

                    }
                }
            }
        });

    },
    clearCache:function () {
        $.getJSON(HTTPSERVER+'Member/clearCache.api',function (result) {
            console.log(result);
        });
    }
}
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};
$(document).ready(function() {
    common.numberReady();
});