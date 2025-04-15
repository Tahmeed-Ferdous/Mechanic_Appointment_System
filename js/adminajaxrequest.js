function checkAdminLogin() {
    console.log("checkAdminLogin function called");

    var adminemail = $("#adminemail").val();
    var adminpass = $("#adminpass").val();

    $.ajax({
        url: 'Admin/admin.php',
        method: 'POST',
        data: {
            checklogemail: "checklogemail",
            adminemail: adminemail,
            adminpass: adminpass,
        },
        success: function(data) {
            console.log("Response from server:", data);

            if (data == 0) {
                console.log("Invalid credentials.");
                $("#statusAdminLogMsg").html(
                    '<small style="color:red;">Invalid Email or Password!</small>'
                );
            } else if (data == 1 || data == "1") { 
                console.log("Login successful! Redirecting...");
                $("#statusAdminLogMsg").html(
                    '<small style="color:green;">Login Successful!</small>'
                );
                setTimeout(() => {
                    window.location.href = "Admin/admindashboard.php";
                }, 500);
            } else {
                console.log("Unexpected response:", data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", error);
        }
    });
}
