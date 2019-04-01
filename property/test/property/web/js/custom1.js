// JavaScript Document
$(function () {
    $(document).on('click', '.reportlink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        //alert($(this).attr("href"));


        $.ajax({
            type: "GET",
            url: $(this).attr("href"), //$("#frmsearch").attr("action") ,
            data: $("#frmsearch").serialize(),
            target: "_blank",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var newwind = window.open($(this).attr("href"));
                newwind.document.write(data);
            }
        });


        return false;
    });

    $(document).on('click', '.ajaxlink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        //alert("kdjfl");
        history.pushState({key: 'value'}, 'title', $(this).attr("href"));


        $(".main-content-inner").fadeOut().load($(this).attr("href"), function () {
            if ($("input[autofocus]").length)
                $("input[autofocus]").focus();

            $(".main-content-inner").fadeIn();

            if ($("#search_nav_link").length == true)
            {
//					alert($("#search_nav_link").val());
                $("#search_nav").fadeOut().load($("#search_nav_link").val(), function () {
                    $("#search_nav").fadeIn();

                    $("#pageno").val($("#tpageno").val());
                    $("#pagesize").val($("#tpagesize").val());
                    $("#sort").val($("#tsort").val());

                    $('.date-picker').datepicker();
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
            target: "_blank",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //alert(data);
                $(".main-content-inner").html(data);
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

        alert($(this).attr("action"));

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

                            if ($("#search_nav_link").length == true)
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
                    } else
                    {
                        //alert("html");
//                    console.log(data);
                        $(".main-content-inner").html(data);
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
                            $(".main-content-inner").fadeOut().load(data[1], function () {
                                $(".main-content-inner").fadeIn();

                                if ($("#search_nav_link").length == true)
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
                        $("#page-contents").fadeOut().load($("#redirect").val() + "/ajax").fadeIn();
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
    
    $(document).on('click', '.dynamiclink', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();

        $.ajax({url: $(this).attr("href"), success: function (result) {
                //$("#booking_list tbody").append(result);
                alert(result);
                //if (result[0] === "saved")
                //{
                    /*$(".main-content-inner").fadeOut().load(result[1], function () {
                        $(".main-content-inner").fadeIn();
                    });*/
                //}
            }});

        return false;
    });


    $(document).on('click', '#add_dynamic_row', function (event) {
        event.preventDefault();
        //alert($.now());
        $("#table_bug_report tbody").fadeOut().load($(this).attr("href") + "/" + e.now()).fadeIn();
        // $("#table_bug_report tbody").append('<tr><td width="40" class="center"></td><td>Title</td><td>Format</td></tr>');

        return false;
    });
});

$(document).ready(function ()
{
    $(".sidebar_menu").hide();
});

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

window.onpopstate = function (event) {
    window.location = document.location.pathname;
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
