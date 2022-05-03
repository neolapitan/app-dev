<!-- php mode -->
<?php
include("nav.php");
//variables and error handling variables
$first_name = $middle_name = $last_name = $gender = $prefix = $seven_digit = $email = "";
$first_nameErr = $middle_nameErr = $last_nameErr = $genderErr = $prefixErr = $seven_digitErr = $emailErr = "";
//if pinindot si btnRegister
if(isset($_POST["btnRegister"])){
    //if walang laman si first name magsasabi ng message si error-handling variable, else mapapasa yung values sa $first_name
    if(empty($_POST["first_name"])){
        $first_nameErr = "Required!";
    }else{
        $first_name = $_POST["first_name"];
    }

    if(empty($_POST["middle_name"])){
        $middle_nameErr = "Required!";
    }else{
        $middle_name = $_POST["middle_name"];
    }

    if(empty($_POST["last_name"])){
        $last_nameErr = "Required!";
    }else{
        $last_name = $_POST["last_name"];
    }

    if(empty($_POST["gender"])){
        $genderErr = "Required!";
    }else{
        $gender = $_POST["gender"];
    }

    if(empty($_POST["prefix"])){
        $prefixErr = "Required!";
    }else{
        $prefix = $_POST["prefix"];
    }

    if(empty($_POST["seven_digit"])){
        $seven_digitErr = "Required!";
    }else{
        $seven_digit = $_POST["seven_digit"];
    }

    if(empty($_POST["email"])){
        $emailErr = "Required!";
    }else{
        $email = $_POST["email"];
    }
    //basically if may laman lahat
    if($first_name && $middle_name && $last_name && $gender && $prefix && $seven_digit && $email){
        //if ang value ni first name ay hindi kabilang sa a-z at A-Z, if hindi kamatch yung values
        if(!preg_match("/^[a-zA-Z ]*$/",$first_name)){
            $first_nameErr = "Letter and space only!";
        } else {
            //variable na bibilang sa length ni first name
            $count_first_name_string = strlen($first_name);
            //if less than 2 ang haba ni first name, middle, and last name maglalabas yung kanilang mga error-handling variable ng message 
            if($count_first_name_string < 2){
                $first_nameErr = "First name is too short!";
            } else{
                $count_middle_name_string = strlen($middle_name);
                if($count_middle_name_string < 2){
                    $middle_nameErr = "Middle name is too short!";
                } else{
                    $count_last_name_string = strlen($last_name);
                    if($count_last_name_string < 2){
                        $last_nameErr = "Last name is too short!";
                    } else{
                        //tagafilter ng e-mail if complete ba yung kailangan na data para matawag na e-mail talaga
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $emailErr = "Invalid e-mail format!";
                        } else{
                            //variable na bibilang sa length ng number
                            $count_seven_digit_string = strlen($seven_digit);
                            //if less than 7 yung haba ng numbers, kasi diba may 4-number prefix tayo
                            if($count_seven_digit_string < 7){
                                $seven_digitErr = "The input is less than 7 digits!";
                            } else {
                                //maggegenerate ng random password ng nagregister once mavalidate lahat ng data niya, and isesend yung pw sa email ng user if legit
                                function random_password($length = 5){
                                    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ01234567890";
                                    $shuffled = substr(str_shuffle($str), 0, $length);
                                    return $shuffled;
                                }

                                $password = random_password(8);
                                include("connections.php");
                                mysqli_query($connections, "INSERT INTO tbl_user(first_name,middle_name,last_name,gender,prefix,seven_digit,email,password,account_type) 
                                VALUES('$first_name','$middle_name','$last_name','$gender','$prefix','$seven_digit','$email','$password','2') ");
                                echo "<script>window.location.href='success.php';</script>"; 
                                
                            }
                        }
                    }
                }
            }
        }
    }

}
?>
<!-- html mode -->

<!-- style tag na magkukulay sa value sa laman ng error-handling variable -->
<style> 
    .error{
        color:red;
    }
</style>

<script type="application/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode 
    if(charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
    
}
</script>

<form method="POST">

    <center>
        <!-- input field -->
        <table border="0" width="50%">
            <!-- input name -->
            <tr><td>  <input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>">  <span class="error"><?php echo $first_nameErr; ?></span></td></tr>
            <tr><td>  <input type="text" name="middle_name" placeholder="Middle Name" value="<?php echo $middle_name; ?>"> <span class="error"><?php echo $middle_nameErr; ?></span></td></tr>
            <tr><td>  <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>"> <span class="error"><?php echo $last_nameErr; ?></td></tr>
            <!-- input gender -->
            <tr>
                <td>
                    <select name="gender">
                        <option name="gender" value="">Select Gender</option>
                        <option name="gender" value="Male" <?php if($gender == "Male"){echo "selected"; }?> >Male</option>
                        <option name="gender" value="Female" <?php if($gender == "Female"){echo "selected";} ?> >Female</option>
                    </select> <span class="error"><?php echo $genderErr; ?></span>
                </td>
            </tr> 
            <!-- input prefix number -->
            <tr>
                <td>
                    <select name="prefix">
                        <option name="prefix" id="prefix" value="">Network Provided (Globe, Smart, Sun, TNT, TM, etc.)</option>

                        <option name="prefix" id="prefix" value="0917" <?php if($prefix == "0917"){echo "selected";} ?> >0917</option>
                        <option name="prefix" id="prefix" value="0907" <?php if($prefix == "0907"){echo "selected";} ?> >0907</option>
                        <option name="prefix" id="prefix" value="0944" <?php if($prefix == "0944"){echo "selected";} ?> >0944</option>
                        <option name="prefix" id="prefix" value="0949" <?php if($prefix == "0949"){echo "selected";} ?> >0949</option>
                        <option name="prefix" id="prefix" value="0956" <?php if($prefix == "0956"){echo "selected";} ?> >0956</option>

                    </select> <span class="error"><?php echo $prefixErr; ?></span>

                    <input type="text" name="seven_digit" value="<?php echo $seven_digit; ?>" maxlength="7" placeholder="Other Seven Digit" onkeypress='return isNumberKey(event)'><span class="error"><?php echo $seven_digitErr; ?></span>
                </td>
            </tr>
            <!-- input email -->
            <tr>
                <td>
                    <input type="text" name="email" value="<?php echo $email; ?>" placeholder="E-mail"><span class="error"><?php echo $emailErr; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <hr>
                </td>
            </tr>   
            <!-- register button -->
            <tr>
                <td>
                    <input type="submit" name="btnRegister" value="Register">
                </td>
            </tr>   

        </table>

    </center>

</form>