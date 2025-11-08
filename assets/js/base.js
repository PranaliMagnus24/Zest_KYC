baseurl = 'http://localhost/kyc_files/api/index.php/';
baselink = 'http://localhost/kyc_files/';
// baseurl = 'https://kyc.zesttourcrm.in/stagging/api/index.php/';
// baselink = 'https://kyc.zesttourcrm.in/stagging/';
// baseurl = 'https://kyc.zesttourcrm.in/api/index.php/';
// baselink = 'https://kyc.zesttourcrm.in/';
setTimeout(function () { $('.find').val('') }, 500)

$(".goBack").click(function () {
    window.history.back();
});
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
$(".clear-input").click(function () {
    $(this).parent(".input-wrapper").find(".form-control").focus();
    $(this).parent(".input-wrapper").find(".form-control").val("");
    $(this).parent(".input-wrapper").removeClass("not-empty");
});
// active
$(".form-group .form-control").focus(function () {
    $(this).parent(".input-wrapper").addClass("active");
}).blur(function () {
    $(this).parent(".input-wrapper").removeClass("active");
})
// empty check
$(".form-group .form-control").keyup(function () {
    var inputCheck = $(this).val().length;
    if (inputCheck > 0) {
        $(this).parent(".input-wrapper").addClass("not-empty");
    } else {
        $(this).parent(".input-wrapper").removeClass("not-empty");
    }
});
///////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
// Searchbox Toggle
$(".toggle-searchbox").click(function () {
    $("#search").fadeToggle(200);
    $("#search .form-control").focus();
});
///////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
// Owl Carousel
// $('.carousel-full').owlCarousel({
//     loop: true,
//     margin: 8,
//     nav: false,
//     items: 1,
//     dots: false,
// });
// $('.carousel-single').owlCarousel({
//     stagePadding: 30,
//     loop: true,
//     margin: 16,
//     nav: false,
//     items: 1,
//     dots: false,
// });
// $('.carousel-multiple').owlCarousel({
//     stagePadding: 32,
//     loop: true,
//     margin: 16,
//     nav: false,
//     items: 2,
//     dots: false,
// });
// $('.carousel-small').owlCarousel({
//     stagePadding: 32,
//     loop: true,
//     margin: 8,
//     nav: false,
//     items: 4,
//     dots: false,
// });
// $('.carousel-slider').owlCarousel({
//     loop: true,
//     margin: 8,
//     nav: false,
//     items: 1,
//     dots: true,
// });


$(document).on('show.bs.modal.show', '.modal', function (event) {
    if ($('.modal.show').length > 1) {
        var zIndex = 1060 + (10 * $('.modal.show').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    } else if ($('.modal.show').length == 1) {
        var zIndex = 1060 + (10 * $('.modal.show').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    } else {
        var zIndex = 1060 - (10 * $('.modal.show').length);

        $('.modal.show').css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    }
});
///////////////////////////////////////////////////////////////////////////


function show_toast(message, type, not_type, pos = 'top', bg = 'inverse') {

    var random = Math.floor(Math.random() * 10);
    if (type == 'danger') {
        $text_type = 'name="close-circle-outline" class="text-danger"'
    } else {
        $text_type = 'name="checkmark-circle" class="text-success"';
    }
    if (not_type == 'big') {
        $('body').append('<div id="toast' + random + '" class="toast-box text-center toast-' + pos + ' show"><div class="in"><ion-icon ' + $text_type + '></ion-icon><div class="text">' + message + '</div></div></div>')
    } else {
        $('body').append('<div id="toast' + random + '" class="toast-box bg-' + bg + ' text-center toast-' + pos + ' show"><div class="in w-100 p-0"><div class="text">' + message + '</div></div></div>')
    }
    setTimeout(() => {
        $('#toast' + random).removeClass('show');
        $('#toast' + random).remove();
    }, 3000);
    setTimeout(() => {
        $('#toast' + random).remove();
    }, 3500);
}

function validate(form_id, fun, parameter = false) {
    var error = 0
    $(form_id + ' .input-danger').remove()

    $(form_id + ' input').each(function () {
        $(this).parent().parent().parent().find('.input-danger').remove()
        if ($(this).attr("data-required") == 'yes' && $(this).attr("data-type") !== undefined) {
            if ($(form_id + ' input[type=' + $(this).attr("data-type") + '][name=' + $(this).attr("data-name") + ']:checked').length <= 0) {
                $(this).parent().parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-message') + '</div>')
                $(this).parent().parent().parent().addClass('text-danger')
                error++
            }
        }
    });
    $(form_id + ' input:visible,' + form_id + ' textarea:visible,' + form_id + ' select:visible').each(function () {
        if ($(this).attr('type') != 'file') {
            $(this).parent().parent().find('.input-danger').remove()
            if ($(this).attr("data-required") == 'yes' && $(this).val() == null) {
                $(this).parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-required-message') + '</div>')
                $(this).parent().parent().addClass('text-danger')
                error++
            } else if ($(this).attr("data-required") == 'yes' && $(this).val() == '') {
                $(this).parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-required-message') + '</div>')
                $(this).parent().parent().addClass('text-danger')
                error++
            } else if ($(this).attr("data-pattern") !== undefined && !$(this).val().trim().match($(this).attr("data-pattern")) && $(this).val().trim() != '') {
                $(this).parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-message') + '</div>')
                $(this).parent().parent().addClass('text-danger')
                error++
            } else if ($(this).attr("data-match") !== undefined && $(this).val().trim() != $('#' + $(this).attr("data-match")).val().trim() && $(this).val().trim() != '') {
                $(this).parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-message') + '</div>')
                $(this).parent().parent().addClass('text-danger')
                error++
            } else if ($(this).attr("minlength") !== undefined) {
                if ($(this).attr('minlength') > $(this).val().length && $(this).val() != '') {
                    $(this).parent().parent().append('<div class="input-danger"> Minimum length ' + $(this).attr('minlength') + '</div>')
                    $(this).parent().parent().addClass('text-danger')
                    error++
                }
            } else if ($(this).attr("data-unique-fun") !== undefined && $(this).val().trim() != '') {
                unique_fun = $(this).attr("data-unique-fun");
                request = $(this).attr("data-request");
                form = $(this).attr("data-form");
                $(this).parent().parent().parent().find('.error').html('')

                var fun_error = window[unique_fun]($(this), request, form, false);

                if (typeof fun_error != 'undefined' && fun_error != 'ok') {
                    if ($(this).attr("data-show-toast") !== undefined) {
                        $(this).parent().parent().parent().find('.error').html('')
                        $(this).parent().parent().parent().find('.error').html(fun_error)
                    } else {
                        $(this).parent().parent().parent().find('.error').html('')
                        $(this).parent().parent().append('<div class="input-danger">' + fun_error + '</div>')
                        $(this).parent().parent().addClass('text-danger')
                    }
                    error++
                } else {
                    $(this).siblings('.help-block').remove()
                    $(this).parent().parent().removeClass('text-danger')
                }

            } else {
                $(this).siblings('.help-block').remove()
                $(this).parent().parent().removeClass('text-danger')
            }
        }
        else {
            if ($(this).attr("data-required") == 'yes' && ($(this).siblings('input[type=hidden]').val() == null || $(this).siblings('input[type=hidden]').val() == '')) {
                $(this).parent().parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-required-message') + '</div>')
                $(this).parent().parent().parent().addClass('text-danger')
                error++
            }
        }
    })
    if (error == 0) {
        if (fun != '') {
            if (parameter == false) {
                window[fun]()
            } else {
                window[fun](parameter)
            }
        }
    }
    else {
        show_toast('Please fill all * mark fields', "danger", '', "top", "danger");
    }
}

validate_onupdate()


function validate_onupdate() {
    var error = 0;
    $('input[type=radio], input[type=checkbox]').click(function () {
        $(this).parent().parent().parent().find('.input-danger').remove()
        $(this).parent().parent().parent().removeClass('text-danger')
        if ($(this).attr("data-required") == 'yes' && $(this).attr("data-type") !== undefined) {
            if ($('input[type=' + $(this).attr("data-type") + '][name=' + $(this).attr("data-name") + ']:checked').length <= 0) {
                $(this).parent().parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-message') + '</div>')
                $(this).parent().parent().parent().addClass('text-danger')

            }
            error++
        }
    });

    $('input,textarea').keyup(function () {
        $(this).parent().parent().find('.input-danger').remove()
        $(this).parent().parent().removeClass('text-danger')
        if ($(this).attr("data-required") == 'yes' && $(this).val().trim() == '') {
            $(this).parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-required-message') + '</div>')
            $(this).parent().parent().addClass('text-danger')
            error++
        } else if ($(this).attr("data-pattern") !== undefined && !$(this).val().trim().match($(this).attr("data-pattern")) && $(this).val().trim() != '') {
            $(this).parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-message') + '</div>')
            $(this).parent().parent().addClass('text-danger')
            error++
        } else if ($(this).attr("data-match") !== undefined && $(this).val().trim() != $('#' + $(this).attr("data-match")).val().trim() && $(this).val().trim() != '') {
            $(this).parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-message') + '</div>')
            $(this).parent().parent().addClass('text-danger')
            error++
        } else if ($(this).attr("data-unique-fun") !== undefined && $(this).val().trim() != '') {
            unique_fun = $(this).attr("data-unique-fun");
            request = $(this).attr("data-request");
            form = $(this).attr("data-form");
            var fun_error = window[unique_fun]($(this), request, form, true);

            $(this).parent().parent().parent().find('.error').html('')
            if (typeof fun_error != 'undefined' && fun_error != 'ok') {
                if ($(this).attr("data-show-toast") !== undefined) {
                    $(this).parent().parent().parent().find('.error').html('')
                    $(this).parent().parent().parent().find('.error').html(fun_error)
                } else {
                    $(this).parent().parent().parent().find('.error').html('')
                    $(this).parent().parent().append('<div class="input-danger">' + fun_error + '</div>')
                    $(this).parent().parent().addClass('text-danger')
                }
                error++
            } else {
                $(this).siblings('.input-danger').remove()
                $(this).parent().parent().removeClass('text-danger')
            }
        } else {
            $(this).siblings('.input-danger').remove()
            $(this).parent().parent().removeClass('text-danger')
        }
    })
    $('input[type=file]').change(function () {
        $(this).parent().parent().parent().find('.input-danger').remove()
        $(this).parent().parent().parent().removeClass('text-danger')
    })
    $('select').change(function () {
        $(this).parent().parent().find('.input-danger').remove()
        $(this).parent().parent().removeClass('text-danger')

        if ($(this).attr("data-required") == 'yes' && $(this).val().trim() == '') {
            $(this).parent().parent().append('<div class="input-danger">' + $(this).attr('data-validation-required-message') + '</div>')
            $(this).parent().parent().addClass('text-danger')
            error++
        } else {
            $(this).siblings('.input-danger').remove()
            $(this).parent().parent().removeClass('text-danger')
        }
    })
}

// email exist ends
function check_email_exist(event, req, form) {

    id = $(form + ' .id').val()
    var returnval;
    $.ajax({
        type: "POST",
        url: baseurl + 'login.php',
        data: $(form).find('select, textarea, input').serialize() + '&req=' + req + '&id=' + id,
        async: false,
        success: function (html) {
            if (html.trim() == 'ok') {
                $(event).parent().parent().removeClass('has-error')
            } else {
                $(this).parent().parent().parent().find('.error').html('')
                $(this).parent().parent().append('<div class="input-danger">' + html + '</div>')
                $(this).parent().parent().addClass('text-danger')
            }
            returnval = html.trim();
        }
    });
    return returnval;
}



function logout() {
    localStorage.removeItem("user_id");
    localStorage.removeItem("user_email");
    localStorage.removeItem("user_type");

    window.location.href = "login.html"
}

function set_id(value, id) {
    $(id).val(value)
}
function search_function(input, target, parents) {
    var input = document.getElementById(input);
    var filter = input.value.toLowerCase();
    if (filter.length > 0) {
        $(target).each(function () {
            if ($(this).text().toLowerCase().indexOf(filter) != -1) {
                $(this).removeClass('not-matching');
            } else {
                $(this).addClass('not-matching');
            }
            setTimeout(function () {
                if ($(parents).hasClass('.not-matching')) {
                    $(parents).addClass('hidden')
                }
            }, 200)
        })
    }
    if (filter.length <= 0) {
        $(target).removeClass('not-matching');
    }
}

function check_activity_id(text_id, id_id) {
    if ($(id_id).val() == '') {
        $(text_id).val('')
    }
}
$('.dropdown-menu.multiple').on('click', function (event) {
    event.stopPropagation();
});

function select_value(name, value, name_id, value_id, type = "single") {
    $(name_id).val(name)
    name_ids = value_id.replace('#', '.');
    name_ids = name_ids.replace('(', '')
    name_ids = name_ids.replace(')', '')
    name_ids = name_ids.split('_');
    //name_idss = name_ids.replace('language', '');
    if (type != 'multiple') {
        $(name_ids + 's_id .selected').removeClass('selected')
    }
    value = value.replace(/ /g, '_')
    if (type == 'multiple' && $(name_ids[0] + 's_' + name_ids[1] + ' ' + name_ids[0] + value).hasClass('selected')) {
        $(name_ids[0] + 's_' + name_ids[1] + ' ' + name_ids[0] + value).removeClass('selected')
    } else {
        //alert(name_ids[0] + 's_' + name_ids[1] + ' ' + name_ids[0] + value)
        $(name_ids[0] + 's_' + name_ids[1] + ' ' + name_ids[0] + value).addClass('selected ')
    }

    if (type != 'multiple') {
        $(name_ids + 's_id ' + name_idss + value).addClass('selected')
    }
    $(name_id).parent().parent().find('.input-danger').remove()
    $(name_id).parent().parent().removeClass('text-danger')
    $(name_id).parent().parent().removeClass('input-info');
    if (type == 'multiple') {
        value = name = '';
        $(name_ids[0] + 's_' + name_ids[1] + ' .selected').each(function () {
            if (value == '') {
                value = $(this).attr('data-text');
                name = $(this).attr('data-id');
            } else {
                value += ',' + $(this).attr('data-text');
                name += ',' + $(this).attr('data-id');
            }
        })
        $(name_id).val(name)
        $(value_id).val(value)
    } else {
        $(value_id).val(value)
    }
}

function cancel_clr(area) {
    areas = area.split(' ')
    $(areas[0]).find('.input-danger').remove()
    $(areas[0]).find('.text-danger').removeClass('text-danger')
    $(area).each(function () {
        if ($(this).attr('data-type') !== undefined) {
            if ($(this).attr('data-type') == 'number') {
                $(this).val(0);
            }
            else {
                $(this).val('');
            }
        }
        else {
            $(this).val('');
        }
    })
}


if ($('.datepickernomax').length > 0) {
    $('.datepickernomax').datetimepicker({ format: 'DD-MM-YYYY' })
        .on('dp.show', function () {
            //$('.date-picker-fixed').height($('.bootstrap-datetimepicker-widget .list-unstyled').height())
        })
        .on('dp.change', function (e) {
            $(this).blur()
            $(this).parent().siblings('.input-danger').remove();
            $(this).parent().parent().removeClass('text-danger');
        })
}
if ($('.datepicker').length > 0) {
    $('.datepicker').datetimepicker({ format: 'DD-MM-YYYY' })
        .on('dp.show', function () {
            //$('.date-picker-fixed').height($('.bootstrap-datetimepicker-widget .list-unstyled').height())
        })
        .on('dp.change', function (e) {
            $(this).blur()
            $(this).parent().siblings('.input-danger').remove();
            $(this).parent().parent().removeClass('text-danger');
        })
}
if ($('.datepickeryearmonth').length > 0) {
    $('.datepickeryearmonth').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        autoUpdateInput: true,
        minDate: moment(),
        locale: {
            format: 'YYYY/MM'
        }
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-time").hide();
    }).on('change.daterangepicker', function (ev, picker) {
        $('.datepickeryearmonth').parent().parent().find('.input-danger').remove()
        $('.datepickeryearmonth').parent().parent().removeClass('text-danger')
    });
}
if ($('.year-picker').length > 0) {
    $('.year-picker').datetimepicker({ format: 'YYYY' })
        .on('dp.show', function () {
            //$('.date-picker-fixed').height($('.bootstrap-datetimepicker-widget .list-unstyled').height())
        })
        .on('dp.change', function (e) {
            $(this).blur()
            $(this).parent().siblings('.input-danger').remove();
            $(this).parent().parent().removeClass('text-danger');
        })
}

if ($('.datepickermax').length > 0) {
    $('.datepickermax').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        maxDate: moment(),
        locale: {
            format: 'DD-MM-YYYY'
        }
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-time").hide();
    }).on('change.daterangepicker', function (ev, picker) {
        $('.datepickermax').parent().parent().find('.input-danger').remove()
        $('.datepickermax').parent().parent().removeClass('text-danger')
    });
}
if ($('.datetimepicker').length > 0) {

    $('.datetimepicker').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        showDropdowns: true,
        autoApply: true,
        autoUpdateInput: true,
        showButtonPanel: false,
        minDate: moment(),
        locale: {
            format: 'DD-MM-YYYY h:mm a'
        }
    }).on('change.daterangepicker', function (ev, picker) {
        $('.datetimepicker').parent().parent().find('.input-danger').remove()
        $('.datetimepicker').parent().parent().removeClass('text-danger')
    });
}
if ($('.timepicker').length > 0) {
    $('.timepicker').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        showDropdowns: true,
        autoUpdateInput: true,
        locale: {
            format: 'h:mm a'
        }
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-table").hide();
    }).on('change.daterangepicker', function (ev, picker) {
        $('.timepicker').parent().parent().find('.input-danger').remove()
        $('.timepicker').parent().parent().removeClass('text-danger')
    });
}

function datepicker(date = '', type = 'hotel') {
    date = decodeURIComponent(date);
    from = to = '';
    if (date != '') {
        date = date.split('-');
        from = date[0].trim();
        to = date[1].trim();
    }
    if (from == '') {
        var currentDate = new Date();
    }
    else {
        var currentDate = new Date(from);
    }

    if (to == '') {
        var nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    }
    else {
        var nextDay = new Date(to);
    }
    var day = nextDay.getDate()
    var month = nextDay.getMonth() + 1
    var year = nextDay.getFullYear()
    next_date = day + '-' + month + '-' + year;


    var day = currentDate.getDate()
    var monthpluseone = currentDate.getMonth() + 2
    var year = currentDate.getFullYear()
    max_date = day + '-' + monthpluseone + '-' + year;

    $('#' + type + 'from_date').daterangepicker({
        singleDatePicker: true,
        minDate: moment(),
        showDropdowns: true,
        autoUpdateInput: true,
        startDate: currentDate,
        endDate: false,
        linkedCalendars: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    },
        function (start, end, label) {
            setTimeout(function () {
                var nextDay = new Date(new Date(start).getTime() + 24 * 60 * 60 * 1000);
                var day = nextDay.getDate()
                var month = nextDay.getMonth() + 1

                var year = nextDay.getFullYear()
                next_date = day + '-' + month + '-' + year;

                var star_date = new Date(start);
                var day = star_date.getDate()
                var month = star_date.getMonth() + 1
                var monthpluseone = star_date.getMonth() + 2
                var year = star_date.getFullYear()
                max_date = monthpluseone + '/' + day + '/' + year;
                star_date = day + '-' + month + '-' + year;
                if ($('#' + type + 'to_date').length > 0) {
                    $('#' + type + 'to_date').daterangepicker({
                        singleDatePicker: true,
                        minDate: next_date,
                        showDropdowns: true,
                        autoUpdateInput: true,
                        startDate: next_date,
                        endDate: false,
                        linkedCalendars: true,
                        locale: {
                            format: 'DD-MM-YYYY'
                        }
                    },
                        function (start, end, label) {
                            var star_date = new Date(start);
                            var day = star_date.getDate()
                            var month = star_date.getMonth() + 1
                            var year = star_date.getFullYear()
                            star_date = month + '/' + day + '/' + year;

                            $('#' + type + 'to_date_hidden').val(star_date)


                        });
                }
            }, 500)
        });

    if ($('#' + type + 'to_date').length > 0) {
        $('#' + type + 'to_date').daterangepicker({
            singleDatePicker: true,
            minDate: next_date,
            showDropdowns: true,
            autoUpdateInput: true,
            startDate: next_date,
            endDate: false,
            linkedCalendars: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        },
            function (start, end, label) {
            });
    }
}
function click_btn(id) {
    $(id).click()
}
function active_tab(id) {
    $('.nav-tabs a[href="' + id + '"]').tab('show')
}
function removeClas(id, cls, child = '') {
    if (child == '') {
        $(id).removeClass(cls)
    }
    else {
        $(id).find(child).removeClass(cls)
    }
}
function addClas(id, cls, child = '') {
    if (child == '') {
        $(id).addClass(cls)
    }
    else {
        $(id).find(child).addClass(cls)
    }
}
function clear_btn_hide(fun) {

    if ($('.find').val().length > 0) {
        $('.clear_in').removeClass('hidden')
    } else {
        if ($('#filter_inner').hasClass('hidden')) {
            window[fun]()
        } else {
            apply_search()
        }
        $('.clear_in').addClass('hidden')
    }
}
function clear_input() {

    $('.find').val('');
    $('.clear_in').addClass('hidden')
    if ($('#filter_inner').hasClass('hidden')) {
        apply_search()
    } else {
        apply_search()
    }
}
function show_tooltip(event, data) {
    if (data.trim() != '') {
        var x = event.clientX;
        var y = event.clientY;
        $('body').append('<div class="tooltips" style="width:auto">' + data + '</div>')
        $('body .tooltips').css({ 'left': x, 'top': y, 'position': 'fixed' })
    }
}
function hide_tooltip(event) {
    $('body .tooltips').remove()
}
function change_text(val, id) {
    $(id).html(val)
}
function change_password() {

    $.ajax({
        url: baseurl + 'login.php',
        type: "POST",
        async: true,
        data: "req=4&id=" + localStorage.getItem("user_id_enquiry").trim() + "&" + decodeURIComponent($("#change_password").find('select, textarea, input').serialize()),
        success: function (data) {
            show_toast('Password Updated Successfully', "success", '', "top", "success");
            $('#change_password').modal('hide')
        },
        error: function () {
        }

    });
}
function onenter(fun = '', parameter = '') {
    var key = event.keyCode || event.which;
    if (key == 13) {
        if (fun != '') {
            if (parameter == false) {
                window[fun]()
            } else {
                window[fun](parameter)
            }
        }
    }
}
function readFile(e, id) {
    if (!e.files || !e.files[0]) return;

    if (e.files[0].size / 1024 > 5 * 1024) {
        show_toast('File should be less than 5 MB', "danger", '', "top", "danger");
    }
    else {
        const FR = new FileReader();
        FR.addEventListener("load", function (evt) {
            data = evt.target.result.replace(/\+/g, 'plusssss');
            $(id).val(data);
            $(e).siblings('label').addClass('bg-success')
            $(e).parent().parent().find('.input-danger').remove()
            $(e).parent().parent().removeClass('text-danger')

        });
        FR.readAsDataURL(e.files[0]);
    }
}


function get_credit_data(id) {
    $.ajax({
        type: "POST",
        url: baseurl + 'KYC/get_credit_data',
        async: true,
        data: decodeURIComponent($('#addCredit').find('select, textarea, input').serialize()),
        success: function (html) {
            console.log(html)
            obj = JSON.parse(html);
            for ($i = 0; $i < Object.keys(obj[0]).length; $i++) {
                if (obj[0][Object.keys(obj[0])[$i]] == '0000-00-00') {
                    $('#addCredit input[name=' + Object.keys(obj[0])[$i] + ']').val('');
                    $('#addCredit input[name=' + Object.keys(obj[0])[$i] + ']').val('');
                }
                else if (Object.keys(obj[0])[$i] == 'verification_note') {
                    $('#addCredit textarea[name=' + Object.keys(obj[0])[$i] + ']').val(obj[0][Object.keys(obj[0])[$i]])
                }
                else {
                    $('#addCredit input[name=' + Object.keys(obj[0])[$i] + ']').val(obj[0][Object.keys(obj[0])[$i]])
                }
            }
        }
    });
}
function add_credit() {
    $.ajax({
        type: "POST",
        url: baseurl + 'KYC/addCredit',
        async: true,
        data: decodeURIComponent($('#addCredit').find('select, textarea, input').serialize()),
        success: function (html) {
            if (html.trim() == 'ok') {
                show_toast('Credit added successfully', "success", '', "top", "success");
                $('#addCredit').find('input[type=text]').val('')
                $('#addCredit').find('textarea').val('')
                $('#addCredit').find('input[type=hidden]').val('')
                $('#addCredit').modal('hide')
                var url = window.location.pathname;
                var filename = url.substring(url.lastIndexOf('/') + 1);
                if (filename == 'get_verified_document.html') {
                    apply_search()
                }
                else if (filename == 'get_document.html') {
                    get_data()
                }
            }
        }
    });
}
function get_kyc_form_data(id, table) {
    $.ajax({
        type: "POST",
        url: baseurl + 'KYC/get_kyc_form_data',
        async: true,
        data: decodeURIComponent($('#kyc_form').find('select, textarea, input').serialize()) + '&table=' + table,
        success: function (html) {
            console.log(html)
            obj = JSON.parse(html);
            for ($i = 0; $i < Object.keys(obj[0]).length; $i++) {
                if (obj[0][Object.keys(obj[0])[$i]] == '0000-00-00') {
                    $('#kyc_form input[name=' + Object.keys(obj[0])[$i] + ']').val('');
                    $('#kyc_form input[name=' + Object.keys(obj[0])[$i] + ']').val('');
                }
                else if (Object.keys(obj[0])[$i] == 'corporate_type' || Object.keys(obj[0])[$i] == 'company_type') {
                    if (obj[0][Object.keys(obj[0])[$i]].includes(',')) {
                        vals = obj[0][Object.keys(obj[0])[$i]].split(',')
                        for ($j = 0; $j < vals.length; $j++) {
                            $('#kyc_form input[type=' + $('#kyc_form [name=' + Object.keys(obj[0])[$i] + ']').attr('type') + '][value=\'' + vals[$j] + '\']').click()
                        }
                    }
                    else {
                        $('#kyc_form input[type=' + $('#kyc_form [name=' + Object.keys(obj[0])[$i] + ']').attr('type') + '][value=\'' + obj[0][Object.keys(obj[0])[$i]] + '\']').click()
                    }
                }
                else if (obj[0][Object.keys(obj[0])[$i]] == '0000') {
                    $('#kyc_form input[name=' + Object.keys(obj[0])[$i] + ']').val('');
                    $('#kyc_forma input[name=' + Object.keys(obj[0])[$i] + ']').val('');
                }
                else if (Object.keys(obj[0])[$i] == 'verification_note') {
                    $('#kyc_form textarea[name=' + Object.keys(obj[0])[$i] + ']').val(obj[0][Object.keys(obj[0])[$i]])
                }
                else {
                    $('#kyc_form input[name=' + Object.keys(obj[0])[$i] + ']').val(obj[0][Object.keys(obj[0])[$i]])
                }
            }
        }
    });
}
function get_remark(id, remark) {
    $('#createToken input[name=id]').val(id)
    $('#createToken input[name=remark]').val(remark)
}