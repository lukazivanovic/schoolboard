<?php
include "header.php";
require('klase.php');
?>
<div class="main">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<a class="btn btn-primary" href="index.php" role="button">Back</a>
				<form class="" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">name</label>
						<input type="text" class="form-control" name="name" placeholder="name" value="" required>
					</div>
					<div class="form-group">
						<label for="schoolboard">school board</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="schoolboard" id="CSM" value="CSM" checked>
							<label class="form-check-label" for="CSM">CSM</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="schoolboard" id="CSMB" value="CSMB">
							<label class="form-check-label" for="CSMB">CSMB</label>
						</div>
						</div>
					<div class="form-group">
						<button type="submit" name="Submit" class="btn btn-primary waves">add student</button>
					</div>
				</form>
				<?php
				if (isset($_POST['Submit'])) {
					$name = $_POST['name'];
					$schoolboard = $_POST['schoolboard'];
					$conn->addStudent($name,$schoolboard);
					header('Location: index.php');
				}
				?>
			</div>	
		</div>
	</div>
</div>
<?php
include "footer.php";
?>