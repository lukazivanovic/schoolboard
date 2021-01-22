<?php
include "header.php";
include "connect.php";
$query = "SELECT * FROM student";
$result = $mysqli->query($query);
?>
    <div class="main">
        <div class="container">
            <div id="content">
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
                    while($row = mysqli_fetch_array($result)) {
                        if($row['School_board']=="CSM"){
                        echo "<tr>";
                        echo "<th scope='row'>".$row['ID']."</th>";
                        echo "<td>".$row['Name']."</td>";
                        echo "<td>".$row['Average']."</td>";
                        echo "<td>".$row['Final_result']."</td>"; ?>
                        <td>
                            <a href="student.php?id=<?php echo $row['ID'] ?>" class="btn btn-dark"><i class="fa fa-eye"></i></a>
                        </td>
                        <?php echo "</tr>";
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
                    while($row = mysqli_fetch_array($result)) {
                        if($row['School_board']=="CSMB"){
                        echo "<tr>";
                        echo "<th scope='row'>".$row['ID']."</th>";
                        echo "<td>".$row['Name']."</td>";
                        echo "<td>".$row['Average']."</td>";
                        echo "<td>".$row['Final_result']."</td>"; ?>
                        <td>
                            <a href="student.php?id=<?php echo $row['ID'] ?>" class="btn btn-dark"><i class="fa fa-eye"></i></a>
                        </td>
                        <?php echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
                </table>

            </div>
        </div>

        <?php
            $result->close();
            $mysqli->close();
        ?>
</div>
<?php
include "footer.php";
?>