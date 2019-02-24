$(function(){
    if ($("#date-range").length >=1 ){
        $('#date-range').datepicker({
            toggleActive: true,
            format: "yyyy-mm-dd",
        });
    }
    if ($(".select2").length >=1 ) {
        $('.select2').select2();
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