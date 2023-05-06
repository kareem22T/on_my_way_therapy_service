// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': csrf_token
}
});
// end ...


// calllbacks and submit actions
$(document).on('click', '.slots ul li', function() {
    $(this).addClass('selected').siblings().removeClass('selected')
})

// on submit appointment
$('#confirm_appointment').on('click', function (e) {
    e.preventDefault();
    if($('.slots ul li.selected').length > 0) {
        let selected_slot = getDateInTimestapsFormat($(".event-date").text() + ', ' + $('.slots ul li.selected').text())
        $.ajax({
            url: '/client/appointment',
            method: 'POST',
            data: {
                doctor_id: $(this).attr('doctor_id'), 
                date: selected_slot, 
                visit_type: $('input[name=visit_type]').val()
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
    }
})

getAvilableSlotsByAjax(getDateInTimestapsFormat($('.event-date').text()))

$('.day').on('click', function () {
    $('.right').css('opacity', 0)
    getAvilableSlotsByAjax(getDateInTimestapsFormat($('.event-date').text()))
    setTimeout(() => {
        $('.right').css('opacity', 1)
    }, 1000);
})
// end ...


// methods ----------------------------------------------------------------
let start_work = parseInt($('.slots >div').attr('start'))
let end_work = parseInt($('.slots >div').attr('to'))

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

function getAvilableSlots(Hosted_slots_in_num) {
    // Define the working time interval
    const startTime = start_work * 60; // Start time in minutes (9:00 am)
    const endTime = end_work * 60; // End time in minutes (6:00 pm)
    const periodLength = 90; // Period length in minutes (1.5 hours)

    // Define the hosted periods to exclude
    const exclusionPeriods = [
        // { start: 10.5 * 60, end: 12 * 60 }, // 12:00 pm to 1:30 pm
        // { start: 15.25 * 60, end: 16.75 * 60 } // 3:15 pm to 4:45 pm
    ];

    for (let index = 0; index < Hosted_slots_in_num.length; index++) {
        const slot = Hosted_slots_in_num[index];
        exclusionPeriods.push({ start: slot * 60, end: (slot + 1.5) * 60})
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
    console.log("Available periods:");
    for (let i = 0; i < availablePeriods.length; i++) {
        const { start, end } = availablePeriods[i];
        const startTimeString = `${Math.floor(start / 60)}:${start % 60 < 10 ? '0' : ''}${start % 60}`;
        const endTimeString = `${Math.floor(end / 60)}:${end % 60 < 10 ? '0' : ''}${end % 60}`;
        console.log(`${i+1}. ${startTimeString} - ${endTimeString}`);
        $('.slots ul').append(`<li>${startTimeString}</li>`);
    }
}

function getAvilableSlotsByAjax(date) {
    $.ajax({
    url: '/client/slots_approved',
    method: 'POST',
    data: {doctor_id: $('#confirm_appointment').attr('doctor_id'), date: date},
    success: function (data) {
            let hosted_slots = [];
            for (let index = 0; index < data.length; index++) {
                const slot_date = data[index];
                hosted_slots.push(returnSlotTimeInNum(slot_date.date))
            }
            $('.slots ul').html(' ')
            getAvilableSlots(hosted_slots)
        }
    })
}

