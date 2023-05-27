
// set works time
let holidays = [];
$('#holidays').on('change', function () {
  if ($.inArray($(this).find('option:selected').val(), holidays) == -1 ) {
    if (holidays.length < 3) {
        $('.holidays').append('<li val="' + $(this).find('option:selected').val() + '">' 
                              + $(this).find('option:selected').text() + 
                              '<i class="fa-regular fa-circle-xmark"></i></li>');
      holidays.push($(this).find('option:selected').val());
      $(this).val('')
    } else {
      alert('you can choose max 3 days holidays')
      $(this).val('')
    }
  } else {
      $(this).val('')
  }
})

$(document).on('click', '.holidays i',  function () {
  holidays = holidays.filter((value) => value != $(this).parent().attr('val'));
  $(this).parent().remove()
})

// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...

$('#working_hours').on('submit', function (e) {
  e.preventDefault();
  $.ajax({
    url: '/therapist/save-times',
    method: 'POST',
    data: {holidays_arr: holidays, from: $('select[name="from"]').val(), to: $('select[name="to"]').val(), distance: $('select[name="distance"]').val()},
    success: function (data) {
      if (data.status == 200) {
          document.getElementById('errors').innerHTML = ''
          let error = document.createElement('div')
          error.classList = 'alert alert-success'
          error.innerHTML = data.msg
          document.getElementById('errors').append(error)
          $('#errors').fadeIn('slow')
          setTimeout(() => {
              location.reload()
          }, 1200);
      }
    }, error: function (err) {
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
        }, 2000);
    }
  })
})

$('.set-hours').on('click', function () {
  $.ajax({
    url: '/therapist/edit-times',
    method: 'POST',
    data: {from: $('#from').val(), to: $('#to').val()},
    success: function (data) {
      if (data.status == 200) {
          document.getElementById('errors').innerHTML = ''
          let error = document.createElement('div')
          error.classList = 'alert alert-success'
          error.innerHTML = data.msg
          document.getElementById('errors').append(error)
          $('#errors').fadeIn('slow')
          setTimeout(() => {
              location.reload()
          }, 1200);
      }
      }, error: function (err) {
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
          }, 2000);
      }
  })
})
$('.set-distance').on('click', function () {
  $.ajax({
    url: '/therapist/edit-times',
    method: 'POST',
    data: {distance: $('#distance').val()},
    success: function (data) {
      if (data.status == 200) {
          document.getElementById('errors').innerHTML = ''
          let error = document.createElement('div')
          error.classList = 'alert alert-success'
          error.innerHTML = data.msg
          document.getElementById('errors').append(error)
          $('#errors').fadeIn('slow')
          setTimeout(() => {
              location.reload()
          }, 1200);
      }
      }, error: function (err) {
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
          }, 2000);
      }
  })
})
$('.set-holidays').on('click', function () {
  $.ajax({
    url: '/therapist/edit-times',
    method: 'POST',
    data: {holidays_arr: holidays},
    success: function (data) {
      if (data.status == 200) {
          document.getElementById('errors').innerHTML = ''
          let error = document.createElement('div')
          error.classList = 'alert alert-success'
          error.innerHTML = data.msg
          document.getElementById('errors').append(error)
          $('#errors').fadeIn('slow')
          setTimeout(() => {
              location.reload()
          }, 1200);
      }
      }, error: function (err) {
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
          }, 2000);
      }
  })
})



$('#edit-hours').on('click', function (e) {
  e.preventDefault();
  $('.edit_hours_pop_up').fadeIn()
  $('.hide-content').fadeIn()
})

$('#edit-distance').on('click', function (e) {
  e.preventDefault();
  $('.edit_distance_pop_up').fadeIn()
  $('.hide-content').fadeIn()
})

$('#edit-holidays').on('click', function (e) {
  e.preventDefault();
  $('.edit_holidays_pop_up').fadeIn()
  $('.hide-content').fadeIn()
})

$('.cancel').on('click', function (e) {
  e.preventDefault();
  $('.pop-up').fadeOut()
  $('.hide-content').fadeOut()
})

$('.appointments tr').on('click', function (e) {
  woindow.open('/therapist/appointment/'.$(this).attr('id'), '_blank')
})