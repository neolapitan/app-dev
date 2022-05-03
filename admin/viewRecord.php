<?php

session_start();
include("../connections.php");
include("nav.php");

?>

<script type="text/javascript" src="js/jQuery.js"></script>
<script type="application/javascript">

setInterval(() => {
    
    $('#retriever').load('retriever.php');

}, 1000);


</script>

<?php

if(empty($_GET["getDelete"])){

} else{

    include("confirmDelete.php");

}

if(empty($_GET["getUpdate"])){


?>

<div id="retriever">
<?php include("retriever.php"); ?>
</div>

<?php


} else{

    include("updatingUser.php");

}

if(empty($_GET["notify"])){
    //do nothing here
} else {
    echo "<font color=green><h3><center>" . $_GET["notify"] . "</center></h3></font>";
}




?>
