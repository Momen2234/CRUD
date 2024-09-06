<?php
include_once("db.php");
$title="Add";
$name= "";
$email= "";
$mobile= "";
$password= "";
$btn_title="Save";

if (isset($_GET["flag"])&&$_GET["flag"]=="edit") {
    
    $id=$_GET['id'];
    $edit_sql="SELECT * FROM users WHERE id =$id";
    $result_edit = mysqli_query($con, $edit_sql);
    if ($result_edit) {
        $title="Update";
        $user=$result_edit->fetch_assoc();
        $name=$user["name"];
        $email=$user["email"];
        $mobile=$user["mobile"];
        $password=$user["password"];
        $btn_title="Update";

        
    }
}   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Add_user</title>
</head>

<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between">
                <h2><?php echo $title?> users</h2>
                <div><a href="index.php"><i data-feather='corner-down-left'></i></a></div>
            </div>
            <form action="index.php" method='POST'>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control"  placeholder="enter your name"
                        name="name" autocomplete="false" value="<?php echo $name?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" 
                        placeholder="enter your email" name="email" autocomplete="false" value="<?php echo $email?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="tel" class="form-control" 
                        placeholder="enter your phone number" name="mobile" autocomplete="false"value="<?php echo $mobile?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control"  placeholder="password"
                        name="password" autocomplete="false"value="<?php echo $password?>">
                </div>
                <?php
                    if (isset($_GET["id"])){?>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"><?php
                    }
                    ?>
                <input type="submit" class="btn btn-primary" value="<?php echo $btn_title?>" name="save">
            </form>

        </div>
    </div>
    <script src='js/bootstrap.min.js'></script>
    <script src='js/icons.js'></script>
    <script>
        feather.replace();
    </script>
</body>

</html>