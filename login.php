<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 350px;">
        <h3 class="text-center mb-3">Login</h3>

        <form action="login_controller.php" method="POST">
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>

            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <!-- Register Button (opens modal) -->
            <div class="d-grid">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Register Now
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Register Now</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- <form method="POST" action="task_controller.php"> -->
        <div class="modal-body">
          
          <div class="mb-3">
            <label class="form-label">User Name</label>
            <input type="text" name="newusername" class="form-control" id="newusername" required>
          </div>

          <div class="mb-3">
            <label class="form-label">User Email</label>
            <input type="email" name="newuseremail" id="newuseremail" class="form-control" id="" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="newuserpassword" id="newuserpassword" class="form-control" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" onclick="registerUser()">Register</button>
        </div>

      <!-- </form> -->

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
<script>
function registerUser(){
    
    var newusername = $("#newusername").val();
    var newuseremail = $("#newuseremail").val();
    var newuserpassword = $("#newuserpassword").val();
    
        $.ajax({
            url: 'userRegistrationController.php',
            type: 'POST',
            dataType:'json',
            data: {newusername:newusername,newuseremail:newuseremail,newuserpassword:newuserpassword },
            success: function(response) {
                  if(response.status === 'error') {
                    // Show the message in console
                    alert(response.message);

                    // Or show it in the HTML page
                    // $('#error-message').text(response.message);
                } else {
                    alert(response.message);
                    location.reload();
                }
                // alert(respose['message'])
            },
            error: function() {
                alert('Something went wrong!');
            }
        });

    // });
}
// });
</script>
</html>