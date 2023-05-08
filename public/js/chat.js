// set csrf token for all requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// end ...
// on submit and callback methodes
$('#send').on('submit', function(e) {
    e.preventDefault();
    if ($('#msg').val() != '') {
        const now = new Date();
        const formatter = new Intl.DateTimeFormat('en-US', {
          month: 'numeric',
          day: 'numeric',
          hour: 'numeric',
          minute: 'numeric',
          hour12: true
        });

        const formattedDate = formatter.format(now);
        $('.msgs ul')
        .append('<li class="your-msg">' + $('#msg').val() + '<span>' + formattedDate + 
        ' <i class="fa-solid fa-spinner"></i></span>' + '</li>');
        sendMsg()
        scrollBottom()
        $('#msg').val('')
    }
})

$('#msg').on('focus', function () {
  seenMsgs()
})

getMsg()
if ($('#msg').is(':visible')) {
  seenMsgs()
}

scrollBottom()

$(document).on('click', '.approve-appointment', function () {
  approveAppointment ($(this).attr('appointment_id'))
    $(this).parents('li').find('.status .approve').fadeIn()
    $(this).parent('.controls').remove()
})

$(document).on('click', '.accept_change', function () {
    acceptAppointment(
      $(this).attr('appointment_id'), 
      $(this).parents('li').find('p').text(),
      $(this).attr('msg_id')
    )
    $(this).parents('li').find('p').nextAll('.btns').remove()
    $(this).parents('li').find('p').append('<span class=accepted> Accepted !</span>')
})

$(document).on('click', '.edit-date', function () {
  $(this).siblings('.set-date').fadeToggle()
  if ($(this).siblings('.set-date').is(':visible'))
    $(this).siblings('.set-date').css('display', 'flex')
})

$(document).on('click', 'input[name=submit_new_date]', function (e) {
  e.preventDefault()
  editAppointmentDate(
    $(this).prev().val(), 
    $(this).attr('appointment_id'), 
    $(this).parents('.controls').find('.edit-date').attr('client_id'), 
    $(this).parents('.controls').find('.edit-date').attr('doctor_id')
  )
  $(this).parents('li').find('.status .pending').fadeIn()
  $(this).parents('.controls').remove()
})

$('.msgs').on('click', function () {
  if ($('#msg').is(':visible'))
    seenMsgs()
})
// end ...

// methods ..............................................
function sendMsg() {
    let formData = new FormData(document.getElementById('send'));
      const now = new Date();
      const formatter = new Intl.DateTimeFormat('en-US', {
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
      });

      const formattedDate = formatter.format(now);

    formData.append('created_at', formattedDate);

    $.ajax({
        url: '/send-msg',
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.status == 200) {
              $('.msgs ul li:last-child span i').removeClass('fa-spinner').addClass('fa-check')
            }
        },
        error: function(err) {
              $('.msgs ul li:last-child span i').removeClass('fa-spinner').addClass('fa-triangle-exclamation')
            // document.getElementById('errors').innerHTML = ''
			// $.each(err.responseJSON.errors, function(key, value) {
			// 	let error = document.createElement('div')
			// 	error.classList = 'alert alert-danger'
			// 	error.innerHTML = value[0]
			// 	document.getElementById('errors').append(error)
			// });
			// $('#errors').fadeIn('slow')
			// setTimeout(() => {
			// 	$('#errors').fadeOut('slow')
			// }, 2000);
        }
    })
}

function seenMsgs() {
    let formData = new FormData(document.getElementById('send'));

    $.ajax({
        url: '/seen',
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          setUnseenNum()
        },
        error: function(err) {
        }
    })
}

function getMsg() {
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('0da4a48ffa1ea15dc786', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('chat-channel_' + 
    $('input[name=pusher_channel_data]').attr('id') + '_' + 
    $('input[name=pusher_channel_data]').attr('guard_type'));
    channel.bind('chat-event', function(data) {
        const objData = data['message'];
        const now = new Date();
        const formatter = new Intl.DateTimeFormat('en-US', {
          month: 'numeric',
          day: 'numeric',
          hour: 'numeric',
          minute: 'numeric',
          hour12: true
        });

        const formattedDate = formatter.format(now);
        if (data.message != 'seen' && !data.message.startsWith("appointment")) {
            notifyMe(data.message)
            setUnseenNum()
            setUnseenNumPerChat()
            $('.msgs ul')
            .append('<li class="their-msg">' + data.message + '<span>' + formattedDate + '</span>' + '</li>');
            scrollBottom ()
        } else if (data.message.startsWith("appointment")) {
            const appointmetn_id = parseInt(data.message.split(':')[1]);
            $.ajax({
              url: '/get-appointment',
              method: "POST",
              data: {appointmetn_id: appointmetn_id},
              success: function (appointment) {
                const date = new Date(appointment.date);
                const options = { day: 'numeric', month: 'short' };
                const formattedDate = date.toLocaleDateString('en-US', options);

                const dateTime = new Date(date);
                const formattedTime = dateTime.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });

                $('.msgs ul')
                .append('\
                    <li class="their-msg">\
                      <h4>Appointment</h4>\
                      <div class="profile">\
                          <div class="img">\
                              <img src="/imgs/client/uploads/client_profile/default_client_profile.jpg" alt="">\
                          </div>\
                          <div class="name">\
                              <h6>' + appointment.client.first_name + '</h6>\
                              <h6>' + appointment.client.last_name + '</h6>\
                          </div>\
                          <div class="genderYage">\
                              <span>' + appointment.client.gender + '</span>\
                              <span>' + calculateAge(appointment.client.dob) + '</span>\
                          </div>\
                      </div>\
                      <div class="date">\
                          <span>' + formattedDate + '</span>\
                          <span>' + formattedTime + '</span>\
                      </div>\
                      <div class="address">\
                          <span>' + appointment.client.address + '</span>\
                          <span>15 km in 5 min</span>\
                      </div>\
                      <div class="controls">\
                        <button \
                        class="edit-date" \
                        appointment_date="' + appointment.date + '" \
                        client_id="' + appointment.client_id + '"\
                        doctor_id="' + appointment.doctor_id + '">\
                          <i class="fa-solid fa-calendar-days"></i>\
                        </button>\
                        <button class="approve-appointment" appointment_id="' + appointment.id + '"><i class="fa fa-check"></i></button>\
                        <div class="set-date">\
                            <input type="datetime-local" name="new_date" id="new_date">\
                            <input type="submit" name="submit_new_date" appointment_id="' + appointment.id + '" value="Set date">\
                        </div>\
                      </div>\
                      <div class="status">\
                          <div class="approve">Session Approved !</div>\
                          <div class="pending" style="color: gray; ">Session pending !</div>\
                      </div>\
                      <span>' + formattedDate + '</span>\
                  </li>');

                notifyMe('Appointment by: ' + appointment.client.first_name)
                setUnseenNum()
                setUnseenNumPerChat()
                scrollBottom ()
              }
            })

        } else {
          $('.msgs ul li span i').removeClass('fa-check').addClass('fa-check-double')
        }
    });

    function notifyMe(msg) {
      if (!("Notification" in window)) {
        // Check if the browser supports notifications
        alert("This browser does not support desktop notification");
      } else if (Notification.permission === "granted") {
        // Check whether notification permissions have already been granted;
        // if so, create a notification
        const notification = new Notification(msg);
        // …
      } else if (Notification.permission !== "denied") {
        // We need to ask the user for permission
        Notification.requestPermission().then((permission) => {
          // If the user accepts, let's create a notification
          if (permission === "granted") {
            const notification = new Notification(msg);
          }
        });
      }

      // At last, if the user has denied notifications, and you
      // want to be respectful there is no need to bother them anymore.
    }
}

function setUnseenNum() {
  $.ajax({
    url: '/get-unseen',
    method: 'GET',
    success: function(data) {
      $('header .container nav ul li span').text(data)
      $('header .container nav ul li span').css('display', data > 0 ? 'flex' : 'none')
      $('title').text($('title').text().replace(/[0-9]/g, ""))
      $('title').text($('title').text().replace('()', '(' + data + ')'))
    },
  })
}
function setUnseenNumPerChat() {
  $('.chat_link').each(function() {
    let chat_id = $(this).attr('chat_id')
    $.ajax({
      url: '/get-unseen-per-chat',
      method: 'POST',
      data: {chat_id:  $(this).attr('chat_id'), sender_guard: $(this).attr('sender_guard')},
      success: function (data) {
        $('.chat_link[chat_id="' + chat_id + '"]').find('>span').text(data).css('display', data > 0 ? 'flex' : 'none')
      }
    })
  })
}

function scrollBottom () {
  $('.msgs').animate({
    scrollTop: 1000000000000000000000000000000
  }, 10); // 1000 is the animation duration in milliseconds

}

function calculateAge(dateOfBirth) {
  var dob = new Date(dateOfBirth);
  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  var birthYear = dob.getFullYear();
  var currentMonth = currentDate.getMonth() + 1;
  var birthMonth = dob.getMonth() + 1;
  var currentDay = currentDate.getDate();
  var birthDay = dob.getDate();

  var age = currentYear - birthYear;

  if (currentMonth < birthMonth || (currentMonth == birthMonth && currentDay < birthDay)) {
  age--;
  }

  return age;
}

function approveAppointment (appointment_id) {
  $.ajax({
    url: '/approve-appointment',
    method: 'POST',
    data: {id: appointment_id},
    success: function (data) {
      $('#msg').val(data.msg)
      $('#send').trigger('submit')
      if (data.status == 200)
        return true
    }
  })
}
function acceptAppointment (appointment_id, msg_content, msg_id) {
  $.ajax({
    url: '/accept-appointment',
    method: 'POST',
    data: {id: appointment_id, msg_content: msg_content, msg_id: msg_id},
    success: function (data) {
      $('#msg').val(data.msg)
      $('#send').trigger('submit')
      if (data.status == 200)
        return true
    }
  })
}

function editAppointmentDate(new_date, appointment_id, client_id, doctor_id) {
  $.ajax({
    url: '/edit-appointment',
    method: 'POST',
    data: {new_date: new_date, id: appointment_id, client_id: client_id, doctor_id: doctor_id},
    success: function (data) {
      if (data.status == 200) {
        const now = new Date();
        const formatter = new Intl.DateTimeFormat('en-US', {
          month: 'numeric',
          day: 'numeric',
          hour: 'numeric',
          minute: 'numeric',
          hour12: true
        });

        const formattedDate = formatter.format(now);
        $('.msgs ul')
        .append('<li class="your-msg">' + data.msg + '<span>' + formattedDate  + 
        ' <i class="fa-solid fa-spinner"></i></span>' + '</li>');
        setTimeout(() => {
          $('.msgs ul li:last-child span i').removeClass('fa-spinner').addClass('fa-check')
        }, 200);
        scrollBottom ()
        document.getElementById('errors').innerHTML = ''
        let error = document.createElement('div')
        error.classList = 'alert alert-success'
        error.innerHTML = data.notification
        document.getElementById('errors').append(error)
        $('#errors').fadeIn('slow')
        setTimeout(() => {
          $('#errors').fadeOut('slow')
        }, 2500);
        return true
      }
    },
    error: function (err) {
      document.getElementById('errors').innerHTML = ''
			$.each(err.responseJSON.errors, function(key, value) {
				let error = document.createElement('div')
				error.classList = 'alert alert-danger'
				error.innerHTML = value[0]
				document.getElementById('errors').append(error)
			});
			$('#errors').fadeIn('slow')
			setTimeout(() => {
				$('#errors').fadeOut('slow')
			}, 3500);

    }
  })
}