$(document).ready(function () {
    var reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    $("#signupEmail").on("keypress blur", function () {
        var stuemail = $("#signupEmail").val();
        $.ajax({
            url: "Student/addstudent.php",
            method: "POST",
            data: {
                checkemail: "checkmail",
                stuemail: stuemail,
            },
            success: function (data) {
                if (data != 0 && reg.test(stuemail)) {
                    $("#statusMsg2").html(
                        '<small style="color:red;">Email ID already in use!</small>'
                    );
                    $("#signup").attr("disabled", true);
                } else if (data == 0 && reg.test(stuemail)) {
                    $("#statusMsg2").html(
                        '<small style="color:green;">Lets go!</small>'
                    );
                    $("#signup").attr("disabled", false);
                } else if (!reg.test(stuemail)) {
                    $("#statusMsg2").html(
                        '<small style="color:red;">Please Enter Valid Email !</small>'
                    );
                    $("#signup").attr("disabled", false);
                }
                if (stuemail == "") {
                    $("#statusMsg2").html(
                        '<small style="color:green;">Lets go!</small>'
                    );
                }
            },
        });
    });
});




function addStu(){
    var reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    var stuname = $("#signupName").val();
    var stuemail = $("#signupEmail").val();
    var stupass = $("#signupPassword").val();
    var stuconfirmpass = $("#confirmPassword").val();

    // Checking Form Fields on Form Submission
    if (stuname.trim() == "") {
        $("#statusMsg1").html(
            '<small style="color:red;">Please Enter Name !</small>'
        );
        $("#signupName").focus();
        return false;
    } else if (stuemail.trim() == "") {
        $("#statusMsg2").html(
            '<small style="color:red;">Please Enter Email !</small>'
        );
        $("#signupEmail").focus();
        return false;
    } else if (stuemail.trim() != "" && !reg.test(stuemail)) { 
        $("#statusMsg2").html(
            '<small style="color:red;">Please Enter Valid Email !</small>'
        );
        $("#signupEmail").focus();
        return false;
    } else if (stupass.trim() == "") {
        $("#statusMsg3").html(
            '<small style="color:red;">Please Enter Password !</small>'
        );
        $("#signupPassword").focus();
        return false;
    } else if (stuconfirmpass.trim() == "") {
        $("#statusMsg4").html(
            '<small style="color:red;">Please Confirm Password !</small>'
        );
        $("#confirmPassword").focus();
        return false;
    } else if (stupass !== stuconfirmpass) {
        $("#statusMsg4").html(
            '<small style="color:red;">Passwords Do Not Match !</small>'
        );
        $("#stuconfirmpass").focus();
        return false;
    } else{

        $.ajax({
            url: 'Student/addstudent.php',
            method: 'POST',
            dataType: 'json',
            data: {
                stusignup: "stusignup",
                stuname: stuname,
                stuemail: stuemail,
                stupass: stupass,
            },
            success: function(data){
                console.log(data);
                if (data == "OK") {
                    $('#successMsg').html("<span>Registration Successful</span>")
                        .css({
                            "background-color": "lightgreen",
                            "padding": "10px",
                            "border-radius": "5px",
                            "color": "darkgreen"
                        });
                        clearStuRegField();
                } else if (data == "Failed") {
                    $('#successMsg').html("<span>Registration Failed</span>")
                        .css({
                            "background-color": "red",
                            "padding": "10px",
                            "border-radius": "5px",
                            "color": "white"
                        });
                }
            },
        });

    }

}


function clearStuRegField() {
    $("#signupForm").trigger("reset");
    $("#statusMsg1").html("");
    $("#statusMsg2").html("");
    $("#statusMsg3").html("");
    $("#statusMsg4").html("");
}


function checkStuLogin() {
    var stuLogEmail = $("#stuLogEmail").val();
    var stuLogPass = $("#stuLogPass").val();
    $.ajax({
        url: 'Student/addstudent.php',
        method: 'POST',
        data: {
            checklogemail: "checklogemail",
            stuLogEmail: stuLogEmail,
            stuLogPass: stuLogPass,
        },
        success: function(data){
            if (data == 0) {
                $("#statusLogMsg").html(
                    '<small style="color:red;">Invalid Email or Password!</small>'
                );
            } else if (data == 1) {
                $("#statusLogMsg").html(
                    '<small style="color:green;">Login Successful!</small>'
                );
                setTimeout(() => {
                    window.location.href = "index.php";
                }
                , 500);
            }
        },
    });    
}