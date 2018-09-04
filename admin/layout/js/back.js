/**
 * Created by Hassan Elhawry.
 */

$(function() {

    $('.form-control').focus(function() {
        $(this).attr("data-text", $(this).attr("placeholder"));
        $(this).attr("placeholder", "");

    }).blur(function() {
        $(this).attr("placeholder", $(this).attr("data-text"));

    });

    $(".mainLogin .form-control").focus(function() {
        $(this).parent().find("i").css({
            "left": "20px",
            "color": "#57b846",
            "z-index": "2252"
        });
        $(this).css({ "padding-left": "47px", "border-color": "#DDD" });

    }).blur(function() {
        $(this).parent().find("i").css({
            "left": "35px",

        });
        $(this).css("padding-left", "65px")
    });


    'use strict';

    var userError = true,

        passError = true;

    //Check Eorro On Submit
    $('.mainLogin  .user').blur(function() {

        if ($(this).val().length < 4) {

            $(this).css('border', '1px solid #F00');
            $(this).parent().find("i").css("color", "#F00");
            userError = true;

        } else {

            $(this).css('border', '1px solid #080');
            $(this).parent().find("i").css("color", "#080");
            userError = false;
        }
    })

    $('.mainLogin  .pass').blur(function() {

        if ($(this).val().length == '') {

            $(this).css('border', '1px solid #F00');
            $(this).parent().find("i").css("color", "#F00");
            passError = true;

        } else {

            $(this).css('border', '1px solid #080');
            $(this).parent().find("i").css("color", "#080");
            passError = false;
        }
    })


    $('.mainLogin  .login-form').submit(function(e) {

        if (userError === true || passError === true) {

            e.preventDefault();
            $('.user , .pass').blur();
            $(this).find(".ic").css({
                "color": "red"
            });

        }
    });

    //REquired Input

    $('input').each(function() {
        if ($(this).attr("required") === "required") {
            $(this).after('<span class="astreick">*</span>');
        }

    });

    //Show Password
    var passFiled = $('.password');

    $('i.show-pass').hover(function() {

        passFiled.attr("type", "text");

    }, function() {

        passFiled.attr("type", "password");

    });

    //Conform Message in button

    $('.confirm').click(function() {

        return confirm("Are You Sure Delete");
    })
});