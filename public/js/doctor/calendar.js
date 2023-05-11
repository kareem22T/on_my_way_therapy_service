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