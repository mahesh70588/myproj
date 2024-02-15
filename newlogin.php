<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title>Register</title>
    
    
    
    
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
        
         //for including configuration etails
         include("php/config.php");
         function smtp_mailer($to,$subject, $msg){
            $mail = new PHPMailer(); 
            $mail->IsSMTP(); 
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; 
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            //$mail->SMTPDebug = 2; 
            $mail->Username = "maheshsh.0045@gmail.com";
            $mail->Password = "mmhqfvchyeromcpl";
            $mail->SetFrom("maheshsh.0045@gmail.com");
            $mail->Subject = $subject;
            $mail->Body =$msg;
            $mail->AddAddress($to);
            $mail->SMTPOptions=array('ssl'=>array(
                'verify_peer'=>false,
                'verify_peer_name'=>false,
                'allow_self_signed'=>false
            ));
            if(!$mail->Send()){
                echo $mail->ErrorInfo;
            }else{
                session_start();
                $_SESSION['msg'] = "Check your email to Activate your account $email";
                header('location:login.php');

                //return  'check your mail to activate your account $email';
                }
            }


         if(isset($_POST['submit'])){
            $username = mysqli_real_escape_string($con,$_POST['username']);
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $phone = mysqli_real_escape_string($con,$_POST['phone']);
            $password = mysqli_real_escape_string($con,$_POST['password']);
            $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
// to make password encrypt
            $pass=password_hash($password,PASSWORD_BCRYPT);
            $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

            //for generating random token
            $token=bin2hex(random_bytes(15));


 
         //verifying the unique email and password and confirm password 
         $emailquery ="select * from user_details where Email='$email'";
         $query=mysqli_query($con,$emailquery);
         $emailcount=mysqli_num_rows($query);
         if($emailcount>0){
            echo "<div class='message'>
            <p>Email Already Exist!</p>
        </div>
          <br>";
          echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        }
          else{
            if($password===$cpassword){
                $insertquery="insert into user_details (Username,Email,Phone,Password,Cpassword,Token,Status) VALUES('$username','$email','$phone','$pass','$cpass','$token','inactive')";
                $iquery=mysqli_query($con,$insertquery);
                if($iquery){


                    
                    include('smtp/PHPMailerAutoload.php');
                    $subject="Account Activation";
                    $body="Hi, $username. Click Here to activate your account 
                    http://localhost/login/activate.php?token=$token ";

                    echo smtp_mailer($email,$subject,$body);
                    
                    
                    

                    












                    }
                   
            
          }
           
        
         



         }
        }



        else{
             
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post" onsubmit=" return validation()">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                    <span id="usernameid" class="text-danger font-weight-bold"></span>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                    <span id="email" class="text-danger font-weight-bold"> </span>
                </div>

                <div class="field input">
                    <label for="phone">Phone No</label>
                    <input type="text" name="phone" id="phone" autocomplete="off" required>
                    <span id="phone" class="text-danger font-weight-bold"></span>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <span id="password" class="text-danger font-weight-bold"></span>
                </div>
                <div class="field input">
                    <label for="password">Confirm Password</label>
                    <input type="text" name="cpassword" id="cpassword" autocomplete="off" required>
                    <span id="cpassword" class="text-danger font-weight-bold"></span>
                </div>


                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>

      <script type="text/javascript">
        function validation(){
            var Username =document.getElementById('username').value;
            var Email =document.getElementById('email').value;
            var Mobileno =document.getElementById('phone').value;
            var Password =document.getElementById('password').value;
            var Cpassword =document.getElementById('cpassword').value;
            if(Username==""){
                document.getElementById('usernameid').innerHTML="**please fill the Username";
                return false;
            }
            if((Username.length<3) || (Username.length>20)){
                document.getElementById('usernameid').innerHTML="**Username must be between 3 to 20 character";
                return false;
            }
            if(!isNaN(Username)){
                document.getElementById('usernameid').innerHTML="**Please enter Character";
                return false;

            }
            if(Mobileno.length!=10){
                document.getElementById('phone').innerHTML="**Mobile number must be of 10 digits";
                return false;


            }
            if(isNan(Mobileno)){
                document.getElementById('phone').innerHTML="**Mobile number must contains digits only ";
                return false;

            }
            

        }


        </script>
</body>
</html>