$('.notification').on('click', function (e) {
    e.preventDefault();
    if ($('.notification-wrapper ul').is(':visible'))
        $('.notification-wrapper ul').fadeOut().find('.dots').css('display', 'flex')
    else
    $('.notification-wrapper ul').fadeIn().css('display', 'flex')
    $.ajax({
        url: '/get-notifications',
        method: 'get',
        success: function (data) {
            $('.notification-wrapper ul').find('li').remove()
            if (data.length > 0)
                data.forEach(notification => {
                    if (notification.content.startsWith("appointment")) 
                    $.ajax({
                        url: '/get-notifications-appointment',
                        method: "POST",
                        data: {appointmetn_id: parseInt(notification.content.split(":")[1])},
                        success: function (appointment) {
                            const now = new Date();
                            const formatter = new Intl.DateTimeFormat('en-US', {
                                month: 'numeric',
                                day: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                            });
                            $('.notification-wrapper ul').find('.dots').css('display', 'none')
                            if (appointment)
                                $('.notification-wrapper ul').append('\
                                    <li>\
                                        <div class="img">\
                                            <img src="/imgs/doctor/uploads/therapist_profile/1_profile_picture.png" alt="client img">\
                                        </div>\
                                        <div>\
                                            <h1>\
                                                ' + appointment.doctor.first_name + ' ' + appointment.doctor.last_name +
                                                (appointment.journey >= 4 ? '\
                                                <span class="rate">\
                                                    <div class="form-group">\
                                                        <input type="radio" name="rate" id="rate_5" value="5">\
                                                        <label for="rate_5"><i class="fa-solid fa-star"></i></label>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <input type="radio" name="rate" id="rate_4" value="4">\
                                                        <label for="rate_4"><i class="fa-solid fa-star"></i></label>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <input type="radio" name="rate" id="rate_3" value="3">\
                                                        <label for="rate_3"><i class="fa-solid fa-star"></i></label>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <input type="radio" name="rate" id="rate_2" value="2">\
                                                        <label for="rate_2"><i class="fa-solid fa-star"></i></label>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <input type="radio" name="rate" id="rate_1" value="1">\
                                                        <label for="rate_1"><i class="fa-solid fa-star"></i></label>\
                                                    </div>\
                                                </span>' : '') + 
                                            '</h1>\
                                            <span>' + new Date(appointment.date).toLocaleString('default', { month: 'long', day: 'numeric' }) + ', ' + 
                                            new Date(new Date(appointment.date).getTime()).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) + 
                                            '</span>\
                                            <div class="steps">\
                                                <div class="step-1 ' + (appointment.journey >= 1 ? 'done' : '') + '">\
                                                    <span>1</span>\
                                                    Approved\
                                                </div>\
                                                <div class="step-2 ' + (appointment.journey >= 2 ? 'done' : '') + '">\
                                                    <span>2</span>\
                                                    On his way\
                                                </div>\
                                                <div class="step-3 ' + (appointment.journey >= 3 ? 'done' : '') + '">\
                                                    <span>3</span>\
                                                    Arrived\
                                                </div>\
                                                <div class="step-4 ' + (appointment.journey >= 4 ? 'done' : '') + '">\
                                                    <span>4</span>\
                                                    Completed\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </li>\
                                ')
                                seenNoti()
                        }
                    })
                });
            else
                $('.notification-wrapper ul').find('.dots').css('display', 'none').parents('ul').append('<li class="no">No notification !</li>')
        },
    })
})

getUnseenNotifications()
function getUnseenNotifications() {
    $.ajax({
        url: '/get-unseen-notification',
        method: 'GET',
        success: function (num) {
            if (num > 0) 
                $('.num-noti').removeClass('no')
            else
                $('.num-noti').addClass('no')
        }
    })
}
function seenNoti() {
    $.ajax({
        url: '/seen-notification',
        method: 'GET',
        success: function () {
            getUnseenNotifications()
        }
    })
}

$(document).on('click', '.rate i', function() {
    $(this).css('color', '#132F75').parents('.form-group').nextAll().find('i').css('color', '#132F75')
    $(this).css('color', '#132F75').parents('.form-group').prevAll().find('i').css('color', 'gray')
})

