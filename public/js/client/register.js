// set csrf token for all requests
var csrf_token = $('meta[name="csrf-token"]').attr("content");

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": csrf_token,
    },
});
// end ...

let clients = []

// callback and submint actions
$(function () {
    $('input[type="radio"]:checked').each(function () {
        $(this).nextAll("label").addClass("active");
    });

    $(document).on("click", ".radio input", function () {
        $(this).next("label").addClass("active");
        $(this).parent().siblings().find("label").removeClass("active");
    });

    $(".services_inputs label").on("click", function () {
        $(this).toggleClass("active");
    });
    $(".services_inputs input:checked").each(function () {
        $(this).next("label").addClass("active");
        $(this).parent().siblings().find("label").removeClass("active");
    });

    $(document).on("click", 'label[for$="plan_managment_1"]', function () {
        $(this).parents('.additional-info').find(".plan-managed-form, .self-managed-form").fadeOut();
        $(this).parents('.additional-info').find(".agency-managed-form").fadeIn();
    });
    $(document).on("click", 'label[for$="plan_managment_2"]', function () {
        $(this).parents('.additional-info').find(".plan-managed-form").fadeIn();
        $(this).parents('.additional-info').find(".self-managed-form").fadeOut();
        $(this).parents('.additional-info').find(".agency-managed-form").fadeOut();
    });
    $(document).on("click", 'label[for$="plan_managment_3"]', function () {
        $(this).parents('.additional-info').find(".plan-managed-form").fadeOut("fast");
        $(this).parents('.additional-info').find(".self-managed-form").fadeIn().css("display", "grid");
        $(this).parents('.additional-info').find(".agency-managed-form").fadeOut();
    });

    $(document).on("click", 'label[for$="client_type_1"]', function () {
        $(this).parents('.additional-info').find(".ndis-form, .plan-managed-btns, .plan-managed-form").fadeOut();
        $(this).parents('.additional-info').find(".private-form, .paying-form").fadeIn().css("display", "grid");
        $(this).parents('.additional-info').find(".agency-managed-form").fadeOut();
    });

    $(document).on("click", 'label[for$="private_paying_method_2"]', function () {
        $(this).parents('.additional-info').find(".Private-health").fadeIn().css("display", "flex");
    });
    $(document).on("click", 'label[for$="private_paying_method_1"]', function () {
        $(this).parents('.additional-info').find(".Private-health").fadeOut();
    });

    $(document).on("click", 'label[for$="client_type_2"]', function () {
        $(this).parents('.additional-info').find(".ndis-form, .plan-managed-btns, .plan-managed-form")
            .fadeIn()
            .css("display", "grid");

        $(this).parents('.additional-info').find('label[for="plan_managment_2"]')
            .trigger("click")
            .addClass("active")
            .parent()
            .siblings()
            .find("label")
            .removeClass("active");

        $(this).parents('.additional-info').find('label[for="private_paying_method_1"]')
            .trigger("click")
            .addClass("active")
            .parent()
            .siblings()
            .find("label")
            .removeClass("active");

        $(this).parents('.additional-info').find(".private-form, .paying-form, .Private-health").fadeOut();
    });

    $(document).on("click", '.additional-info h1 .fa-close', function () {
        $(this).parents('.additional-info').remove();
    })

    $('.managed_client .add_client').on('click', function (e) {
        e.preventDefault();
        const clientForm = $('.managed_client .additional-info:first-child').clone();
        $('.clients_wrapper').append(clientForm)
        clientForm.find('>h1').html('Client <span>#' + (clientForm.parent().children().length) + '</span><i class="fa fa-close"></i>')
        
        clientForm.find('input, select').each(function() {
            let name = $(this).attr('name');
            let id = $(this).attr('id');

            if (name && id) {
                $(this).attr('name', name.replace(/(client_managed_)\d+/, "$1" + clientForm.parent().children().length));
                $(this).attr('id', id.replace(/(client_managed_)\d+/, "$1" + clientForm.parent().children().length));
            }

            $(this).not('[type="radio"]').val('')
        });
        
        clientForm.find('label').each(function() {
            let forAttr = $(this).attr('for');

            if (forAttr) {
                $(this).attr('for', forAttr.replace(/(client_managed_)\d+/, "$1" + clientForm.parent().children().length));
            }
        });

        $('.additional-info label.active').trigger('click');

    })
    $('#managed_clients_form').on('submit', function (e) {
        e.preventDefault();
        let i = 1
        clients = [];
        $('.clients_wrapper .additional-info').each(function () {
            let client = {};

            let first_name = $(`#client_managed_${i}_first_name`).val()
            let last_name = $(`#client_managed_${i}_last_name`).val()
            let dob = $(`#client_managed_${i}_dob`).val()
            let gender = $(`#client_managed_${i}_gender`).val()
            let client_type = i > 1 ? $(`input[name="client_managed_${i}_client_type"]:checked`).attr('value'): document.querySelector(`input[name="client_managed_${i}_client_type"]:checked`).value 
            let managment_type = i > 1 ? $(`input[name="client_managed_${i}_managment_type"]:checked`).attr('value') : document.querySelector(`input[name="client_managed_${i}_managment_type"]:checked`).value

            client.first_name = first_name
            client.last_name = last_name
            client.dob = dob
            client.gender = gender
            client.client_type = client_type
            client.managment_type = managment_type

            if (client_type == 1) {
                client.NDIS_number = $(this).find(`#client_managed_${i}_NDIS_number`).val()
                client.NDIS_end_date = $(this).find(`#client_managed_${i}_NDIS_end_date`).val()
                if (managment_type == 1) {
                    client.manager_email = $(this).find(`#client_managed_${i}_Plan_manager_email`).val()
                } else if (managment_type == 2) {
                    client.card_number = $(this).find(`#client_managed_${i}_card_number`).val()
                    client.name_on_card = $(this).find(`#client_managed_${i}_name_on_card`).val()
                    client.expiration_date = $(this).find(`#client_managed_${i}_expiration_date`).val()
                    client.security_code = $(this).find(`#client_managed_${i}_security_code`).val()
                }
            } else if (client_type == 0) {
                client.card_number = $(this).find(`#client_managed_${i}_card_number`).val()
                client.name_on_card = $(this).find(`#client_managed_${i}_name_on_card`).val()
                client.expiration_date = $(this).find(`#client_managed_${i}_expiration_date`).val()
                client.security_code = $(this).find(`#client_managed_${i}_security_code`).val()
            }

            clients.push(client)

            i++;
        })
        $(".loader").fadeIn().css("display", "flex");
        let formData = new FormData(document.getElementById("client_register"));
        $(".diagnosis li").each(function () {
            formData.append("diagnosis[]", $(this).text());
        });
        if (document.querySelector(`input[name="account_type"]:checked`).value == 1)
            clients.forEach((object, index) => {
                const jsonString = JSON.stringify(object);
                formData.append(`managed_clients[${index}]`, jsonString);
            });

        $.ajax({
            url: "/client/check-info",
            method: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                if (data.status == 200) {
                    sendCodes(
                        formData.get("countryCode"),
                        formData.get("phone"),
                        formData.get("email")
                    );
                }
            },
            error: function (err) {
                document.getElementById("errors").innerHTML = "";
                $.each(err.responseJSON.errors, function (key, value) {
                    let error = document.createElement("div");
                    error.classList = "alert alert-danger";
                    error.innerHTML = value[0];
                    document.getElementById("errors").append(error);
                });
                $("#errors").fadeIn("slow");
                $(".loader").fadeOut();
                setTimeout(() => {
                    $("#errors").fadeOut("slow");
                }, 5000);
            },
        });
    })
});

$("#photo").change(function () {
    // check if file is valid image
    var file = this.files[0];
    var fileType = file.type;
    var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
    if ($.inArray(fileType, validImageTypes) < 0) {
        document.getElementById("errors").innerHTML = "";
        let error = document.createElement("div");
        error.classList = "alert alert-danger";
        error.innerHTML =
            "Invalid file type. Please choose a GIF, JPEG, or PNG image.";
        document.getElementById("errors").append(error);
        $("#errors").fadeIn("slow");
        setTimeout(() => {
            $("#errors").fadeOut("slow");
        }, 2000);

        $(this).val(null);
        $("#preview").attr(
            "src",
            "/imgs/doctor/uploads/therapist_profile/default.png"
        );
        $(".photo_group label >i").fadeIn("fast");
        $(".photo_group .after i").removeClass("fa-edit").addClass("fa-plus");
    } else {
        // display image preview
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr("src", e.target.result);
            $(".photo_group .after i")
                .removeClass("fa-plus")
                .addClass("fa-edit");
            $(".photo_group label >i").fadeOut("fast");
        };
        reader.readAsDataURL(file);
    }
});

$(".add_diagnosis").on("click", function (e) {
    e.preventDefault();
    addDiagnosis();
});

$(document).on("click", ".diagnosis li i", function (e) {
    $(this).parent().fadeOut();
    setTimeout(() => {
        $(this).parent().remove();
    }, 150);
});
$(document).on("click", "#verfiy_client", function (e) {
    e.preventDefault();
    $(".loader").fadeIn();
    clientRegisteration();
});

document
    .getElementById("client_submit")
    .addEventListener("click", function (event) {
        event.preventDefault();
        $(".loader").fadeIn().css("display", "flex");
        let formData = new FormData(document.getElementById("client_register"));
        $(".diagnosis li").each(function () {
            formData.append("diagnosis[]", $(this).text());
        });
        $.ajax({
            url: "/client/check-info",
            method: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                if (data.status == 200) {
                    sendCodes(
                        formData.get("countryCode"),
                        formData.get("phone"),
                        formData.get("email")
                    );
                }
            },
            error: function (err) {
                document.getElementById("errors").innerHTML = "";
                $.each(err.responseJSON.errors, function (key, value) {
                    let error = document.createElement("div");
                    error.classList = "alert alert-danger";
                    error.innerHTML = value[0];
                    document.getElementById("errors").append(error);
                });
                $("#errors").fadeIn("slow");
                $(".loader").fadeOut();
                setTimeout(() => {
                    $("#errors").fadeOut("slow");
                }, 5000);
            },
        });
    });

$(".coming-soon-1").on("click", function () {
    $(".coming-soon-pop-up-1").fadeIn();
    $(".hide-content").fadeIn();
});
$(".coming-soon-pop-up-1 #cancel").on("click", function () {
    $(".coming-soon-pop-up-1").fadeOut();
    $(".hide-content").fadeOut();
});

$('label[for="account_type_2"]').on("click", function () {
    $(".for_some_one").fadeIn();
    $('.managed_client').fadeIn().css('display', 'gird')
    $('#client_submit').parent().fadeOut()
    $('#client_register').find('.additional-info').fadeOut()
});
$('label[for="account_type_1"]').on("click", function () {
    $(".for_some_one").fadeOut();
    $('.managed_client').fadeOut()
    $('#client_submit').parent().fadeIn()
    $('#client_register').find('.additional-info').fadeIn().css('display', 'grid')
});

$(".coming-soon-2").on("click", function () {
    $(".coming-soon-pop-up-2").fadeIn();
    $(".hide-content").fadeIn();
});
$(".coming-soon-pop-up-2 #cancel").on("click", function () {
    $(".coming-soon-pop-up-2").fadeOut();
    $(".hide-content").fadeOut();
});

$(".verify-pop-up #cancel").on("click", function (e) {
    e.preventDefault();
    $(".verify-pop-up").fadeOut();
    $(".hide-content").fadeOut();
});
// end ...

// step 1 of registration
function clientRegisteration() {
    let formData = new FormData(document.getElementById("client_register"));
    $(".diagnosis li").each(function () {
        formData.append("diagnosis[]", $(this).text());
    });

    formData.append("phone_code", $("#phone_code").val());
    formData.append("email_code", $("#email_code").val());

    formData.append("correct_phone_code", sessionStorage.getItem("phoneCode"));
    formData.append("correct_email_code", sessionStorage.getItem("emailCode"));

    if (document.querySelector(`input[name="account_type"]:checked`).value == 1)
    clients.forEach((object, index) => {
        const jsonString = JSON.stringify(object);
        formData.append(`managed_clients[${index}]`, jsonString);
    });

    let now = new Date();
    let created_at = new Date(sessionStorage.getItem("code_expiration"));
    let remainingTime = now.getTime() - created_at.getTime();
    formData.append("remainingTime", remainingTime);

    $.ajax({
        url: "/client/register",
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,
        success: function (data) {
            if (data.status == 200) {
                document.getElementById("errors").innerHTML = "";
                let error = document.createElement("div");
                error.classList = "alert alert-success";
                error.innerHTML = data.msg;
                document.getElementById("errors").append(error);
                $("#errors").fadeIn("slow");

                // login after registration
                let loginData = new FormData();
                loginData.append("emailorphone", $("#email").val());
                loginData.append("password", $("#password").val());

                setTimeout(() => {
                    $.ajax({
                        url: "/client/login",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: loginData,
                        success: function (data) {
                            location.reload();
                        },
                        error: function () {
                            location.reload();
                        },
                    });
                }, 2300);
            }
        },
        error: function (err) {
            document.getElementById("errors").innerHTML = "";
            $(".loader").fadeOut();
            $.each(err.responseJSON.errors, function (key, value) {
                let error = document.createElement("div");
                error.classList = "alert alert-danger";
                error.innerHTML = value[0];
                document.getElementById("errors").append(error);
            });
            $("#errors").fadeIn("slow");
            setTimeout(() => {
                $("#errors").fadeOut("slow");
            }, 5000);
        },
    });
}

function addDiagnosis() {
    if ($("#diagnosis").val() == "") {
        document.getElementById("errors").innerHTML = "";
        let error = document.createElement("div");
        error.classList = "alert alert-danger";
        error.innerHTML = "pleas fill the diagnosis input before adding";
        document.getElementById("errors").append(error);
        $("#errors").fadeIn("slow");
        setTimeout(() => {
            $("#errors").fadeOut("slow");
        }, 2000);
    } else {
        $(".diagnosis").append(
            "<li>" +
                $("#diagnosis").val() +
                '<i class="fa-regular fa-circle-xmark"></i>' +
                "</li>"
        );
        $("#diagnosis").val("");
    }
}

function sendCodes(phone_key, phone, email) {
    $.ajax({
        url: "/client/send-code",
        method: "POST",
        data: { phone_key: phone_key, phone: phone, email: email },
        success: function (data) {
            if (data.status == 200) {
                sessionStorage.setItem("phoneCode", data.phone_code);
                sessionStorage.setItem("emailCode", data.email_code);
                // console.log("phoneCode"+ data.phone_code);
                // console.log("emailCode"+ data.email_code);
                sessionStorage.setItem("code_expiration", new Date());
                $(".loader").fadeOut("slow");
                $(".verify-pop-up").fadeIn().css("display", "flex");
                $(".hide-content").fadeIn();
            } else {
                document.getElementById("errors").innerHTML = "";
                let error = document.createElement("div");
                error.classList = "alert alert-danger";
                error.innerHTML = "failed to send codes";
                document.getElementById("errors").append(error);
                $("#errors").fadeIn("slow");
                setTimeout(() => {
                    $("#errors").fadeOut("slow");
                    $(".loader").fadeOut("slow");
                }, 5000);
            }
        },
    });
}
// end ...
