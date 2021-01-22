<?php
include "header.php";
?>
<div class="main">
  <div class="container">
    <?php
    include "connect.php";
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "select * from student where ID=".$id;
      $result = mysqli_query($mysqli, $sql);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
      }else {
        $errorMsg = 'Could not Find Any Record';
      }
    }
    if(isset($_POST['Submit'])){
      $grade = $_POST['grade'];
      if(!isset($errorMsg)){
        $sql = "insert into grade(Student_ID, Grade) values('".$id."', '".$grade."')";
        $result = mysqli_query($mysqli, $sql);
        if($result){
          $successMsg = 'New record updated successfully';
          header('Location:index.php');
        }else{
          $errorMsg = 'Error '.mysqli_error($mysqli);
        }
      }
    }
    ?>
    <p>
      Name: <?php echo $row['Name']; ?></br>
      School board: <?php echo $row['School_board']; ?></br>
      Final result: <?php echo $row['Final_result']; ?></br>
    </p>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <a class="btn btn-primary" href="index.php" role="button">back</a>
        <form class="" action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="grade">new grade</label>
            <select class="custom-select mr-sm-2" id="grade">
              <option selected>Choose...</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>          
          </div>
          <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-primary waves">add grade</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include "footer.php";
?>