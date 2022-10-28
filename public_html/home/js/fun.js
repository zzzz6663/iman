var path='/chapapp/'
function escapeHtml(text) {
    if (text.length>0){
        return text.trim()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }else {
        return ' ';
    }

}
function readURL(input) {
    for(var i =0; i< input.files.length; i++){
        if (input.files[i]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = $('<img id="dynamic">');
                img.attr('src', e.target.result);
                img.appendTo('#conte');
            }
            reader.readAsDataURL(input.files[i]);
        }
    }
}
function check_perisan(str) {
    // var PersianOrASCII = / |[آ-ی]|([a-zA-Z])/;
    // if ((m = s.match(PersianOrASCII)) !== null) {
    //     if (m[1]) {
    //         return false;
    //     }
    //     else { return true; }
    // }
    // else { return true; }
    var p = /^[\u0600-\u06FF\s]+$/;

    if (p.test(str)){
        return true;
    }
    return false
}

var Fetch = function countUpFromTime(countFrom, id) {
    // countFrom = new Date(countFrom).getTime();
    var now = new Date();
    window['value'+id]  = new Date(countFrom);
    timeDifference = (now -  window['value'+id] );

    var secondsInADay = 60 * 60 * 1000 * 24,
        secondsInAHour = 60 * 60 * 1000;

    days = Math.floor(timeDifference / (secondsInADay) * 1);
    years = Math.floor(days / 365);
    if (years > 1){ days = days - (years * 365) }
    hours = Math.floor((timeDifference % (secondsInADay)) / (secondsInAHour) * 1);
    mins = Math.floor(((timeDifference % (secondsInADay)) % (secondsInAHour)) / (60 * 1000) * 1);
    secs = Math.floor((((timeDifference % (secondsInADay)) % (secondsInAHour)) % (60 * 1000)) / 1000 * 1);

    var idEl = document.getElementById(id);
    // idEl.getElementsByClassName('years')[0].innerHTML = years;
    idEl.getElementsByClassName('days')[0].innerHTML = days;
    idEl.getElementsByClassName('hours')[0].innerHTML = hours;
    idEl.getElementsByClassName('minutes')[0].innerHTML = mins;
    idEl.getElementsByClassName('seconds')[0].innerHTML = secs;

    clearTimeout(countUpFromTime.interval);
    countUpFromTime.interval = setTimeout(function(){ countUpFromTime( window['value'+id] , id);
        console.log('id'+id)
    }, 1000);
}

function pure_mony(text) {
    if (text.length>0){
        return text.trim()
            .replace(/,/g, "")
            .replace('تومان', "")
            .replace(' ', "")

    }else {
        return '';
    }

}
function escapechar(text) {
    if (text.length>0){
        return text.trim()
            .replace(/&/g, "")
            .replace(/</g, "")
            .replace(/>/g, "")
            .replace(/"/g, "")
            .replace(/'/g, "");
    }else {
        return ' ';
    }

}

function note_success(str ,element ){

    $('body').overhang({
        type: "success",
        message: str
    });

}
function note_error(str,element){
    $('body').overhang({
        type: "error",
        message: str,
        closeConfirm: false
    });
}

function note_success2(str ,element ){
    $.notify(
        str,
        { position:"top center" ,
            className: 'success',
        }
    );
}
function note_error2(str){
    $.notify(
        str,
        { position:"top center" ,
            className: 'error',
        }
    );
}
function change_location(){
    alert(123)
}
function load_animation(){
    $('body').loadingModal({
        position:'auto',
        text:'لطفا صبر نمایید .....',
        color:'#fff',
        opacity:'0.7',
        backgroundColor:'rgb(۲۵,۱۰۹,۱۸۰)',
        animation:'cubeGrid'
    });
}
function stop_animation(){
    $('body').loadingModal('destroy');
}
function  get_select_val(name ){
    return $('select[name='+name+']').find(":selected").val();
}
function valid_form(form,url,reset=true ,show=true) {
    var new_form=form
    var ss=form+' *';
    var form=$('#'+form);
    console.log(form)
    form.validate();

    if(!form.valid()){
        $('#'+ss).filter(':input[required]:visible').each(function(){
            var element=$(this);

            // console.log('class id'+element.attr('class'))
            // console.log('element id'+element.attr('id'))
            if (!element.valid()) {
                console.log('name:  '+element.prop("name"))
                $([document.documentElement, document.body]).animate({
                    scrollTop: (element.offset().top-50)
                }, 500);
                var data=element.data('valid')
                console.log(data)
                noty(data)
                // var label = $("label[for='" + element.attr('id') + "']");
                // element.removeClass('animated bounce');
                // label.removeClass('animated bounce');
                // var par=  element.closest('.input-container')
                // par.removeClass('animated bounce');
                // var color=par.css("border-color")
                // element.css('border', '1px solid red');
                // if (show){
                //     note_error('تمام فیلد ها را به درستی وارد کنید  ',par)
                //
                // }
                // setTimeout(function(){par.addClass('animated bounce');label.addClass('animated bounce');}, 1000);
                // setTimeout(function(){   }, 3000);
                return  false
            }
        });
        return false
    }
    // else {
    //     var str = form.serializeArray();
    //     var d_form= new_form+ ' input[type=checkbox]:not(:checked)'
    //     str = str.concat(
    //         jQuery('#'+d_form).map(
    //             function() {
    //                 return {"name": this.name, "value": false}
    //             }).get()
    //     );
    //     console.log(str)
    //
    //     var jqXHR=  $.ajax(path+url,{
    //         type:'post',
    //         data: str,
    //         async:false,
    //         success:function (data) {
    //             if (reset){
    //                 form.each(function(){
    //                     this.reset();
    //                 });
    //             }
    //         },
    //         error: function (request, status, error) {
    //         }
    //     });
    // }
    // return jqXHR.responseText;
}
function startTimer(duration, display) {

    return 4;
}
function downloadURI(uri, name) {
    var link = document.createElement("a");

    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    link='';

}
function noty(message,color='red',title='اخطار',position='topCenter',timeout=5000){
    console.log('errrrrr')
    iziToast.show({
        title: title,
        color: color,
        position:position,
        animateInside:true,
        rtl: true,
        message:  message,
        titleSize: '25px',
        messageSize: '20px',
        timeout: timeout,
    });
}
function  get_radio_val(name ){
    return $('input[name='+name+']:checked').val();
}
function  push_input_coookies(input_name ,name ){
    var val = $('input[name ='+input_name+']').val();
    Cookies.set(name,  val);
}
function  get_cookies_by_name( name ){
    return Cookies.get(name)
}
function lara_str_ajax(url,str){
    $('body').LoadingOverlay("show"  )
    console.log(str)
    var jqXHR=   $.ajax(url,{
        type:'post',
        data: JSON.stringify(str),
        headers:{
            'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content,
            'Content-Type':'application/json,charset=utf-8'
        },
        datatype:'json',
        async:false,
        cache:false,
        contentType: false,
        processData: false,
        success:function (data) {
            $("body").LoadingOverlay("hide");
        },
        error: function (request, status, error) {
            $("body").LoadingOverlay("hide");
        }
    });
    var res=  JSON.parse(jqXHR.responseText)
    var all = Object.keys(res);
    console.log(all)
    if (all[0]=='message'){
        noty(   res.errors[Object.keys(res.errors)[0]],'red','اخطار   ')
    }
    // console.log(JSON.parse(jqXHR.responseText))
    return  res

}
function lara_ajax(url,str ,message='',menu='',show=true){
    // console.log( JSON.stringify(str) )
    // $.ajaxSetup({
    //     'headers':{
    //        'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content
    //     }
    // })
    $('body').LoadingOverlay("show"  )

    var jqXHR=   $.ajax(url,{
        type:'post',
        data:  str,
        headers:{
            'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content,
            // 'Content-Type':'application/json,charset=utf-8'
        },

        datatype:'json',
        async:false,
        cache:false,
        contentType: false,
        processData: false,

        success:function (data) {
            $("body").LoadingOverlay("hide");
        },
        error: function (request, status, error) {
            $("body").LoadingOverlay("hide");

        }
    });

    //         var jqXHR=   $.ajax({
    //             xhr: function() {
    //                 var xhr = new window.XMLHttpRequest();
    //
    //                 xhr.upload.addEventListener("progress", function(evt) {
    //                     if (evt.lengthComputable) {
    //                         var percentComplete = evt.loaded / evt.total;
    //                         percentComplete = parseInt(percentComplete * 100);
    //                         console.log('percentComplete'+percentComplete);
    //
    //                         if (percentComplete === 100) {
    //
    //                         }
    //
    //                     }
    //                 }, false);
    //
    //                 return xhr;
    //             },
    //             url:url,
    //         type:'post',
    //         data:  str,
    //         headers:{
    //             'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content,
    //             // 'Content-Type':'application/json,charset=utf-8'
    //         },
    //
    //         datatype:'json',
    //         async:false,
    //         cache:false,
    //         contentType: false,
    //         processData: false,
    //
    //         success:function (data) {
    //         },
    //         error: function (request, status, error) {
    //         }
    //     });

    console.log(JSON.parse(jqXHR.responseText))






    var res= JSON.parse(jqXHR.responseText)

    var all = Object.keys(res);






    if ($('#admin').length && menu.length>0){
        change_dash(menu)
    }
    if (show){
        if (all[0]=='status'){
            $(this).trigger("reset");
            noty( message   ,'green','  ثبت   ')


        }

    }


    try {

        if (all[0]=='message'){
            noty(   res.errors[Object.keys(res.errors)[0]],'red','اخطار   ')
        }

    }catch (e) {

    }




    $("body").LoadingOverlay("hide");
    return res ;

}
function json_form(form) {
    //serialize data function
    var formArray = form.serializeArray();
    var returnArray = {};
    var str = new FormData();
    for (var i = 0; i < formArray.length; i++){
        str.append( formArray[i]['name'], formArray[i]['value']);

    }
    return str;
}
function  simple_ajax(url,str='' ){

    var jqXHR=   $.ajax(path+url,{
        data: str,
        type:'post',
        async:false,
        success:function (data) {
            stop_animation()
        },
        error: function (request, status, error) {
            stop_animation()
        }
    });
    return jqXHR.responseText;
}
function  simple_json_ajax(url,str='' ){

    var jqXHR=   $.ajax(path+url,{
        data: str,
        type:'post',
        dataType:'json',
        async: false,
        success:function (data) {
            stop_animation()
            // console.log('res'+data.htm)
        },
        error: function (request, status, error) {
            console.log('request'+request)
            console.log('status'+status)
            console.log('error'+error)
            stop_animation()
            note_error('خطایی پیش امده لطفا مجدد سعی کنید')
        }
    });
    return JSON.parse(jqXHR.responseText);
}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}
function copyToClipboard2(txt) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(txt).select();
    document.execCommand("copy");
    $temp.remove();
}
function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
