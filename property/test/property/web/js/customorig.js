// JavaScript Document
$(function () {
    $(document).on('click', 'a[data-page]', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var pageno = $(this).attr("data-page");

        $("#pageno").val(pageno);
        $("#sort").val($(this).attr("data-sort"));

        $.ajax({
            type: "GET",
            url: $("#frmsearch").attr("action"),
            data: $("#frmsearch").serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //alert(data);
                $(".main-content-inner").html(data);

                $(".developer").hide();
                if (data != "") {
                    //    $(".main-content-inner").html(data);
                }
            }
        });
        /*        $.ajax({url: $(this).attr("href"), success: function (result) {
         //$("#booking_list tbody").append(result);
         //alert(result);
         if (result[0] === "saved")
         {
         $(".main-content-inner").fadeOut().load(result[1], function () {
         $(".main-content-inner").fadeIn();
         });
         }
         }});
         */

        return false;
    });

    $(document).on('click', '.reportlink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var str = $("#frmsearch").serialize();

        if (str.indexOf("r=") == 0)
        {
            var skip = str.indexOf("%2F&");
            str = str.substring(skip + 3, str.length);
        }

        window.open($(this).attr("href") + str);
    });

    $(document).on('click', '.tab-pane-reports', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var pageno = $(this).attr("data-report");
        $("#page").val(pageno);
        //alert(pageno);

        $.ajax({
            type: "GET",
            url: $("#frmsearch").attr("action"),
            data: $("#frmsearch").serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //alert(data);
                $(".main-content-inner").html(data);
                $(".developer").hide();
                if (data != "") {
                    //    $(".main-content-inner").html(data);
                }
            }
        });

        return false;
    });

    $(document).on('click', '.tab-pane-content', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var page = $(this).attr("data-url");

        var target = ".main-content-inner";

        if ($(this).attr('data-targetdiv') != null) {
            target = "#" + $(this).attr('data-targetdiv');
        }

        if (target == ".main-content-inner") {
            history.pushState({key: 'value'}, 'title', page);
        }

        $(target).fadeOut().load(page, function () {
            if ($("input[autofocus]").length)
                $("input[autofocus]").focus();

            $(target).fadeIn();
            $(".developer").hide();
            $(".dynamic_row_content").hide();

            //configuresubpagecontent();

            if ($("#comment_box_data_url").length === 1) {
                loadcommentbox();
            }

            if ($('.lazycontent').length)
                lazyloading();

            if ($('.subpage_wizard').length)
                configurewizard();

            if ($("#search_nav_link").length === 1)
            {
//					alert($("#search_nav_link").val());
                $("#search_nav").fadeOut().load($("#search_nav_link").val(), function () {
                    $("#search_nav").fadeIn();

                    $("#pageno").val($("#tpageno").val());
                    $("#pagesize").val($("#tpagesize").val());
                    $("#sort").val($("#tsort").val());

                    $('.date-picker').datepicker(
                            {
                                format: 'dd-mm-yyyy',
                                forceParse: false
                            }
                    );
                    //				alert($("#search_nav").html());
                });
            } else
            {
                $("#search_nav").html("");
            }

        });

        return false;
    });

    $(document).on('click', '.dynamiclink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $.ajax({url: $(this).attr("href"), success: function (result) {
                //$("#booking_list tbody").append(result);
                //alert(result);
                if (result[0] === "saved")
                {
                    $(".main-content-inner").fadeOut().load(result[1], function () {
                        $(".main-content-inner").fadeIn();
                        $(".developer").hide();
                    });
                }
            }});

        return false;
    });

    /*    $(document).on('click', '.reportlink', function(event) {
     event.stopImmediatePropagation();
     event.preventDefault();
     
     //alert("kdjfl");
     window.open($(this).attr("href"));
     
     return false;
     });*/

    $(document).on('click', '.ajaxlink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();


        //alert("kdjfl");
        var target = ".main-content-inner";

        if ($(this).attr('data-targetdiv') != null) {
            target = "#" + $(this).attr('data-targetdiv');
        }

        if (target == ".main-content-inner") {
            history.pushState({key: 'value'}, 'title', $(this).attr("href"));
        }

        $(target).fadeOut().load($(this).attr("href"), function () {
            if ($("input[autofocus]").length)
                $("input[autofocus]").focus();

            $(target).fadeIn();
            $(".developer").hide();
            $(".dynamic_row_content").hide();

            //configuresubpagecontent();

            if ($("#comment_box_data_url").length === 1) {
                loadcommentbox();
            }

            if ($('.lazycontent').length)
                lazyloading();

            if ($('.subpage_wizard').length)
                configurewizard();

            if ($("#search_nav_link").length === 1)
            {
//					alert($("#search_nav_link").val());
                $("#search_nav").fadeOut().load($("#search_nav_link").val(), function () {
                    $("#search_nav").fadeIn();

                    $("#pageno").val($("#tpageno").val());
                    $("#pagesize").val($("#tpagesize").val());
                    $("#sort").val($("#tsort").val());

                    $('.date-picker').datepicker(
                            {
                                format: 'dd-mm-yyyy',
                                forceParse: false
                            }
                    );
                    //				alert($("#search_nav").html());
                });
            } else
            {
                $("#search_nav").html("");
            }

        });
        return false;
    });

    $(document).on('click', '#search', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $("#pageid").val('0');

        $.ajax({
            type: "POST",
            url: $(this).closest("form").attr("action") + "/ajax",
            data: $(this).closest("form").serialize(),
            success: function (data) {
                $("#page-contents").html(data);
                $(".developer").hide();
            },
        });
        return false;
    });

    $(document).on('click', '#find', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $("#pageid").val('0');

        $.ajax({
            type: "POST",
            url: $(this).closest("form").attr("action") + "/ajax",
            data: $(this).closest("form").serialize(),
            success: function (data) {
                $("#searchresults").html(data);
            },
        });
        return false;
    });

    /*    $( document ).on( "change", "#sort", function (event) {
     event.stopImmediatePropagation();
     event.preventDefault();
     
     $("#pageno").val("0");
     //alert($("#sort").val());
     
     //var formData = new FormData($(this).closest("form")[0]);
     
     $.ajax({
     type: "GET",
     url: $("#frmsearch").attr("action")  ,
     data: $("#frmsearch").serialize(),
     cache: false,
     contentType: false,
     processData: false,
     success: function (data) {
     alert(data);
     $(".main-content-inner").html(data);
     if (data != "") {
     //    $(".main-content-inner").html(data);
     }
     }
     });
     return false;
     });
     */
    $(document).on("click", ".pagination a", function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        if ($(this).text() == "»")
            $("#pageno").val(parseInt($("#pageno").val()) + 1);
        else if ($(this).text() == "<<")
            $("#pageno").val(parseInt($("#pageno").val()) - 1);
        else
            $("#pageno").val(parseInt($(this).text()) - 1);

        //var formData = new FormData($(this).closest("form")[0]);
        //alert($("#frmsearch").attr("action"));

        $.ajax({
            type: "GET",
            url: $("#frmsearch").attr("action"),
            data: $("#frmsearch").serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //alert(data);
                $(".main-content-inner").html(data);
                $(".developer").hide();

                if (data != "") {
                    //    $(".main-content-inner").html(data);
                }
            }
        });
        return false;
    });

    $(document).on("click", "#simple-table thead tr th a", function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $("#pageno").val("0");
        $("#sort").val($(this).attr("data-sort"));
        //alert($("#sort").val());

        //var formData = new FormData($(this).closest("form")[0]);

        $.ajax({
            type: "GET",
            url: $("#frmsearch").attr("action"),
            data: $("#frmsearch").serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //alert(data);
                $(".main-content-inner").html(data);
                $(".developer").hide();

                if (data != "") {
                    //    $(".main-content-inner").html(data);
                }
            }
        });

        return false;
    });


    $(document).on("submit", "#frmsearch", function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $("#pageno").val("0");
        $("#sort").val($(this).attr("data-sort"));
        //alert($("#sort").val());

        //var formData = new FormData($(this).closest("form")[0]);

        $.ajax({
            type: "GET",
            url: $("#frmsearch").attr("action"),
            data: $("#frmsearch").serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //alert(data);
                $(".main-content-inner").html(data);
                $(".developer").hide();

                if (data != "") {
                    //    $(".main-content-inner").html(data);
                }
            }
        });

        return false;
    });

    $(document).on('submit', '.frminput', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        //alert($(this).attr("action"));

        var formData = new FormData($('.frminput')[0]);

        //alert(formData);

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            /*success: function (data) {
             alert(data);
             $(".main-content-inner").html(data);
             if (data != "") {
             //    $(".main-content-inner").html(data);
             }
             },
             notmodified: function (data) {
             alert("notmodified");
             },
             nocontent: function (data) {
             alert("nocontent");
             },
             error: function (data) {
             alert("error");
             if(typeof(data) == typeof(formData))
             {
             alert("form data");
             }
             },
             timeout: function (data) {
             alert("timeout");
             },
             abort: function (data) {
             alert("abort");
             },
             parsererror: function (data) {
             alert("parsererror");
             }*/
        })
                .done(function (data, textStatus, jqXHR) {
                    //alert("done");
                    if (jqXHR.responseJSON)
                    {
                        //alert("json");
                        //alert(data[3]);
                        //                    console.log(data);
                        $(".main-content-inner").fadeOut().load(data[1], function () {
                            $(".main-content-inner").fadeIn();
                            $(".developer").hide();

                            if ($("#comment_box_data_url").length === 1) {
                                loadcommentbox();
                            }



                            if ($('.lazycontent').length)
                                lazyloading();

                            if ($('.subpage_wizard').length)
                                configurewizard();

                            if ($("#search_nav_link").length === 1)
                            {
                                //					alert($("#search_nav_link").val());
                                $("#search_nav").fadeOut().load($("#search_nav_link").val(), function () {
                                    $("#search_nav").fadeIn();

                                    $("#pageno").val($("#tpageno").val());
                                    $("#pagesize").val($("#tpagesize").val());
                                    $("#sort").val($("#tsort").val());
                                    //				alert($("#search_nav").html());

                                    $('.date-picker').datepicker(
                                            {
                                                format: 'dd-mm-yyyy',
                                        forceParse: false
                                            });
                                });
                            } else
                            {
                                $("#search_nav").html("");
                            }

                        });
                    } else
                    {
                        //alert("html");
//                    console.log(data);

                        $(".main-content-inner").html(data);

                        $('.date-picker').datepicker(
                                {
                                    format: 'dd-mm-yyyy',
                            forceParse: false
                                });

                        if ($("#comment_box_data_url").length === 1) {
                            loadcommentbox();
                        }

                        if ($('.lazycontent').length)
                            lazyloading();

                        if ($('.subpage_wizard').length)
                            configurewizard();
                    }

                })
                .fail(function (data) {
                    alert("Failed to update record.");
                    // show any errors
                    // best to remove for production
                    console.log(data);
                });

        return false;
    });

    $(document).on('click', '.paginglink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $("#curridx").val($(this).attr("data-pageid"));

        $.ajax({
            type: "POST",
            url: $("#frmsearch").attr("action") + "/ajax",
            data: $(this).closest("form").serialize(),
            success: function (data) {
                alert(data);
                $("#page-contents").html(data);
                $(".developer").hide();
            },
        });
        return false;
    });

    $(document).on('click', '.deletelink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var r = confirm("Do you want to remove record.");
        if (r == false)
        {
            return false;
        }

        $.ajax({
            type: "Get",
            url: $(this).attr("href"),
            cache: false,
        })
                .done(function (data, textStatus, jqXHR) {
                    //alert("done");
                    if (jqXHR.responseJSON)
                    {
                        //alert("json");
                        //alert(data[3]);
                        //                    console.log(data);
                        if (data[0] == "Failed")
                        {
                            alert(data[3]);
                        } else
                        {
                            $(".main-content-inner").html("");
                            $(".main-content-inner").fadeOut().load(data[1], function () {
                                $(".main-content-inner").fadeIn();
                                $(".developer").hide();

                                if ($("#comment_box_data_url").length === 1) {
                                    loadcommentbox();
                                }

                                if ($('.lazycontent').length)
                                    lazyloading();

                                if ($('.subpage_wizard').length)
                                    configurewizard();

                                if ($("#search_nav_link").length === 1)
                                {
                                    //					alert($("#search_nav_link").val());
                                    $("#search_nav").fadeOut().load($("#search_nav_link").val(), function () {
                                        $("#search_nav").fadeIn();

                                        $("#pageno").val($("#tpageno").val());
                                        $("#pagesize").val($("#tpagesize").val());
                                        $("#sort").val($("#tsort").val());
                                        //				alert($("#search_nav").html());
                                    });
                                } else
                                {
                                    $("#search_nav").html("");
                                }

                            });
                        }
                    } else
                    {
                        //alert("html");
                        //                    console.log(data);
                        $(".main-content-inner").html(data);
                    }

                })
                .fail(function (data) {
                    alert("Failed to remove record.");
                    // show any errors
                    // best to remove for production
                    console.log(data);
                });

        return false;
    });

    $(document).on('click', '#submit', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $("#submit").attr("disabled", true);

        //var data = new FormData($( this ).closest( "form" ));
        var formData = new FormData($(this).closest("form")[0]);
        //alert($( this ).closest( "form" ).attr("action"));

        $.ajax({
            type: "POST",
            url: $(this).closest("form").attr("action") + "/ajax",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "")
                {
                    if ($("#redirect").val() != "")
                    {
                        //alert("sdfxdfsfsdfsdfs");
                        $("#page-contents").fadeOut().load($("#redirect").val() + "/ajax", function () {
                            $('.date-picker').datepicker(
                                    {
                                        format: 'dd-mm-yyyy',
                                forceParse: false
                                    });
                        }).fadeIn();
                    } else
                    {
                        //alert(data);
                        $("#submit").removeAttr("disabled");
                    }
                } else
                {
                    //alert(data);
                    $("#error").show();
                    $("#errordetail").html(data);
                    $("#submit").removeAttr("disabled");
                }
            },
        });
        return false;
    });

    $(document).on('click', '.multiplesubmitbuttons', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $(this).attr("disabled", true);

        //var data = new FormData($( this ).closest( "form" ));
        var formData = new FormData($(this).closest("form")[0]);
        formData.append($(this).attr("name"), $(this).attr("value"));
        //alert($( this ).closest( "form" ).attr("action"));

        $.ajax({
            type: "POST",
            url: $(this).closest("form").attr("action"),
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
//            success: function (data) {
//                if (data == "")
//                {
//                    if ($("#redirect").val() != "")
//                    {
//                        //alert("sdfxdfsfsdfsdfs");
//                        $("#page-contents").fadeOut().load($("#redirect").val() + "/ajax", function () {
//                            $('.date-picker').datepicker(
//                                    {
//                                        format: 'dd-mm-yyyy'
//                                    });
//                        }).fadeIn();
//                    } else
//                    {
//                        //alert(data);
//                        $("#submit").removeAttr("disabled");
//                    }
//                } else
//                {
//                    //alert(data);
//                    $("#error").show();
//                    $("#errordetail").html(data);
//                    $("#submit").removeAttr("disabled");
//                }
//            },
        })
                .done(function (data, textStatus, jqXHR) {
                    //alert("done");
                    if (jqXHR.responseJSON)
                    {
                        //alert("json");
                        //alert(data[3]);
                        //                    console.log(data);
                        $(".main-content-inner").fadeOut().load(data[1], function () {
                            $(".main-content-inner").fadeIn();
                            $(".developer").hide();

                            if ($("#comment_box_data_url").length === 1) {
                                loadcommentbox();
                            }



                            if ($('.lazycontent').length)
                                lazyloading();

                            if ($('.subpage_wizard').length)
                                configurewizard();

                            if ($("#search_nav_link").length === 1)
                            {
                                //					alert($("#search_nav_link").val());
                                $("#search_nav").fadeOut().load($("#search_nav_link").val(), function () {
                                    $("#search_nav").fadeIn();

                                    $("#pageno").val($("#tpageno").val());
                                    $("#pagesize").val($("#tpagesize").val());
                                    $("#sort").val($("#tsort").val());
                                    //				alert($("#search_nav").html());

                                    $('.date-picker').datepicker(
                                            {
                                                format: 'dd-mm-yyyy',
                                        forceParse: false
                                            });
                                });
                            } else
                            {
                                $("#search_nav").html("");
                            }

                        });
                    } else
                    {
                        //alert("html");
//                    console.log(data);

                        $(".main-content-inner").html(data);

                        $('.date-picker').datepicker(
                                {
                                    format: 'dd-mm-yyyy',
                            forceParse: false
                                });

                        if ($("#comment_box_data_url").length === 1) {
                            loadcommentbox();
                        }

                        if ($('.lazycontent').length)
                            lazyloading();

                        if ($('.subpage_wizard').length)
                            configurewizard();
                    }

                })
                .fail(function (data) {
                    alert("Failed to update record.");
                    // show any errors
                    // best to remove for production
                    console.log(data);
                });
        return false;
    });

    $(document).on('change', '[data-isdd="1"]', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var path = $(this).attr("data-path");
        var ctl = "#" + $(this).attr("data-modelclass").toLowerCase() + "-" + $(this).attr("data-fill");

        $.get(path, {id: $(this).val()})
                .done(function (data) {
                    $(ctl).html(data);
                }
                );

        return false;
    });

    $(document).on('click', '.add_dynamic_row', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var page = $(this).attr("data-url");
        var rowcounter = $(this).attr("data-rowcount");
        var tag = $(this).attr("data-tag");
        var desttable = $(this).attr("data-desttable");
        var source = $(this).attr("data-source");
        var groupidx = $(this).attr("data-gtotalidx");

        var t = $("#" + rowcounter).val();

        $("#" + rowcounter).val(parseInt(t) + 1);

        var completeurl = page + "&id=" + $("#" + rowcounter).val() + "&tag=" + tag + "&source=" + source + "&gtotalidx=" + groupidx;

        $.ajax({url: completeurl, success: function (result) {
                if ($("#" + desttable + " tbody tr.footer").length) {
                    $("#" + desttable + " tbody tr.footer").before(result);
                } else {
                    $("#" + desttable + " tbody").append(result);
                }
            }});

        return false;
    });

    $(document).on('click', '.add_dynamic_content', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        var page = $(this).attr("data-url");
        var rowcounter = $(this).attr("data-rowcount");
        var rowcounter1 = $(this).attr("data-myrowcount");
        var desttable = $(this).attr("data-desttable");
        var extravalue = $(this).attr("data-extras");

        var t = $("#" + rowcounter).val();
        var t1 = $("#" + rowcounter1).val();

        $("#" + rowcounter).val(parseInt(t) + 1);
        $("#" + rowcounter1).val(parseInt(t1) + 1);

        var completeurl = page + "&id=" + $("#" + rowcounter).val() + "&id2=" + $("#" + rowcounter1).val() + "&extras=" + extravalue;

        $.ajax({url: completeurl, success: function (result) {
                $("#" + desttable + "").append(result);
            }});

        return false;
    });

    $(document).on('click', '.datacriteria', function (event) {
        if ($(this).val() == 3)
            $(".daterange").show();
        else
            $(".daterange").hide();
    });

    $(document).on('click', '.devzonelink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $('.developer').toggle();

        return false;
    });

});

$(document).ready(function ()
{
    $('.date-picker').datepicker(
            {
                format: 'dd-mm-yyyy',
        forceParse: false
            });

    $(".sidebar_menu").hide();

    if ($('.datacriteria[checked="checked"]').val() == 3)
        $(".daterange").show();
    else
        $(".daterange").hide();

});

$(document).ajaxComplete(function () {
    if ($('.datacriteria[checked="checked"]').val() == 3)
        $(".daterange").show();
    else
        $(".daterange").hide();

    $(".hidecontent").hide();
    $('[data-toggle="tooltip"]').tooltip();

    $('.date-picker').datepicker(
            {
                format: 'dd-mm-yyyy',
        forceParse: false
            });

    $(".developer").hide();

    configurechart();
});

//var chartdata = null;
//var chartcontainerID = "";
//var chartType = "";

function configurechart() {

//method 1: form, 2: normal url

    var loaders = $('.google_chart');
    $.each(loaders, function (index, element) {
        var page = $(this).attr("data-url");
        var chartType = $(this).attr("data-charttype");     //bar,pie etc
        var chartmethod = $(this).attr("data-method");      //url, form
        var chartform = $(this).attr("data-form");
        var chartcontainerID = $(this).attr("id");

        $(this).removeClass("google_chart");

//        $("#" + targetdiv).html('');
        //      $("#" + targetdiv).show();

        if (chartmethod == "url") {
            $.ajax({url: page, success: function (result) {
//                    chartdata = result;
                    drawChart(result, chartcontainerID, chartType);
//                    google.charts.setOnLoadCallback(drawChart);

                    //google.setOnLoadCallback(drawChart);
                }});
        } else {
            $.ajax({
                type: "GET",
                url: $(chartform).attr("action"),
                data: $(chartform).serialize(),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    google.setOnLoadCallback(function () {
                        drawChart(charttype, targetdiv, data, null);
                    });
                }
            });
        }
    });
}

$(document).on("keypress", ".commentstextbox", function (event) {
    var keyCode = event.which || event.keyCode;
    if (keyCode == 13) {
        $(".btnsubmitcomment").click();
        return false;
    }
});

function loadcommentbox() {
    $.ajax({url: $("#comment_box_data_url").val(), success: function (result) {
            $("#comments_content").html(result);
        }});

}

$(document).on('click', '.expandablecontent', function (event) {
    event.stopImmediatePropagation();
    event.preventDefault();

    var url = $(this).attr('data-url');
    var target = $(this).attr('data-target');
    $('#' + target).load(url, function (data) {
    });

    return false;
});

//sub page
$(document).on('click', '.dynamic_form', function (event) {
    event.stopImmediatePropagation();
    event.preventDefault();

    var page = $(this).attr("data-url");
    var submitpage = $(this).attr("data-compurl1");
    var targetdiv = $(this).attr("data-targetdiv");
    var targetlistcontainer = $(this).attr("data-listcontainer");
    var targetlistpage = $(this).attr("data-listurl");
    var hasaction = $(this).attr("data-allowaction");
    
    $("#" + targetdiv).html('');
    $("#" + targetdiv).removeAttr("style");
    $("#" + targetdiv).show();
//    $("#" + targetdiv).css('display', 'block');

    $("#" + targetdiv).fadeOut().load(page, function () {
        if ($("input[autofocus]").length)
            $("input[autofocus]").focus();

        configuresubpagecontent(submitpage, targetdiv, targetlistpage, targetlistcontainer, hasaction, page);

        $("#" + targetdiv).fadeIn();
        $(".developer").hide();
//        $(".dynamic_row_content").hide();
    });
    return false;
});

function configuresubpagecontent(submitpage, targetdiv, targetlistpage, targetlistcontainer, hasaction, basepage) {
    var loaders = $('.btnfindrecord');
    $.each(loaders, function (index, element) {
        if (!$(this).attr('data-targetdiv')) {
            $(this).attr('data-compurl1', submitpage);
            $(this).attr('data-targetdiv', targetdiv);
            $(this).attr('data-listcontainer', targetlistpage);
            $(this).attr('data-listurl', targetlistcontainer);
            $(this).attr('data-allowaction', hasaction);
        }
    });

    loaders = $('.btnsubmitandcontsubpage');
    $.each(loaders, function (index, element) {
        if (!$(this).attr('data-targetdiv')) {
            $(this).attr('data-compurl1', submitpage);
            $(this).attr('data-targetdiv', targetdiv);
            $(this).attr('data-listcontainer', targetlistpage);
            $(this).attr('data-listurl', targetlistcontainer);
            $(this).attr('data-allowaction', hasaction);
        }
    });

    loaders = $('.btnsubmitsubpage');
    $.each(loaders, function (index, element) {
        if (!$(this).attr('data-targetdiv')) {
            $(this).attr('data-compurl1', submitpage);
            $(this).attr('data-targetdiv', targetdiv);
            $(this).attr('data-listcontainer', targetlistpage);
            $(this).attr('data-listurl', targetlistcontainer);
            $(this).attr('data-allowaction', hasaction);
        }
    });

    loaders = $('.sublink');
    $.each(loaders, function (index, element) {
        if ($(this).attr('data-targetdiv') == null) {
            $(this).attr('data-compurl1', submitpage);
            $(this).attr('data-targetdiv', targetdiv);
            $(this).attr('data-listcontainer', targetlistpage);
            $(this).attr('data-listurl', targetlistcontainer);
            $(this).attr('data-allowaction', hasaction);
        }
    });

    loaders = $('.sublinkreset');
    $.each(loaders, function (index, element) {
        if ($(this).attr('data-targetdiv') == null) {
            $(this).attr('data-url', basepage);
            $(this).attr('data-targetdiv', targetdiv);
        }
    });
}

function configurewizard() {
    var loaders = $('.subpage_wizard');
    $.each(loaders, function (index, element) {
        var page = $(this).attr("data-url");
        var submitpage = $(this).attr("data-compurl1");
        var targetdiv = $(this).attr("data-targetdiv");
        var targetlistcontainer = $(this).attr("data-listcontainer");
        var targetlistpage = $(this).attr("data-listurl");
        var hasaction = $(this).attr("data-allowaction");

        $("#" + targetdiv).html('');
        $("#" + targetdiv).show();

        $("#" + targetdiv).fadeOut().load(page, function () {
            if ($("input[autofocus]").length)
                $("input[autofocus]").focus();

            configuresubpagecontent(submitpage, targetdiv, targetlistpage, targetlistcontainer, hasaction, page);

            if(hasaction != "yes"){
                $(".subpage_actions").hide();
            }
            $("#" + targetdiv).fadeIn();
            $(".developer").hide();
            $(".dynamic_row_content").hide();
        });
    });
}

function lazyloading() {
    var loaders = $('.lazycontent');
    $.each(loaders, function (index, element) {
        var url = $(this).attr('data-url');
        $(this).removeAttr('data-url');
        $(this).removeClass('lazycontent');
        $(this).load(url, function (data) {
        });
    });

    if ($('.lazycontent').length)
        lazyloading();
}

$(document).on('click', '.btnfindrecord, .btnsubmitandcontsubpage', function (event) {
    event.stopImmediatePropagation();
    event.preventDefault();

    //alert($(this).closest(".subpage_wizard").attr("data-targetdiv"));
//    var container = $(this).closest(".subpage_wizard").attr("data-targetdiv");
    var page = $(this).closest(".subpage_wizard").attr("data-url");//$(this).attr("data-url");
    var submitpage = $(this).closest(".subpage_wizard").attr("data-compurl1");//$(this).attr("data-compurl1");
    var targetdiv = $(this).closest(".subpage_wizard").attr("data-targetdiv");//$(this).attr("data-targetdiv");
    var targetlistcontainer = $(this).closest(".subpage_wizard").attr("data-listcontainer");//$(this).attr("data-listcontainer");
    var targetlistpage = $(this).closest(".subpage_wizard").attr("data-listurl");//$(this).attr("data-listurl");
    var hasaction = $(this).closest(".subpage_wizard").attr("data-allowaction");//$(this).attr("data-allowaction");

    var formData = new FormData($(this).closest('form')[0]);

    $.ajax({
        type: 'POST',
        url: page,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
    })
            .done(function (data, textStatus, jqXHR) {
                if (jqXHR.responseJSON)
                {
                    $('#' + targetdiv).fadeOut().load(data[1], function () {
                        $('#' + targetdiv).fadeIn();

                        if (hasaction === "no") {
                            $(".subpage_actions").hide();
                        }

                        configuresubpagecontent(submitpage, targetdiv, targetlistpage, targetlistcontainer, hasaction, data[1]);
                    });
                } else
                {
//                    alert(data);
                    $('#' + targetdiv).html(data);
                }
            })
            .fail(function (data) {
                alert('Failed to find record.');
                console.log(data);
            });

    return false;
});

$(document).on('click', '.btnsubmitandcontsubpage', function (event) {
    event.stopImmediatePropagation();
    event.preventDefault();

    var page = $(this).attr("data-url");
    var submitpage = $(this).attr("data-compurl1");
    var targetdiv = $(this).attr("data-targetdiv");
    var targetlistcontainer = $(this).attr("data-listcontainer");
    var targetlistpage = $(this).attr("data-listurl");
    var hasaction = $(this).attr("data-allowaction");

    var formData = new FormData($(this).closest('form')[0]);

    $.ajax({
        type: 'POST',
        url: $(this).attr("data-url"),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
    })
            .done(function (data, textStatus, jqXHR) {
                if (jqXHR.responseJSON)
                {
                    $('#' + targetdiv).fadeOut().load(data[1], function () {
                        $('#' + targetdiv).fadeIn();

                        if (hasaction === "no") {
                            $(".subpage_actions").hide();
                        }

                        configuresubpagecontent(submitpage, targetdiv, targetlistpage, targetlistcontainer, hasaction, data[1]);

                    });
                } else
                {
                    $('#' + targetdiv).html(data);
                    //    $('#' + targetdiv).hide();
                    //  $('#' + targetlistcontainer).html(data);
                }
            })
            .fail(function (data) {
                alert('Failed to update record.');
                console.log(data);
            });

    return false;
});

$(document).on('click', '.btnsubmitsubpage', function (event) {
    event.stopImmediatePropagation();
    event.preventDefault();

    var page = $(this).attr("data-url");
    var submitpage = $(this).attr("data-compurl1");
    var targetdiv = $(this).attr("data-targetdiv");
    var targetlistcontainer = $(this).attr("data-listcontainer");
    var targetlistpage = $(this).attr("data-listurl");
    var hasaction = $(this).attr("data-allowaction");

    var formData = new FormData($(this).closest('form')[0]);

    $.ajax({
        type: 'POST',
        url: submitpage,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
    })
            .done(function (data, textStatus, jqXHR) {
                if (jqXHR.responseJSON)
                {
                    $('#' + targetdiv).hide();

                    $('#' + targetlistcontainer).fadeOut().load(targetlistpage, function () {
                        $('#' + targetlistcontainer).fadeIn();

                        configuresubpagecontent(submitpage, targetdiv, targetlistpage, targetlistcontainer, hasaction, targetlistpage);

                    });
                } else
                {
                    $('#' + targetdiv).hide();
                    $('#' + targetlistcontainer).html(data);
                }
            })
            .fail(function (data) {
                alert('Failed to update record.');
                console.log(data);
            });

    return false;
});

$(document).on('click', '.sublink, .sublinkreset', function (event) {
    event.stopImmediatePropagation();
    event.preventDefault();

    var page = $(this).attr("data-url");
    var submitpage = $(this).attr("data-compurl1");
    var targetdiv = $(this).attr("data-targetdiv");
    var targetlistcontainer = $(this).attr("data-listcontainer");
    var targetlistpage = $(this).attr("data-listurl");
    var hasaction = $(this).attr("data-allowaction");

    var url = $(this).attr('href');
    //var target = $(this).attr('data-container');
    //alert($(this).attr('data-container'));
    $('#' + targetdiv).load($(this).attr("href"), function (data) {

        configuresubpagecontent(submitpage, targetdiv, targetlistpage, targetlistcontainer, hasaction, page);
    });

    return false;
});

$(document).on('click', '.sublinkreset', function (event) {
    event.stopImmediatePropagation();
    event.preventDefault();

    var page = $(this).attr("data-url");
    var submitpage = $(this).attr("data-compurl1");
    var targetdiv = $(this).attr("data-targetdiv");
    var targetlistcontainer = $(this).attr("data-listcontainer");
    var targetlistpage = $(this).attr("data-listurl");
    var hasaction = $(this).attr("data-allowaction");

    var url = $(this).attr('href');
    //var target = $(this).attr('data-container');
    //alert($(this).attr('data-container'));
    $('#' + targetdiv).load($(this).attr("href"), function (data) {

        configuresubpagecontent(submitpage, targetdiv, targetlistpage, targetlistcontainer, hasaction, page);
    });

    return false;
});


//calculations
function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function removeCommas(nStr) {
    return nStr.replace(",","");
}

/*$(document).ready(function() 
 {
 $( ".ajaxlink" ).on( "click", function(event) {
 event.preventDefault();
 
 //alert("kdjfl");
 history.pushState({key: 'value'},'title',$(this).attr("href"));
 updateSidebarPElement($(this).attr("href"));
 
 $("#main-content").fadeOut().load($(this).attr("href") + "/ajax").fadeIn();
 return false;
 });
 *//*	  $(".ajaxlink").click(
  function(event)
  {
  event.preventDefault();
  
  //alert("kdjfl");
  history.pushState({key: 'value'},'title',$(this).attr("href"));
  updateSidebarPElement($(this).attr("href"));
  
  $("#main-content").fadeOut().load($(this).attr("href") + "/ajax").fadeIn();
  return false;
  }
  );
  $("#search").click(
  function(event)
  {
  event.preventDefault();
  
  //alert("kdjfl");
  //history.pushState({key: 'value'},'title',$(this).attr("href"));
  //updateSidebarPElement($(this).attr("href"));
  //alert($( this ).closest( "form" ).attr("action"));
  /*			  $.ajax({
  type: "POST",
  url: $( this ).closest( "form" ).attr("action") + "/ajax",
  data: $( this ).closest( "form" ).serialize(),
  success: function(){ alert("success"); },
  });
  return false;
  }
  );
  });*/

/*window.onpopstate = function(event){window.location = document.location.pathname; }*/
window.onpopstate = function (event) {
    //alert('popstate fired');
    $('#ajaxContent').fadeOut(function () {
        //$('.pageLoad').show();
        $('.main-content-inner').html('')
                .load($this.attr('href'), function () {
                    //                  $('.pageLoad').hide();
                    $('.main-content-inner').fadeIn();
                });
    });
};

//chartType, containerID, dataArray, options
function drawChart(chartdata, chartcontainerID, chartType) {
//    alert(chartdata);
    //  return;

    //var data = google.visualization.arrayToDataTable(dataArray);
//    var Combined = new Array();
//    Combined[0] = ['Results', 'First', 'Second'];
//    for (var i = 0; i < chartdata.length; i++) {
//        Combined[i+1] = [chartdata[i], chartdata[i], chartdata[i]];
//    }
//    var data = new google.visualization.DataTable(
//            [['Name', 'Count-A', 'Count-B'],
//            ['Test-A', 4, 3],
//            ['Test-B', 1, 2],
//            ['Test-C', 3, 4],
//            ['Test-D', 2, 0],
//            ['Test-E', 2, 5]]
//            );
    var jsonData = $.ajax({
            url: "http://php-pc/fdhl/property/web/index.php?r=property/config/files/charttest",
            dataType:"json",
            async: false
        }).responseText;
var data = new google.visualization.DataTable(jsonData);        
    var containerDiv = document.getElementById(chartcontainerID);
    var chart = false;

    if (chartType.toUpperCase() == 'BARCHART') {
        chart = new google.visualization.BarChart(containerDiv);
    } else if (chartType.toUpperCase() == 'COLUMNCHART') {
        chart = new google.visualization.ColumnChart(containerDiv);
    } else if (chartType.toUpperCase() == 'PIECHART') {
        chart = new google.visualization.PieChart(containerDiv);
    } else if (chartType.toUpperCase() == 'TABLECHART')
    {
        chart = new google.visualization.Table(containerDiv);
    }

    if (chart == false) {
        return false;
    }

    chart.draw(data, {width: 400, height: 240}); //options
}

function updateSidebarPElement(href)
{
    var e = getSidebarPElementID(href);

    $(".sidebar-links").attr("class", "sidebar-links");

    if (e != "")
        $("#" + e).attr("class", "active open sidebar-links");

    updateSidebarChildElement(href);
}

function updateSidebarChildElement(href)
{
    var e = getSidebarElementID(href);

    if (e != "")
        $("#" + e).attr("class", "active sidebar-links");
}

function getSidebarPElementID(href)
{
    if (href.indexOf("index.php/Events/") > 0)
        return "events_main";
    else if (href.indexOf("index.php/Athletes/") > 0)
        return "athletes_main";
    else if (href.indexOf("index.php/Zones/") > 0)
        return "zones_main";
    else if (href.indexOf("index.php/Universities/") > 0)
        return "universities_main";
    else if (href.indexOf("index.php/Sports/") > 0)
        return "sports_main";
    else
        return "";
}

function getSidebarElementID(href)
{
    if (href.indexOf("index.php/Hec/dashboard") > 0)
        return "dashboard";
    else if (href.indexOf("index.php/Events/showlist") > 0)
        return "events_list";
    else if (href.indexOf("index.php/Events/newrecord") > 0)
        return "events_add";
    else if (href.indexOf("index.php/Athletes/showlist") > 0)
        return "athletes_list";
    else if (href.indexOf("index.php/Athletes/newrecord") > 0)
        return "thletes_add";
    else if (href.indexOf("index.php/Zones/showlist") > 0)
        return "zones_list";
    else if (href.indexOf("index.php/Zones/newrecord") > 0)
        return "zones_add";
    else if (href.indexOf("index.php/Universities/showlist") > 0)
        return "universities_list";
    else if (href.indexOf("index.php/Universities/newrecord") > 0)
        return "universities_add";
    else if (href.indexOf("index.php/Sports/showlist") > 0)
        return "sports_list";
    else if (href.indexOf("index.php/Sports/newrecord") > 0)
        return "sports_add";
    else
        return "";
}
