<?php
 class Konekcija {
	private $host;
	private $username;
	private $password;
	private $baza;
	private $konekt;

	function __construct($host,$username,$password,$baza){
		$this->host=$host;
		$this->username=$username;
		$this->password=$password;
		$this->baza=$baza;
		$this->konekt=new mysqli($this->host, $this->username,$this->password, $this->baza);
		mysqli_set_charset( $this->konekt, 'utf8');
	}

	function getAllStudents(){	
		$stmt=$this->konekt->prepare("SELECT * FROM student");
		$stmt->execute();
		$students = $stmt->get_result();
		$student = $students->fetch_all();
		if($students->num_rows > 0){
			return $student;
		} else {
			return false;
		}
		$stmt->close();
	}

	function getStudent($id){
		$stmt=$this->konekt->prepare("SELECT * FROM student WHERE ID=?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$students = $stmt->get_result();
		$student = $students->fetch_assoc();
		return $student;
		$stmt->close();
	}

	function addGrade($Student_ID,$Grade){
		$stmt=$this->konekt->prepare("insert into grade(Student_ID, Grade) values(?,?)");
		$stmt->bind_param("is",$Student_ID,$Grade);
		$stmt->execute();
		$stmt->close();
	}

	function averageCSM($id){
		$stmt=$this->konekt->prepare("SELECT AVG(Grade) AS average FROM Grade WHERE ID=?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$averagesCSM = $stmt->get_result();
		$avgCSM = $averagesCSM->fetch_assoc();
		$avg = $avgCSM['average'];
		return $avg;
		$stmt->close();
	}

	function averageCSMB($id){
		$stmt=$this->konekt->prepare("SELECT AVG(Grade) AS average FROM Grade WHERE ID=?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$averagesCSMB = $stmt->get_result();
		$avgCSMB = $averagesCSMB->fetch_assoc();
		$avg = $avgCSMB['average'];
		return $avg;
		$stmt->close();
	}

	function getGrades($id){
		$stmt=$this->konekt->prepare("SELECT * FROM grade WHERE Student_ID=?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$grades = $stmt->get_result();
		$grade = $grades->fetch_all();
		if($grades->num_rows > 0){
			return $grade;
		} else {
			return false;
		}
		$stmt->close();
	}

	function addStudent($Name,$School_board){
		$stmt=$this->konekt->prepare("insert into student(Name, School_board) values(?,?)");
		$stmt->bind_param("ss",$Name,$School_board);
		$stmt->execute();
		$stmt->close();
	}
	
	function setAverage($Average,$Student_ID){
		$stmt=$this->konekt->prepare("UPDATE student SET Average=? WHERE ID=?");
		$stmt->bind_param("si",$Average,$Student_ID);
		$stmt->execute();
		return true;
		$stmt->close();
	}

	function setFailed($Student_ID){
		$stmt=$this->konekt->prepare("UPDATE student SET Final_result='Fail' WHERE ID=?");
		$stmt->bind_param("i",$Student_ID);
		$stmt->execute();
		return true;
		$stmt->close();
	}

	function setPassed($Student_ID){
		$stmt=$this->konekt->prepare("UPDATE student SET Final_result='Pass' WHERE ID=?");
		$stmt->bind_param("i",$Student_ID);
		$stmt->execute();
		return true;
		$stmt->close();
	}
}

$conn = new Konekcija('localhost','root','','schoolboard');

session_start();
?>

