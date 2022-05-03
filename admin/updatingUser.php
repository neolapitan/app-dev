<?php

$id_user = $_GET["id_user"];

$get_record = mysqli_query($connections, "select * from TBL_USER where id_user='$id_user' ");

while($get = mysqli_fetch_assoc($get_record)){

    $db_first_name = $get["first_name"];
    $db_middle_name = $get["middle_name"];
    $db_last_name = $get["last_name"];

    $db_gender = $get["gender"];

    $db_prefix = $get["prefix"];
    $db_seven_digit = $get["seven_digit"];
    $db_email = $get["email"];
    $db_password = $get["password"];


}

$new_first_name = $new_middle_name = $new_last_name = $new_gender = $new_prefix = $new_seven_digit = $new_email = "";
$new_first_nameErr = $new_middle_nameErr = $new_last_nameErr = $new_genderErr = $new_prefixErr = $new_seven_digitErr = $new_emailErr = "";

if(isset($_POST["btnUpdate"])){

    if(empty($_POST["new_first_name"])){
        $new_first_nameErr = "This field must not be empty!";
    } else{
        $new_first_name = $_POST["new_first_name"];
        $db_first_name = $new_first_name;
    }

    if(empty($_POST["new_middle_name"])){
        $new_middle_nameErr = "This field must not be empty!";
    } else{
        $new_middle_name = $_POST["new_middle_name"];
        $db_middle_name = $new_middle_name;
    }

    if(empty($_POST["new_last_name"])){
        $new_last_nameErr = "This field must not be empty!";
    } else{
        $new_last_name = $_POST["new_last_name"];
        $db_last_name = $new_last_name;
    }

    if(empty($_POST["new_seven_digit"])){
        $new_seven_digitErr = "This field must not be empty!";
    } else{
        $new_seven_digit = $_POST["new_seven_digit"];
        $db_seven_digit = $new_seven_digit;
    }

    if(empty($_POST["new_email"])){
        $new_emailErr = "This field must not be empty!";
    } else{
        $new_email = $_POST["new_email"];
        $db_email = $new_email;
    }

    $db_gender = $_POST["new_gender"];
    $db_prefix = $_POST["new_prefix"];

    if($new_first_name && $new_middle_name && $new_last_name && $new_seven_digit && $new_email){

        mysqli_query($connections, "UPDATE tbl_user SET
        
        first_name = '$db_first_name' ,
        middle_name = '$db_middle_name' ,
        last_name = '$db_last_name' , 
        gender = '$db_gender' ,
        prefix = '$db_prefix' ,
        seven_digit = '$db_seven_digit' ,

        email = '$db_email' WHERE id_user = '$id_user'
        
        ");

        $encrypted = md5(rand(1,9));

        echo "<script>window.location.href='viewRecord?$encrypted&&notify=Record has been updated!';</script>";
    }

}

?>


<center>


<br>
<br>
<br>

<form method="POST">

    <table border="0" width="50%">

        <tr>
            <td><input type="text" name="new_first_name" value="<?php echo $db_first_name; ?>" > <span class="error"><?php echo $new_first_nameErr; ?></span></td>
        </tr>

        <tr>
            <td><input type="text" name="new_middle_name" value="<?php echo $db_middle_name; ?>" > <span class="error"><?php echo $new_middle_nameErr; ?></span></td>
        </tr>

        <tr>
            <td><input type="text" name="new_last_name" value="<?php echo $db_last_name; ?>" > <span class="error"><?php echo $new_last_nameErr; ?></span></td>
        </tr>

        <tr>
            <td>
                <select name="new_gender">
                    <option name="new_gender" value="Male" <?php if($db_gender="Male"){echo "selected";} ?> >Male</option>
                    <option name="new_gender" value="Female" <?php if($db_gender="Female"){echo "selected";} ?> >Female</option>
                </select>
                <span class="error"><?php echo $new_genderErr; ?></span>
            </td>
        </tr>

        <tr>
            <td>
                <select name="new_prefix">
                        <option name="new_prefix" value="0917" <?php if($db_prefix == "0917"){echo "selected";} ?> >0917</option>
                        <option name="new_prefix" value="0907" <?php if($db_prefix == "0907"){echo "selected";} ?> >0907</option>
                        <option name="new_prefix" value="0944" <?php if($db_prefix == "0944"){echo "selected";} ?> >0944</option>
                        <option name="new_prefix" value="0949" <?php if($db_prefix == "0949"){echo "selected";} ?> >0949</option>
                        <option name="new_prefix" value="0956" <?php if($db_prefix == "0956"){echo "selected";} ?> >0956</option>

                </select>

                <span class="error"><?php echo $new_prefixErr; ?></span>
                &nbsp;
                <input type="text" name="new_seven_digit" value="<?php echo $db_seven_digit; ?>">
                <span class="error"><?php echo $new_seven_digitErr; ?></span>
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" name="new_email" value="<?php echo $db_email; ?>"> <span class="error"><?php echo $new_emailErr; ?></span>
            </td>
        </tr>

        <tr>
            <td><input type="submit" name="btnUpdate" value="Update" class="btn-primary"></td></tr>
        </tr>
    
    </table>

</form>


</center>