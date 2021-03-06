

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Update Informationo</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile.css" />
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>
  
    <?php
        session_start();    
        /*session variable that holds user's mail and id*/
        $uMail = $_SESSION["user_mail"];
        $uId =  $_SESSION["user_id"];

        /*defining variabes for database connection*/
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $dbname = "alumni";
            $link = mysqli_connect($hostname, $username, $password, $dbname);

        /*fetching from user table*/
            $sql1 = "Select * from user where email = '$uMail' ";
            $resEmail = mysqli_query($link, $sql1);

        /*fetching from user_info table*/
            $sql2 = "Select * from user_info where user_id = '$uId' ";
            $resID = mysqli_query($link, $sql2);

        /*values are fetched and are in the row1 and row2 arrays*/
            $row1 = mysqli_fetch_assoc($resEmail);
            $row2 = mysqli_fetch_assoc($resID);

        /*update starts here*/

            if (isset($_POST['submit'])){

                $name = $_POST['name'];
                $batch = $_POST['batch'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $country = $_POST['country'];
                $city = $_POST['city'];

                $userTableUp = "UPDATE user SET email = '$email' WHERE id = '$uId'";
                $userInoUo = "UPDATE user_info SET batch = '$batch]', name = '$name',phone = '$phone',current_country = '$country',current_city = '$city' WHERE user_id='$uId'";

                $up2 = mysqli_query($link,$userInoUo);
                $up1 = mysqli_query($link,$userTableUp);

                $_SESSION["user_mail"] = $email;
                $_SESSION["user_id"] = $uId;

                header("location:../pages/profile.php");          
            }
        /*update ends here*/  
     ?>
   
   
<!--   showing previous information-->

      <!--creating div for other information-->
    <div class="container main_info_area">  
          
       <div class="edit_profile">
           <p class="edit_btn" text-align="center">Current Profile</p>
       </div>   
<!--    creating a div for user image-->
       <div class="image_area">
           <img class="user_image" src="../user_img/<?php echo $row2['image']; ?>">   
        </div>
       
        
        <div class="user_information">
          <div class="row">
               <div class="col-md-6 name_batch">
                    Name - <a href="#"> <?php echo $row2['name']; ?> </a><br>
                    Batch - <a href="#"> <?php echo $row2['batch']; ?> </a><br>
                    Current Country - <a href="#"> <?php echo $row2['current_country']; ?> </a><br>
               </div>

             <div class="col-md-6 institute">
                   Institute - <a href="#"> Institute name </a><br>
                   Position -  <a href="#"> Position name </a><br>
                    Current City - <a href="#"> <?php echo $row2['current_city']; ?> </a><br>
               </div> 
          </div>
          
          <div class="contact">
           Phone - <a href="#" class="phone"> <?php echo $row2['phone']; ?> </a>
           Email - <a href="#" class="mail"> <?php echo $row1['email']; ?> </a>
           </div>
          
       </div>    
    </div>
    
            
<!--    creating form-->

<div class="container">
        <br>
        
        <h2>Update Information</h2>

        <form onsubmit="return validation()" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" name="name" class="form-control">
                <span id="nameError" class="text-danger font-wight-bold"></span>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Batch</label>
                </div>

                <select class="custom-select" name="batch" id="inputGroupSelect01">
                    <option disabled>Your batch number...</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                </select>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" id="email" name="email" class="form-control">
                <span id="emailError" class="text-danger font-wight-bold"></span>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" id="phoneNumber" name="phone" class="form-control">
                <span id="phoneNoError" class="text-danger font-wight-bold"></span>
            </div>

            <div class="form-group">
                <label>Current Country</label>
                <input type="text" id="currentCountry" name="country" class="form-control">
                <span id="crntCountryError" class="text-danger font-wight-bold"></span>
            </div>

            <div class="form-group">
                <label>Current City</label>
                <input type="text" id="currentCity" name="city" class="form-control">
                <span id="crntCityError" class="text-danger font-wight-bold"></span>
            </div>
            <input type="submit" id="submitBtn" name="submit" class="btn btn-primary">

        </form>

    </div>

<!--    creating form-->
    
   

  
   <script>
       
       function validation() {
        /*receiving input value from user*/
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var phoneNumber = document.getElementById('phoneNumber').value;
        var currentCountry = document.getElementById('currentCountry').value;
        var currentCity = document.getElementById('currentCity').value;
        /*receiving user innputs*/


        /*assigning regular expressions*/

        var nameCheck = /^[A-Za-z. ]{3,30}$/;       
        var emailCheck = /^[A-Za-z_0-9]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;
        var mobileCheck = /^[0-9]{11}$/;
        var crntCountryCheck = /^[A-Z]{1}[A-Za-z. ]$/;
        var crntCityCheck = /^[A-Z]{1}[A-Za-z. ]$/;

 

        /*validation starts*/

        if (nameCheck.test(name)) //checking name
        {
            document.getElementById('nameError').innerHTML = " ";
        } else {
            document.getElementById('nameError').innerHTML = "** Invalid name!";
            return false;
        }

        if (emailCheck.test(email)) //checking email
        {
            document.getElementById('emailError').innerHTML = " ";
        } else {
            document.getElementById('emailError').innerHTML = "** Use standard mail format!";
            return false;
        }

        if (mobileCheck.test(phoneNumber)) //checking phone number
        {
            document.getElementById('phoneNoError').innerHTML = " ";
        } else {
            document.getElementById('phoneNoError').innerHTML = "** Phone number starts with 01 and length=11";
            return false;
        }       
        /*validation ends*/
           
           
           /*update starts here*/
            
           /*update ends here*/
    </script>
    
    
</body>

</html>