<?php

//mysql connection start
$conn = new mysqli('localhost','root','');
if($conn->connect_error){
    die("db connect error: " .$conn->connect_error);
}


//database create
$sql="CREATE DATABASE IF NOT EXISTS college";
if(!mysqli_query($conn,$sql)){
    die("db connction error:". mysqli_error($conn));
}

//select database
if(!mysqli_select_db($conn,'college')){
    die("db select failed");
}

//db table create
$sql="CREATE TABLE IF NOT EXISTS students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
if(!$conn->query($sql)){
    die("error creating table: " . $conn->error);
}

//url query start

//$current_url = sprintf('%s://%s%s',$_SERVER['REQUEST_SCHEME'], $_SERVER['HTTPHOST'], $_SERVER['REQUEST_URI']);
//$current_url=explode('?',$current_url);
//$current_url = isset($current_url[0]) ? $current_url[0] : '';


//php global variable for data query start

$form_submitted=isset($_POST['form_submitted']) ? $_POST['form_submitted'] : '';
$name=isset($_POST['name']) ? $_POST['name'] : '' ;
$email=isset($_POST['email']) ? $_POST['email'] : '' ;
$pass=isset($_POST['password']) ? $_POST['password'] : '' ;
$phone=isset($_POST['phone']) ? $_POST['phone'] : '' ;

//table data deleted

$delete_id = isset($_GET['delete']) ? $_GET['delete'] : '';
if ($conn->query("DELETE FROM students WHERE `id`=$delete_id")) {
    header("LOCATION: crud.php");
}
?>

<!--html start here-->

    <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>crud</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="author" href="humans.txt">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    </head>
    <body>
    <div class="main p-3">
        <div class="row">
            <div class="col">
                <?php
                //table data update query start
              if(isset($_POST['form_updated'])){
                  $name=$_POST['name'];
                  $email=$_POST['email'];
                  $pass=$_POST['password'];
                  $phone=$_POST['phone'];
                  $id=$_POST['id'];
                  $sql_update = "UPDATE students
                       SET name='$name',
                           email='$email',
                               id='$id',
                           password='$pass',
                           phone='$phone'
                       WHERE id=$id";
                  if (!$conn->query($sql_update)) {
                      echo "Error: {$conn->error}";
                  } else {
                      header("LOCATION: crud.php?");
                  }

              }
                //table data update query end


                //data id select for edit from database table

                if(isset($_GET['id'])){
                    $user_id=$_GET['id'];
                    $select_id="SELECT * FROM students WHERE `id`=$user_id";
                    $run_edit=$conn->query($select_id);

                    while ($select_data=mysqli_fetch_assoc($run_edit)){ ?>
<!--   data form for update start-->
                        <form action="crud.php" method="POST" class=" p-3">
                            <h2>Registration Edit</h2>
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Name:</label>
                                <input value="<?php echo $select_data['name']; ?>" type="name" class="form-control" id ="name" placeholder="Enter name" name="name">
                                <input value="<?php echo $select_data['id']; ?>" type="hidden" class="form-control" id ="id" placeholder="Enter id" name="id">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Email:</label>
                                <input value="<?php echo $select_data['email']; ?>" type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input value="<?php echo $select_data['password']; ?>" type="text" class="form-control" id="paswd" placeholder="Enter password"
                                       name="password">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input value="<?php echo $select_data['phone']; ?>" type="text" class="form-control" id="phone" placeholder="Enter phone number"
                                       name="phone">
                            </div>
                            <div class="form-check mb-3">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                                </label>
                            </div>
                            <input type="hidden" name="form_updated" value="yes">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <!--   data form for update end-->
                    <?php  } }else{ ?>
                        <?php


                    if($form_submitted=='yes' && !empty($name) && !empty($email)){
                        $name=isset($_POST['name']) ? $_POST['name'] : '';
                        $email=isset($_POST['email']) ? $_POST['email'] : '';
                        $pass=isset($_POST['password']) ? $_POST['password'] :'';
                        $phone=isset($_POST['phone']) ? $_POST['phone'] : '';

                        $sql = "INSERT INTO students( name,email,password,phone) VALUES('$name','$email','$pass','$phone')";
                        if($conn->query($sql)) {
                            echo "<p style='color: blue;margin: 20px'>","Registration submitted successfully!","</p>";
                        }


                    }

                    ?>

                    <form action="crud.php" method="POST" class=" p-3">
                        <h2>Registration</h2>
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input  type="name" class="form-control" id ="name" placeholder="Enter name" name="name">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input  type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="text" class="form-control" id="paswd" placeholder="Enter password"
                                   name="password">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter phone number"
                                   name="phone">
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Remember me
                            </label>
                        </div>
                        <input type="hidden" name="form_submitted" value="yes">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <!--   data form for update end-->
                <?php   }?>
            </div>

<!--            data show for table start-->
            <div class="col p-3">
                <h3>Students details Table : PHP-CURD -> Design By Motaleb Hossen</h3>
                <table class=" table table-striped p-3">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Password</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    //table selected
                    $sql = "SELECT * FROM students";
                    $result=$conn->query($sql);
                    $index = 0;
                    while ($data = mysqli_fetch_assoc($result)) : $index++; ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $data['id'];?></td>
                            <td><?php echo $data['name']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['password']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td> <a type="button" href="crud.php?id=<?php echo $data['id'];?>"class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a type="button" href="crud.php?delete=<?php echo $data['id'];?>" class="btn btn-danger"><i class="bi bi-archive"></i></a></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
                <!--  data show for table start-->
        </div>
    </div>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    </body>
    </html>
<?php
mysqli_close($conn);