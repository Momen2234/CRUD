<?php
include_once("db.php");
$flag = false;
if (isset($_POST["save"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $mobile = $_POST["mobile"];
  if (($_POST["save"])=='Save') {
    $save_sql = "INSERT INTO `users`( `name`, `email`, `password`, `mobile`) VALUES ('$name','$email','$password','$mobile')";
    
  }else {
    $id=$_POST['id'];
    $save_sql="UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password',`mobile`='$mobile' WHERE id=$id ";
  }
  $result_save = mysqli_query($con, $save_sql);
  if (!$result_save) {
    die(mysqli_error($con));
  } else {
    if (isset($_POST['id'])) {
      $flag='edit';
    }else {
    $flag = "add";
  }
}
  
}
if (isset($_GET["flag"])&&$_GET["flag"]=="del") {
  $id=$_GET['id'];
  $del_sql="DELETE FROM users WHERE id =$id";
  $result_del = mysqli_query($con, $del_sql);

  if (!$result_del) {
    die(mysqli_error($con));
  } else {
    $flag = "del";
  }
  
}


$users_sql = "SELECT * FROM users";
$all_users = mysqli_query($con, $users_sql);
$user=$all_users->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="css/toster.css" rel="stylesheet" />
  <title>Users app</title>
</head>

<body>
  <div class="container">
    <div class="wrapper p-5 m-5">
      <div class="d-flex p-2 justify-content-between mb-2">
        <h2>All users</h2>
        <div>
          <a href="add_user.php"><i data-feather='user-plus'></i></a>
        </div>
      </div>
      <hr>
      <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Moblie</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <php>
            <?php

              while ($user = $all_users->fetch_assoc()) { ?>
                <tr>
    
                  <td>
                    <?php echo $user['id']; ?>
                  </td>
                  <td>
                    <?php echo $user['name']; ?>
                  </td>
                  <td>
                    <?php echo $user['email']; ?>
                  </td>
                  <td>
                    <?php echo $user['mobile']; ?>
                  </td>
                  <td>
                  <div class="d-flex  justify-content-evenly">
                  <i onclick="confirm_delete(<?php echo $user['id']?>)" class="text-danger" data-feather="trash-2"></i>
                  <i onclick="edit(<?php echo $user['id']?>)" class="text-success" data-feather="edit"></i>
                  </div>
                  </td>
                </tr>
            <?php } ?>
            
          </tbody>
        </table>
    </div>
  </div>

  <script src='js/bootstrap.min.js'></script>
  <script src='js/icons.js'></script>
  <script src='js/jq.js'></script>
  <script src='js/toster.js'></script>
  <script src='js/main.js'></script>
  <?php
  if ($flag != false) {
    switch ($flag) {
      case 'add': ?>
        <script>
          show_add();
        </script><?php
        break;
      case 'del': ?>
        <script>
          show_del();
        </script><?php
        break;
      case 'edit': ?>
          <script>
            show_update();
          </script><?php
        break;
      default:
          
        break;
    }

  } ?>

  <script>
    feather.replace();
  </script>
</body>

</html>