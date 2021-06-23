<?php
include "header.php";
require('config/klase.php');
$id = $_GET['id'];
?>
<div class="main">
  <div class="container">
    <?php
    $student = $conn->getStudent($id);
    ?>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <a class="btn btn-primary" href="index.php" role="button">back</a>
        <p>
          Name: <?php echo $student['Name']; ?></br>
          School board: <?php echo $student['School_board']; ?></br>
          Grades:
          <ul>
            <?php 
            $grades = $conn->getGrades($id);
            if($grades!=false){
              foreach($grades as $grade){ ?>
                <li><?php echo $grade[2]; ?></li>
            <?php
              }
            }else {
              echo "(no grades)";
            }
            ?>
          </ul>
          <br>Final result: <?php echo $student['Final_result']; ?></br>
        </p>
        <form class="" action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="grade" class="col-form-label">new grade</label>
            <select class="custom-select mr-sm-2" name="grade" id="grade">
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
        <?php
        if(isset($_POST['Submit'])){
          $Grade = $_POST['grade'];
          $Student_ID = $id;
          $conn->addGrade($Student_ID,$Grade);
          echo "New grade added successfully.";
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php
include "footer.php";
?>