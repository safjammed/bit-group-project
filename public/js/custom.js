$(function(){
    window.setCookie = function (cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = 'expires='+ d.toUTCString();
        document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
    }
    window.getCookie = function(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    $(".to-content input").click(function (e) {
        var val = $(this).attr("type") == "radio"? $(this).val() : $(this).prop("checked");
        var cname = $(this).attr("name");
        console.log($(this).attr("name"), val);
        setCookie(cname,val,365);
    });
    $(".to-content input[type='checkbox']").map(function (key, elm) {
        var cname = $(elm).attr("name");
        var cookieValue = getCookie(cname);
        if (cookieValue == "true" ){
            $("body").addClass(cname);
            $(elm).prop("checked", true);
        }
    });

    //skin
    var skinClass = getCookie("skin");
    var elm = $(".to-content input[value='"+skinClass+"']");
    if (elm.length  == 1){
        if (elm.is("checked")){
            //do nothing
        }else{
            elm.trigger("click");
        }
    }

    if ($("#date-range").length >=1 ){
        $('#date-range').datepicker({
            toggleActive: true,
            format: "yyyy-mm-dd",
        });
    }

    /************************************
     *                                  *
     *            SELECT 2              *
     *                                  *
     * *********************************/
    if ($("[data-plugin='select2'], .select2").length >= 1){
        $("head").prepend('<link rel="stylesheet" href="/vendor/select2/dist/css/select2.min.css">\n');
        $.getScript("/vendor/select2/dist/js/select2.min.js").done(function (resp) {
            $('[data-plugin="select2"], .select2').select2($(this).attr('data-options'));
        })


    }


    /************************************
     *                                  *
     * INTERNATIONAL TELEPHONE INPUT    *
     *                                  *
     * *********************************/


    if ($(".tel-input").length >= 1){
        console.log("telephone input found");
        $("head").append("<link href='/vendor/intl-tel-input/build/css/intlTelInput.min.css' type='text/css' rel='stylesheet'>");
        $.getScript("/vendor/intl-tel-input/build/js/intlTelInput.min.js").done(function (data) {

            $(".tel-input").map(function () {
                var that = $(this);
                var init = intlTelInput(that[0],{
                    initialCountry: "auto",
                    hiddenInput:"phone_withintl",
                    width: "100%",
                    utilsScript: "/vendor/intl-tel-input/build/js/utils.js",
                    geoIpLookup: function(success, failure) {
                        $.get("https://ipinfo.io?token=8a608a1e4cd6b6", function() {}, "jsonp").always(function(resp) {
                            var countryCode = (resp && resp.country) ? resp.country : "";
                            success(countryCode);
                        });
                    },});
                that.on("countrychange", function () {
                    var countryData = init.getSelectedCountryData();
                    var countryCode = "+"+countryData.dialCode;
                    that.closest(".form-group").find('[name="country_code"]').val(countryCode);
                    console.log(that.closest(".form-group").find('[name="country_code"]'), countryCode);
                });


            })
        });
    }


    //confirmation
    if ($(".confirm").length >=1 ){
        window.confirm = function(ths){
            var url = ($(ths).data("url") !== undefined) ? $(ths).data("url") : $(ths).attr('href');
            console.log($(ths).data("url"), url);
            swal.fire({
                title: 'Are you sure?',
                text: "All data of this property will be lost permanently.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                    swal({
                        title: "Please Wait..",
                        timer: 15000,
                        onOpen: () => {
                            swal.showLoading()
                        }
                    });
                } else if (result.dismiss === swal.DismissReason.cancel) {
                }

            })
        }
        if (typeof swal =="undefined"){
            $.getScript("/js/sweetalert2.min.js").done(function () {
                $(document).on("click",".confirm",function (e) {
                    e.preventDefault();
                    confirm(this);
                });
            });
        }else{
            $(document).on("click",".confirm",function (e) {
                e.preventDefault();
                confirm(this);
            });
        }
    }

    $(document).on("click",".add-more", function () {
        console.log("clicked", $(this));

        var template = $(this).parents(".box").find(".template");

        template.find(".select2-hidden-accessible").select2('destroy');
        template.find('[data-select2-id]').removeAttr("data-select2-id");
        var html = template.find(".row")[0].outerHTML;

        template.append(html);
        setTimeout(function () {
            $('.select2').select2();
            template.find('.select2').select2();
        },80)

    });


    $(document).on("change",'[name="area_district[]"]', function () {
        var that  = $(this);
        console.log("district ",that.val());
        $.get("/getGeo",{"district" : that.val()}).done(function (resp) {
            console.log(resp);
            that.closest(".row").find('[name="area_upazila[]"] option').remove();
            $.each(resp, function (i, elm) {
                var opt = new Option(elm.name,elm.id,(i==0)? true : false,(i==0)? true : false);

                that.closest(".row").find('[name="area_upazila[]"]').append(opt);
            });
            that.closest(".row").find('[name="area_upazila[]"]').trigger("change");

            $(document).trigger("change_area_district");
        });
    });
    // $('[name="area_district[]"]').change();

    $(document).on("change",'[name="area_upazila[]"]', function () {
        var that  = $(this);
        console.log("upazila",that.val());
        $.get("/getGeo",{"upazila" : that.val()}).done(function (resp) {
            console.log(resp);
            that.closest(".row").find('[name="area_union[]"] option').remove();
            $.each(resp, function (i, elm) {
                var opt = new Option(elm.name,elm.id,false,false);

                that.closest(".row").find('[name="area_union[]"]').append(opt);
            });
            that.closest(".row").find('[name="area_union[]"]').trigger("change");

            $(document).trigger("change_area_upazila");
        });
    });

    //currency converter
    $(document).on( "change",'.currency-selector', function () {
        var that = $(this);
        $.get("/convert",{
            currency: (that.val()).toUpperCase()
        }).done(function (data) {
            console.log(data);
            that.closest(".row").find(".currency-result").data("value",data);
            that.closest(".row").find(".toBeConverted").change().trigger("keyup");
        })
    });


    function throttle(f, delay){
        var timer = null;
        return function(){
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = window.setTimeout(function(){
                    f.apply(context, args);
                },
                delay || 500);
        };
    }

    var timer, value;
    $(document).on("keyup change", ".toBeConverted", function (e) {
        var that = $(this);
        var str = that.val();
        value = str;
        //perform convertsion
        var display = that.closest(".row").find(".currency-result");
        var current_rate = display.data("value");

        var converted_amount = current_rate * value;
        // console.log(value,converted_amount);
        display.val(converted_amount);


        clearTimeout(timer);

        if (str.length > 0 && value != str) {
            timer = setTimeout(function() {
                value = str;

                //perform convertsion
                var display = that.parents(".row").find(".currency-result");
                var current_rate = display.data("value");

                var converted_amount = current_rate * value;
                console.log(value,converted_amount);
                display.val(converted_amount);

            }, 1000);
        }
    });


    /**DISTRIBUTE EQUALLY*/
    $(document).on("click",".distribute-equally", function (evnt) {
        evnt.preventDefault();
        var that = $(this);
        var displays = that.closest(".box").find(".toBeConverted");
        var budget = $('[name="budget"]').val();

        displays.val(budget/displays.length).trigger("keyup");

    });
    if ($(".animate-number").length >=1 ){
        $.getScript("/js/jquery.animateNumbers.js").done(function () {
            $('.animate-number').each(function(){
                $(this).animateNumbers($(this).attr("data-value"), true, parseInt($(this).attr("data-duration")));
            })
        });
    }

});