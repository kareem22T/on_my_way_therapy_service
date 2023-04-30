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
// end ...

// methods
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

    var channel = pusher.subscribe('chat-channel_1_' + $('#guard_type').val());
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
        if (data.message != 'seen') {
            notifyMe(data.message)
            setUnseenNum()
            setUnseenNumPerChat()
            $('.msgs ul')
            .append('<li class="their-msg">' + data.message + '<span>' + formattedDate + '</span>' + '</li>');
            scrollBottom ()
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
            // …
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