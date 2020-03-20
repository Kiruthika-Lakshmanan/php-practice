<html>
<head>
<title>Student Registration Form</title>
<style>
    body {
        
        margin: 0px auto;
        background-color:lightpink;
    }
   
    .required{
       color:red;
    }
     
</style>    
</head>
 
<body>
    
       
<center><h3>STUDENT REGISTRATION FORM</h3></center>
<hr/>
<form action="" method="POST"> 
<table>
<tr>
<td>FIRST NAME</td>
<td><input type="text" name="firstName"/><span class="required">*<?php echo (!isset ($_POST['firstName'])) ? $student->getErrors() : '' ; ?></span>
</td>
</tr>

<tr>
<td>LAST NAME</td>
<td><input type="text" name="lastName"/><span class="required">*<?php echo (!isset ($_POST['lastName'])) ? $student->getErrors() : '' ; ?></span>

</td>
</tr>
 

<tr>
<td>DATE OF BIRTH</td>
 <td><input type="text" name="dob"/>

</td>
</tr>
 

<tr>
<td>EMAIL ID</td>
<td><input type="text" name="emailId"/><span class="required">*<?php echo (!isset ($_POST['email'])) ? $student->getErrors() : ''; ?></span>
</td>
</tr>
 

<tr>
<td>MOBILE NUMBER</td>
<td>
<input type="text" name="mobileNumber" />

</td>
</tr>
 

<tr>
<td>GENDER</td>
<td>
    Male <input type="radio" name="gender" value="male" />
    Female <input type="radio" name="gender" value="female" />
</td>
</tr>
 
<tr>
    <td>ADDRESS </td>
<td><input type="text" name="address"/></td>
</tr>

<tr>
<td>CITY</td>
<td><input type="text" name="city"/>
</td>
</tr>
 

<tr>
<td>PIN CODE</td>
<td><input type="text" name="pinCode"/>

</td>
</tr>
 
<tr>
<td>STATE</td>
<td><input type="text" name="state"/>

</td>
</tr>
 
<tr>
<td>COUNTRY</td>
<td><input type="text" name="country"/></td>
</tr>
 
 
<tr>
<td>HOBBIES</td>
<td><input type="text" name="hobbies"/></td>
</tr>  


<td>COURSES<br />APPLIED FOR</td>
<td>
BCA
<input type="radio" name="Course" value="BCA">
B.Com
<input type="radio" name="Course" value="B.Com">
B.Sc
<input type="radio" name="Course" value="B.Sc">
B.A
<input type="radio" name="Course" value="B.A">
</td>
</tr>

<tr>
<td>
<input type="submit" value="Submit">
<input type="reset" value="Reset">
</td>
</tr>
</table>
 
</form>

</body>
</html>

<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

require_once 'Student.class.php';
require_once 'Qualification.class.php';

if (empty($_POST['submit'])) {
    $db = DB::getInstance();
    echo get_class($db);
    
    $student=new Student();
    $student->setFirstName($_POST['firstName']);
    $student->setLastName($_POST['lastName']);
    $student->setEmailId($_POST['emailId']);
    $student->setPhoneNumber($_POST['mobileNumber']);
    $student->setAddress($_POST['address']);
    $student->setCity($_POST['city']);
    $student->setPinCode($_POST['pinCode']);
    $student->setDateOfBirth($_POST['dob']);
    $student->setHobbies($_POST['hobbies']);
    $student->setCourses($_POST['Course']);
    $student->setCountry($_POST['country']);
    $student->setGender($_POST['gender']);

    $qualification = new Qualification();
    $qualification ->setName($_POST['name']);
    $qualification ->setBoard($_POST['board']);
    $qualification ->setPercent($_POST['percent']);
    $qualification ->setYear($_POST['year']);


//    $qualification = new Qualification();
//    $qualification ->setName($_POST['name2']);
//    $qualification ->setBoard($_POST['board2']);
//    $qualification ->setPercent($_POST['percent2']);
//    $qualification ->setYear($_POST['year2']);
//
//
//    $qualification = new Qualification();
//    $qualification ->setName($_POST['name3']);
//    $qualification ->setBoard($_POST['board3']);
//    $qualification ->setPercent($_POST['percent3']);
//    $qualification ->setYear($_POST['year3']);
//
//
//    $qualification = new Qualification();
//    $qualification ->setName($_POST['name4']);
//    $qualification ->setBoard($_POST['board4']);
//    $qualification ->setPercent($_POST['percent4']);
    //$qualification ->setYear($_POST['year4']);
    

$student->setQualification($qualification);

$student->insert();
} else {
  echo "enter your details and submit";
}
echo $student->getFirstName();
echo $student->getLastName();
echo $student->getEmailId();
echo $student->getPhoneNumber();
echo $student->getAddress();
echo $student->getCity();
echo $student->getPinCode();
echo $student->getDateOfBirth();
echo $student->getHobbies();
echo $student->getCourses();
echo $student->getCountry();
echo $student->getGender();
?>