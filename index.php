<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
$conn = mysqli_connect($servername,$username,$password,$database);
if($conn){
    // echo "connection successful";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['hidden-sno'])){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $sno = $_POST['hidden-sno'];
            $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = '$sno'";
            $result = mysqli_query($conn, $sql);
            if($result){
                
            }
            else{
                
            }
        }
        else if(isset($_POST['delete-entry'])){
            $sno = $_POST['delete-entry'];
            $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
            $result = mysqli_query($conn, $sql);
        }
        else{
            $title = $_POST['title'];
            $description = $_POST['description'];  
            $sql = "INSERT INTO `notes` (`title`, `description`, `time`) VALUES ('$title', '$description', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                // echo "data inserted successfully";
            }
        }
        
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <title>Document</title>
</head>
<body>
<div class="overlay">
  
</div>
    <div class="modal">
        <div class="modal-content">
        <form action="index.php" method="post">
            <div class="title-container">
                <label for="title" class="title">Title</label>
            <input type="text" class="title-in title-edit" name="title" required>
            </div>
            <div class="description-container">
                <label for="title" class="title">Description</label>
           <textarea name="description" id="description" class="description-edit" cols="30" rows="10" required></textarea>
            </div>
            
           <input type="submit" class="btn">
           <input type="hidden" class="hidden-sno" name="hidden-sno"> 
        </form>
        </div>
    </div>
    <div class="modal-del">
        <div class="modal-content">
            <form action="index.php" method="post">
            <h1>Confirm Delete?</h1>
            <input type="hidden" class="del" name="delete-entry">
            <input type="submit" class="btn-del">
            <button class="btn-del-cancel">Cancel</button>
            </form>
        </div>
    </div>
    <div class="main">
    <div class="form-container">
        <form action="index.php" method="post" class="inp-form">
            <div class="title-container">
                <label for="title" class="title">Title</label>
            <input type="text" class="title-in" name="title" required>
            </div>
            <div class="description-container">
                <label for="title" class="title">Description</label>
           <textarea name="description" id="description" cols="30" rows="10" required></textarea>
            </div>
            
           <input type="submit" class="btn">
        </form>
    </div>
    <div class="form-data">
            
            <table id="myTable" class="display">
    <thead>
        <tr>
            <th>sno</th>
            <th>title</th>
            <th>description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $num = 0;
        if(mysqli_num_rows($result)>0){
            while($rows = mysqli_fetch_assoc($result)){
                $num = $num + 1;
                echo "<tr>
                <td>".$num."</td>
                <td>".$rows['title']."</td>
                <td>".$rows['description']."</td>
                <td><a href='#' class='edit' id=".$rows['sno'].">Edit</a> <a href='#' class='delete' id=d".$rows['sno'].">Delete</a></td>
                </tr>";
            }
        }
    ?>
    </tbody>
</table>
            
        </div>
    </div>
    
    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="script.js?v=<?php echo time(); ?>"></script>
</body>
</html>