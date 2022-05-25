intervalTime = 10000;

// send email automatically every specific time
var x = setInterval(function () {
    $.ajax({
        url: "includes/send-email.php",
        method: "POST",
        data: {
        },
        success: function () {
            console.log("success!");
        }
    });
}, intervalTime);