<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamBox</title>
    <link rel="icon" type="image/png" href="../images/play.png">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    <section class="wrapper">
        <div class="container">
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">

                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="myToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body" id="toast-body">
                        </div>
                    </div>
                </div>
                
                <br><br>
                <div class="logo">
                    <br><img src="<?php echo Yii::app()->baseUrl . '/assets/images/play.png';?>" class="img-fluid" alt="logo">
                    <h3>StreamBox</h3>
                </div>
                <form class="rounded bg-white shadow p-3" action="/auth/signin" method="GET">
                    <h3 class="text-dark fw-normal fs-4">Create an Account</h3>
                    <div class="fw-normal text-muted mb-3">
                        Already have an account? <button class="btn btn-primary">Sign In</button>
                    </div>
                </form>
                <form class="rounded bg-white shadow p-3" method="post">
                <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email" placeholder="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninput="handleEmailInput(this.value)" title="Enter a valid email" >
                        <label for="floatingPassword"><i class="fa fa-envelope"></i>&nbsp; &nbsp;Email</label>
                        <button type="submit" class="btn btn-primary submit_btn w-50 my-4" id="verify-email-btn" name="verify" disabled onclick="location.href='<?php Yii::app()->createUrl('auth/mail')?>'">Verify Email ID</button>
                        <div class="otp_input text-start mb-2" id="otp-div">
                        <br><label class="d-flex justify-content-center" for="digit">Type your 6 digit security code
                        </label>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <input type="text" name="d1" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border border-primary otpInput" placeholder="" id="d1">
                            <input type="text" name="d2" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border border-primary otpInput" placeholder="" >
                            <input type="text" name="d3" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border border-primary otpInput" placeholder="" >
                            <input type="text" name="d4" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border border-primary otpInput" placeholder="" >
                            <input type="text" name="d5" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border border-primary otpInput" placeholder="" >
                            <input type="text" name="d6" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control border border-primary otpInput" placeholder="" >
                        </div>
                        <div class="d-flex justify-content-center" id="">
                            <button type="button" class="btn btn-primary submit_btn my-4" onclick="validateOTP()">Submit</button>
                        </div>
                    </div> 
                    </div><br>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name ="username" placeholder="name" required>
                        <label for="floatingInput"><i class="fa fa-user"></i>&nbsp; &nbsp;Username</label>
                        <span style="font-size: medium;" class="password-info mt-2" id="feedback-message" ></span>
                    </div><br>
                   
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-zA-Z])(?=.*[\W_]).{6,}" title="Password must contain at least one number, one alphabet, one special character, and be at least 8 characters long" required>
                        <label for="floatingPassword"><i class="fa fa-lock"></i>&nbsp; &nbsp;Password</label>
                        <span style="font-size: small;" class="password-info mt-2">Use 6 or more characters with a mix of letters, numbers & symbols</span>
                    </div><br>
                    
                      <button type="submit" id="signup" name = "signup" class="btn btn-primary submit_btn w-100 my-4">Sign Up</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        var verifyButton = document.getElementById("verify-email-btn");
        verifyButton.addEventListener('click', function(){
            console.log("in verify btn click func")
            var email = document.getElementsByName("email")[0].value;
            console.log("email:",email);
            fetch('/auth/verify-email', {
                method: "POST",
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({email: email}),
            }).then(response => {
                if(response.status === 409){
                    showToastMsg('User already exists.')
                }else{
                    var email = document.getElementsByName("email")[0];
                    email.setAttribute('disabled', true);
                    verifyButton.parentNode.removeChild(verifyButton); 
                    var otpdiv = document.getElementById("otp-div");
                    otpdiv.style.display = "block";
                    document.getElementById("d1").setAttribute('autofocus',true);
                }
            })
            const otpInputs = document.querySelectorAll('.otpInput');
            otpInputs.forEach(function(input, index) {
                input.addEventListener('input', function() {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                });
            });
        })
        function showToastMsg(message) {
            const myToast = document.getElementById('myToast');
            const toastbody = document.getElementById('toast-body');
            toastbody.innerHTML = message;
            const toast = new bootstrap.Toast(myToast);
            toast.show();
        }
        function handleEmailInput(email) {
            var verifyButton = document.getElementById('verify-email-btn');
            if (email.trim() !== '') {
                verifyButton.removeAttribute('disabled');
            } else {
                verifyButton.setAttribute('disabled', true);
            }
        }
        function validateOTP(){
            console.log("validate otp")
            const otpdiv = document.getElementById('otp-div');
                var d1=document.getElementsByName("d1")[0].value;
                var d2=document.getElementsByName("d2")[0].value;
                var d3=document.getElementsByName("d3")[0].value;
                var d4=document.getElementsByName("d4")[0].value;
                var d5=document.getElementsByName("d5")[0].value;
                var d6=document.getElementsByName("d6")[0].value;
                fetch("/auth/verify-email/validateOTP", {
                    method: 'post',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({d1:d1, d2:d2, d3:d3, d4:d4, d5:d5, d6:d6})
                })
                .then(response => {
                if(response.ok){
                    var otpdiv = document.getElementById("otp-div");
                    otpdiv.style.display = "none";
                    var email = document.getElementsByName("email")[0];
                    email.setAttribute('disabled', true);
                    showToastMsg('Email verified successfully.')
                }})
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        const usernameInput = document.getElementById('username');
        const feedbackMessage = document.getElementById('feedback-message');

        usernameInput.addEventListener('blur', async () => {
            const username = usernameInput.value;
            if(username!=""){

                const response = await fetch('/auth/check-username', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ username })
            });

            const data = await response.json();

            if (response.ok) {
                feedbackMessage.textContent = data.message; 
                document.getElementById("signup").removeAttribute('disabled');
            } else {
                feedbackMessage.textContent = data.message;
                document.getElementById("signup").setAttribute('disabled', true);
            }
        }
        });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>