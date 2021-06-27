<?php
require('klase.php');
include "header.php";

$student = $conn->getAllStudents();
?>
    <div class="main">
        <div class="container">
            <div id="content">
                <p>A student can have 1 to 4 grades.</p>
                <p>CSM considers pass if the average is bigger or equal to 7 and fail otherwise. Returns JSON format</p>
                <p>CSMB discards the lowest grade, if you have more than 2 grades, and considers pass if his biggest grade is bigger than 8. Returns XML format</p>
                <p> Each student result, either XML or JSON, will contain the student id, name, list of grades, average and final result (Fail, Pass)</p>

                <a class="btn btn-primary" href="studentadd.php" role="button">Add a student...</a>

                <h1>CSM</h1>
                <table class="table table-striped table-bordered table-hover table-sm" id="tabela">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Average</th>
                    <th scope="col">Final result</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($student!=false){
                        foreach($student as $stu){ 
                        if ($stu[4]=="CSM") { ?>
                        <tr>
                        <th scope='row'><?php echo $stu[0]; ?></th>
                        <td><?php echo $stu[1]; ?></td>
                        <td><?php echo $stu[2]; ?></td>
                        <td><?php echo $stu[3]; ?></td>
                        <td>
                            <a href="student.php?id=<?php echo $stu[0] ?>" class="btn btn-dark"><i class="fa fa-eye"></i></a>
                        </td>
                        </tr>
                        <?php }
                        }
                    }
                    ?>
                </tbody>
                </table>
                
                <h1>CSMB</h1>
                <table class="table table-striped table-bordered table-hover table-sm" id="tabela1">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Average</th>
                    <th scope="col">Final result</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if($student!=false){
                        foreach($student as $stu){ 
                        if ($stu[4]=="CSMB") { ?>
                        <tr>
                        <th scope='row'><?php echo $stu[0]; ?></th>
                        <td><?php echo $stu[1]; ?></td>
                        <td><?php echo $stu[2]; ?></td>
                        <td><?php echo $stu[3]; ?></td>
                        <td>
                            <a href="student.php?id=<?php echo $stu[0] ?>" class="btn btn-dark"><i class="fa fa-eye"></i></a>
                        </td>
                        </tr>
                        <?php }
                        }
                    }
                    ?>
                </tbody>
                </table>

            </div>
        </div>

</div>
<?php
include "footer.php";
?>