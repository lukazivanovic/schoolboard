<?php
include "header.php";
require('klase.php');
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
            $countGradesForm = 0;
              if($grades!=false){
                foreach($grades as $grade){ ?>
                  <li><?php echo $grade[2]; ?></li>
                <?php 
                  $countGradesForm++;
                }
              }else {
                echo "(no grades)";
              }
            ?>
          </ul>
          <br>Average grade: <?php echo $student['Average']; ?>
          <br>Final result: <?php echo $student['Final_result']; ?></br>
        </p>
        <?php 
            if($countGradesForm<4){
        ?>
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
          }
        ?>
        <?php
        if(isset($_POST['Submit'])){
          $grade = $_POST['grade'];
          $studentid = $id;
          $conn->addGrade($studentid,$grade);

          $grades = $conn->getGrades($id);

          $countGradesForm = count($grades);
          $min = 11;
          $max = 0;
          $count = 0;
          $suma = 0;
          $prosek = 0;
          foreach($grades as $grade){
            if($grade[2]>$max) $max = $grade[2];
            if($grade[2]<$min) $min = $grade[2];
            $suma += $grade[2];
            $count++;
          }
          $prosek = $suma/$count;

          if($student['School_board'] == "CSM"){
            $avg = $conn->setAverage($prosek,$studentid);
            if($prosek >= 7){
              $conn->setPassed($studentid);
            }else{
              $conn->setFailed($studentid);
            }
          }
          else if($student['School_board'] == "CSMB"){
            if($count > 2){
              $prosek = ($suma-$min)/($count-1);
            }
            $conn->setAverage($prosek,$studentid);
            if($max > 8){
              $conn->setPassed($studentid);
            }else{
              $conn->setFailed($studentid);
            }
          }
          header('Location: index.php');
        } 
        ?>
      <br>Output: </br>
      <?php 
      if($student['School_board']=="CSM"){
        $CSM = new \stdClass();
        $CSM->id = $student['ID'];
        $CSM->name = $student['Name']; 
        $gradearray = array();
        $gradecountnumber = 0;
        foreach($grades as $grade){
          $gradearray[$gradecountnumber] = $grade[2];
          $gradecountnumber++;
        }
        $CSM->grades = $gradearray;
        $CSM->average = $student['Average'];
        $CSM->result = $student['Final_result'];
        $JSON = json_encode($CSM);
        echo $JSON;
      }else if($student['School_board']=="CSMB"){ 
        $xml = new SimpleXMLElement('<xml/>');
        $studentXML = $xml->addChild('student');
        $studentXML->addChild('id', $student['ID']);
        $studentXML->addChild('name', $student['Name']);
        $gradearray = array();
        $gradecountnumber = 0;
        foreach($grades as $grade){
          $gradearray[$gradecountnumber] = $grade[2];
          $gradecountnumber++;
        }
        $gradearrayText = implode(", ", $gradearray);
        $studentXML->addChild('grades', $gradearrayText);
        $studentXML->addChild('average', $student['Average']);
        $studentXML->addChild('final_result', $student['Final_result']); 
        echo $xml->asXML();
      } ?>
      </div>
    </div>
  </div>
</div>
<?php
include "footer.php";
?>