const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  gotoBtn = document.querySelector(".goto-btn"),
  dateInput = document.querySelector(".date-input"),
  eventDay = document.querySelector(".event-day"),
  eventDate = document.querySelector(".event-date"),
  addEventBtn = document.querySelector(".add-event"),
  addEventWrapper = document.querySelector(".add-event-wrapper "),
  addEventCloseBtn = document.querySelector(".close "),
  addEventTitle = document.querySelector(".event-name "),
  addEventFrom = document.querySelector(".event-time-from "),
  addEventTo = document.querySelector(".event-time-to ")

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];
const eventsArr = [];

//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //check if event is present on that day
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      getActiveDay(i);
      if (event) {
        days += `<div class="day today active event">${i}</div>`;
      } else {
        days += `<div class="day today active">${i}</div>`;
      }
    } else {
      if (event) {
        days += `<div class="day event">${i}</div>`;
      } else {
        days += `<div class="day ">${i}</div>`;
      }
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}

//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//function to add active on day
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      getActiveDay(e.target.innerHTML);
      activeDay = Number(e.target.innerHTML);
      //remove active
      days.forEach((day) => {
        day.classList.remove("active");
      });
      //if clicked prev-date or next-date switch to that month
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //add active to clicked day afte month is change
        setTimeout(() => {
          //add active where no prev-date or next-date
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //add active to clicked day afte month is changed
        setTimeout(() => {
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else {
        e.target.classList.add("active");
      }
    });
  });
}

function gotoDate() {
  console.log("here");
  const dateArr = dateInput.value.split("/");
  if (dateArr.length === 2) {
    if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
      month = dateArr[0] - 1;
      year = dateArr[1];
      initCalendar();
      return;
    }
  }
  alert("Invalid Date");
}

//function get active day day name and date and update eventday eventdate
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

function convertTime(time) {
  //convert time to 24 hour format
  let timeArr = time.split(":");
  let timeHour = timeArr[0];
  let timeMin = timeArr[1];
  let timeFormat = timeHour >= 12 ? "PM" : "AM";
  timeHour = timeHour % 12 || 12;
  time = timeHour + ":" + timeMin + " " + timeFormat;
  return time;
}

function getWeekNumber(date) {
    var oneJan = new Date(date.getFullYear(), 0, 1);
    return Math.ceil((((date - oneJan) / 86400000) + oneJan.getDay() + 1) / 7);
}

var daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

// week calendar .......................................................................................
function getDayShort(date) {
  const dateString = date;
  const dateParts = dateString.split(" ");
  const day = dateParts[0];
  const month_1 = dateParts[1];
  const year_1 = dateParts[2];

  const date_1 = new Date(`${month_1} ${day}, ${year_1}`);
  const dayName = date_1.toLocaleDateString("en-US", { weekday: "short" });

  return dayName;
}

// let seven_days = $('.today').prev().nextAll()
// let date_now = new Date();

// // Use a for loop to get the next 7 days
// for (let w = 0; w < 7; w++) {
//   // Get the date as a string in the desired format
//   let dateString = date_now.toLocaleDateString('default', { month: 'long', year: 'numeric' });

//   let row = '\
//     <tr>\
//       <td>' + getDayShort(seven_days.eq(w).text()  + ' ' + dateString) +'</td>\
//       <td>' + seven_days.eq(w).text()  + ' ' + dateString + 
//       '</td>\
//       <td><span><i class="fa-solid fa-check"></i></span></td>\
//     </tr>'
//     $('.table tbody').append(row);

//     // Increment the date by 1 day
//     date_now.setDate(date_now.getDate() + 1);
// }

// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrf_token
    }
});
// end ...


// calllbacks and submit actions
$(function () {
    $('.loader').fadeOut()
})
$('.visit_type input:checked').next().addClass('selected');
$('.visit_type label').on('click', function () {
    $(this).addClass('selected')
    $(this).parents('.visit_type').siblings().find('label').removeClass('selected')
})

$(document).on('click', '.slots ul li', function () {
    $(this).addClass('selected').siblings().removeClass('selected')
})

$('.cancel').on('click', function () {
  $('.pop-up, .hide-content').fadeOut()
})

// on submit appointment
$('#confirm_appointment').on('click', function (e) {
    e.preventDefault();
    $('.address-pop-up').removeAttr('wait');
    $('.address-pop-up').removeAttr('date');
    $('.address-pop-up').removeAttr('time');
    $('.loader').fadeIn().css('display', 'flex');
    $.ajax({
      url: '/client/check/assessments',
      method: 'GET',
      success: function (data) {
        if (data.status == 419) {
          $('.assessment-pop-up').fadeIn().css('display', 'flex');
          $('.hide-content').fadeIn()
        } else {
          if ($('.slots ul li.selected').length > 0) {
              if ($('input[name=visit_type]:checked').val() == 0) {
                  $('.address-pop-up').fadeIn().css('display', 'flex');
                  $('.hide-content').fadeIn()
              } else {
                  let selected_slot = getDateInTimestapsFormat($(".event-date").text() + ', ' + $('.slots ul li.selected').text())
                  $('.loader').fadeIn().css('display', 'flex')
                  $.ajax({
                      url: '/client/appointment',
                      method: 'POST',
                      data: {
                          doctor_id: $(this).attr('doctor_id'),
                          date: selected_slot,
                          visit_type: $('input[name=visit_type]:checked').val()
                      },
                      success: function (data) {
                          if (data.status == 200) {
                              document.getElementById('errors').innerHTML = ''
                              let error = document.createElement('div')
                              error.classList = 'alert alert-success'
                              error.innerHTML = data.msg
                              document.getElementById('errors').append(error)
                              $('#errors').fadeIn('slow')
                              setTimeout(() => {
                                  location.replace(`/client/chats/${$('#confirm_appointment').attr('doctor_id')}`)
                              }, 1200);
                          }
                      }, error: function (err) {
                          document.getElementById('errors').innerHTML = ''
                          $.each(err.responseJSON.errors, function (key, value) {
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
              }
          } else {
                document.getElementById('errors').innerHTML = ''
                let error = document.createElement('div')
                error.classList = 'alert alert-danger'
                error.innerHTML = 'Please select a slot or join wait list'
                document.getElementById('errors').append(error)
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                    $('.loader').fadeOut()
                }, 2000);
          }
        }
      }
    })
})

$('#join_wait_list').on('click', function (e) {
    e.preventDefault();
    $('.loader').fadeIn().css('display', 'flex');
    $.ajax({
      url: '/client/check/assessments',
      method: 'GET',
      success: function (data) {
        if (data.status == 419) {
          $('.assessment-pop-up').fadeIn().css('display', 'flex');
          $('.hide-content').fadeIn()
          $('.loader').fadeOut()
        } else {
          $('.join-wait-list-pop-up, .hide-content').fadeIn().css('display', 'flex');
          $('.loader').fadeOut()
        }
      }
    })
})

$('.confirm-join-wait-list').on('click', function (e) {
  e.preventDefault();
  $('.loader').fadeIn().css('display', 'flex');
  if ($('input[name=visit_type]').val() == 1)
    $.ajax({
      url: '/client/appointment-wait',
      method: 'POST',
      data: {
          doctor_id: $('#join_wait_list').attr('doctor_id'),
          date: $('.join-wait-list-pop-up #date').val() + ' ' + $('.join-wait-list-pop-up #time').val(),
          visit_type: $('input[name=visit_type]:checked').val()
      },
      success: function (data) {
          if (data.status == 200) {
              document.getElementById('errors').innerHTML = ''
              let error = document.createElement('div')
              error.classList = 'alert alert-success'
              error.innerHTML = data.msg
              document.getElementById('errors').append(error)
              $('#errors').fadeIn('slow')
              setTimeout(() => {
                  $('#errors').fadeOut()
                  $('.join-wait-list-pop-up, .hide-content').fadeOut()
              }, 3000);
          }
      }, error: function (err) {
          document.getElementById('errors').innerHTML = ''
          $.each(err.responseJSON.errors, function (key, value) {
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
  else {
    $('.address-pop-up').attr('wait', true);
    $('.address-pop-up').attr('date', $('.join-wait-list-pop-up #date').val());
    $('.address-pop-up').attr('time', $('.join-wait-list-pop-up #time').val());
    $('.address-pop-up, .hide-content').fadeIn()
    $('.join-wait-list-pop-up').fadeOut()
    $('.loader').fadeOut()
  }
})

$('.confirm-appointment-address').on('click', function (e) {
    e.preventDefault()
    if (addressLat && addressLng) {
        $('.address-pop-up').fadeOut();
        $('.hide-content').fadeOut()
        $('#address_lat').val(addressLat)
        $('#address_lng').val(addressLng)
        $('#address').val($('#place-address').text())
        $('#address-a').text($('#place-address').text())
        $('.loader').fadeIn().css('display', 'flex')
        let selected_slot = getDateInTimestapsFormat($(".event-date").text() + ', ' + $('.slots ul li.selected').text())
        $.ajax({
            url: $('.address-pop-up').attr('wait') ? '/client/appointment-wait' : '/client/appointment',
            method: 'POST',
            data: {
                doctor_id: $('#confirm_appointment').attr('doctor_id'),
                date: $('.address-pop-up').attr('wait') ? $('.address-pop-up').attr('date') + ' ' + $('.address-pop-up').attr('time'): selected_slot,
                visit_type: $('input[name=visit_type]').val(),
                address: $('#address').val(),
                address_lat: $('#address_lat').val(),
                address_lng: $('#address_lng').val(),
            },
            success: function (data) {
                if (data.status == 200) {
                    document.getElementById('errors').innerHTML = ''
                    let error = document.createElement('div')
                    error.classList = 'alert alert-success'
                    error.innerHTML = data.msg
                    document.getElementById('errors').append(error)
                    $('#errors').fadeIn('slow')
                    if ( !$('.address-pop-up').attr('wait') )
                      setTimeout(() => {
                          location.replace(`/client/chats/${$('#confirm_appointment').attr('doctor_id')}`)
                      }, 1200);
                    else 
                      setTimeout(() => {
                        $('#errors').fadeOut()
                      }, 3000);
                }
            }, error: function (err) {
                document.getElementById('errors').innerHTML = ''
                $.each(err.responseJSON.errors, function (key, value) {
                    let error = document.createElement('div')
                    error.classList = 'alert alert-danger'
                    error.innerHTML = value[0]
                    document.getElementById('errors').append(error)
                });
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                    $('.loader').fadeOut()
                }, 2000);
            }
        })

    } else {
        document.getElementById('errors').innerHTML = ''
        let error = document.createElement('div')
        error.classList = 'alert alert-danger'
        error.innerHTML = 'Please pick your address !'
        document.getElementById('errors').append(error)
        $('#errors').fadeIn('slow')
        setTimeout(() => {
            $('#errors').fadeOut('slow')
        }, 2500);
    }
})
$('.confirm-appointment-address-old').on('click', function (e) {
    e.preventDefault()
    if ($('.slots ul li.selected').length > 0 || $('.address-pop-up').attr('wait')) {
        $('.address-pop-up').fadeOut();
        $('.hide-content').fadeOut()
        $('.loader').fadeIn().css('display', 'flex')
        let selected_slot = getDateInTimestapsFormat($(".event-date").text() + ', ' + $('.slots ul li.selected').text())
        $.ajax({
            url: $('.address-pop-up').attr('wait') ? '/client/appointment-wait' : '/client/appointment',
            method: 'POST',
            data: {
                doctor_id: $('#confirm_appointment').attr('doctor_id'),
                date: $('.address-pop-up').attr('wait') ? $('.address-pop-up').attr('date') + ' ' + $('.address-pop-up').attr('time'): selected_slot,
                visit_type: $('input[name=visit_type]').val(),
                address: $('#address').val(),
                address_lat: $('#address_lat').val(),
                address_lng: $('#address_lng').val(),
            },
            success: function (data) {
                if (data.status == 200) {
                    document.getElementById('errors').innerHTML = ''
                    let error = document.createElement('div')
                    error.classList = 'alert alert-success'
                    error.innerHTML = data.msg
                    document.getElementById('errors').append(error)
                    $('#errors').fadeIn('slow')
                    if ( !$('.address-pop-up').attr('wait') )
                      setTimeout(() => {
                          location.replace(`/client/chats/${$('#confirm_appointment').attr('doctor_id')}`)
                      }, 1200);
                    else 
                      setTimeout(() => {
                        $('#errors').fadeOut()
                        $('.loader').fadeOut()
                    }, 3000);
                }
            }, error: function (err) {
                document.getElementById('errors').innerHTML = ''
                $.each(err.responseJSON.errors, function (key, value) {
                    let error = document.createElement('div')
                    error.classList = 'alert alert-danger'
                    error.innerHTML = value[0]
                    document.getElementById('errors').append(error)
                });
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                    $('.loader').fadeOut()
                }, 2000);
            }
        })

    } else {
        document.getElementById('errors').innerHTML = ''
        let error = document.createElement('div')
        error.classList = 'alert alert-danger'
        error.innerHTML = 'Please choose your sutiable slot !'
        document.getElementById('errors').append(error)
        $('#errors').fadeIn('slow')
        setTimeout(() => {
            $('#errors').fadeOut('slow')
        }, 2500);
    }
})

getAvilableSlotsByAjax(getDateInTimestapsFormat($('.event-date').text()))

$('.day:not(.today)').on('click', function () {
    $('.right').css('opacity', 0)
    const targetDate = new Date(getDateInTimestapsFormat($('.event-date').text()));
    const currentDate = new Date();

    if (targetDate < currentDate) {
        console.log('Not avilable');
        $('.slots ul').html('Not avilable Slots')
    } else {
        getAvilableSlotsByAjax(getDateInTimestapsFormat($('.event-date').text()))
    }
    setTimeout(() => {
        $('.right').css('opacity', 1)
    }, 1000);

})

$('.today').on('click', function () {
    $('.right').css('opacity', 0)
    getAvilableSlotsByAjax(getDateInTimestapsFormat($('.event-date').text()))
    setTimeout(() => {
        $('.right').css('opacity', 1)
    }, 1000);

})

// end ...


// methods ----------------------------------------------------------------
function getDateInTimestapsFormat(dateString) {
    let date = new Date(dateString);
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let day = String(date.getDate()).padStart(2, '0');
    let year = date.getFullYear();
    let hours = String(date.getHours()).padStart(2, '0');
    let minutes = String(date.getMinutes()).padStart(2, '0');
    let seconds = String(date.getSeconds()).padStart(2, '0');
    let convertedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    return convertedDate;
}

function returnSlotTimeInNum(date) {
    const slot_to_date = new Date(date);
    const timeInHours = slot_to_date.getHours() + (slot_to_date.getMinutes() / 60);
    return parseFloat(timeInHours);
}

function getAvilableSlots(Hosted_slots_in_num, start_work, end_work) {
    // Define the working time interval
    let startTime;
    let dayDate = new Date(getDateInTimestapsFormat($('.event-date').text()))
    let formattedDayDate =
        dayDate.getFullYear() + '-' + (dayDate.getMonth() + 1) + '-' + dayDate.getDate();

    let todayDate = new Date()
    let formattedTodayDate =
        todayDate.getFullYear() + '-' + (todayDate.getMonth() + 1) + '-' + todayDate.getDate();

    if (
        formattedDayDate === formattedTodayDate &&
        parseInt(start_work) < returnSlotTimeInNum(Date.now())
    ) {
        startTime =
            Math.round(returnSlotTimeInNum(Date.now())) <= Math.floor(returnSlotTimeInNum(Date.now())) ?
                (Math.round(returnSlotTimeInNum(Date.now())) + 0.5) * 60 :
                Math.round(returnSlotTimeInNum(Date.now())) * 60; // Start time in minutes (9:00 am)
    } else {
        startTime = start_work * 60; // Start time in minutes (9:00 am)
    }
    const endTime = end_work * 60; // End time in minutes (6:00 pm)
    const periodLength = 90; // Period length in minutes (1.5 hours)

    // Define the hosted periods to exclude
    const exclusionPeriods = [
        // { start: 10.5 * 60, end: 12 * 60 }, // 12:00 pm to 1:30 pm
        // { start: 15.25 * 60, end: 16.75 * 60 } // 3:15 pm to 4:45 pm
    ];

    for (let index = 0; index < Hosted_slots_in_num.length; index++) {
        const slot = Hosted_slots_in_num[index];
        exclusionPeriods.push({ start: slot * 60, end: (slot + 1.5) * 60 })
    }

    // Define a function to check if a time period is excluded
    function isExcluded(start, end) {
        for (let i = 0; i < exclusionPeriods.length; i++) {
            if (start < exclusionPeriods[i].end && end > exclusionPeriods[i].start) {
                // There is overlap with an exclusion period
                return true;
            }
        }
        // No overlap with any exclusion period
        return false;
    }

    // Calculate the available periods
    const availablePeriods = [];
    for (let start = startTime; start < endTime; start += periodLength) {
        const end = start + periodLength;
        if (!isExcluded(start, end)) {
            availablePeriods.push({ start, end });
        }
    }

    // Display the available periods
    // console.log("Available periods:");
    for (let i = 0; i < availablePeriods.length; i++) {
        const { start, end } = availablePeriods[i];
        const startTimeString = `${Math.floor(start / 60)}:${start % 60 < 10 ? '0' : ''}${start % 60}`;
        const endTimeString = `${Math.floor(end / 60)}:${end % 60 < 10 ? '0' : ''}${end % 60}`;
        // console.log(`${i + 1}. ${startTimeString} - ${endTimeString}`);
        $('.slots ul').append(`<li>${startTimeString}</li>`);
    }
}

function getAvilableSlotsByAjax(date) {
    $.ajax({
        url: '/client/slots_approved',
        method: 'POST',
        data: { doctor_id: $('#confirm_appointment').attr('doctor_id'), date: date },
        success: function (data) {
            let hosted_slots = [];
            for (let index = 0; index < data.length; index++) {
                const slot_date = data[index];
                hosted_slots.push(returnSlotTimeInNum(slot_date.date))
            }
            $('.slots ul').html(' ')
            $.ajax({
              url: '/client/get_slots',
              method: 'POST',
              data: {therapist_id: $('#confirm_appointment').attr('doctor_id'), date: date },
              success: function (data) {
                getAvilableSlots(hosted_slots, parseInt(data.start_time), parseInt(data.end_time))
              }
            })
        }
    })
}



