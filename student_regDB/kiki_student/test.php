<?php

class Student {

   protected $firstName;
   protected $lastName;
   protected $emailId;
   protected $dateOfBirth;
   protected $phoneNumber;
   protected $gender;
   protected $address;
   protected $city;
   protected $pinCode;
   protected $country;
   protected $hobbies;
   protected $courses;
   public function  setFirstName($firstName)
   {
       $this->firstName = $firstName;
   }
   public function getFirstName()
   {
       return $this->firstName;
   }
    public function  setLastName($lastName)
   {
       $this->lastName = $lastName;
   }
   public function getLastName()
   {
       return $this->lastName;
   }
   public function  setEmailId($emailId)
   {
       $this->emailId = $emailId;
   }
   public function getEmailId()
   {
       return $this->emailId;
   }
    public function  setDateOfBirth($dateOfBirth)
   {
       $this->dateOfBirth = $dateOfBirth;
   }
   public function getDateOfBirth()
   {
       return $this->dateOfBirth;
   }
     public function  setPhoneNumber($phoneNumber)
   {
       $this->phoneNumber = $phoneNumber;
   }
   public function getPhoneNumber()
   {
       return $this->phoneNumber;
   }
     public function  setGender($gender)
   {
       $this->gender = $gender;
   }
   public function getGender()
   {
       return $this->gender;
   }
     public function  setAddress($address)
   {
       $this->address = $address;
   }
   public function getAddress()
   {
       return $this->address;
   }
      public function  setCity($city)
   {
       $this->city = $city;
   }
   public function getCity()
   {
       return $this->city;
   }
      public function  setPinCode($pinCode)
   {
       $this->pinCode = $pinCode;
   }
   public function getPinCode()
   {
       return $this->pinCode;
   }
      public function  setCountry($country)
   {
       $this->country = $country;
   }
   public function getCountry()
   {
       return $this->country;
   }
      public function  setHobbies($hobbies)
   {
       $this->hobbies = $hobbies;
   }
   public function getHobbies()
   {
       return $this->hobbies;
   }
      public function  setCourses($courses)
   {
       $this->courses = $courses;
   }
   public function getCourses()
   {
       return $this->courses;
   }
 public function insert() 
    {
        $connection = new mysqli("localhost","ss4u", "123456", "student");
        if ($connection->connect_error) {
            die('Connection failed: ' . $connection->connect_error);
        }
        $sql = "INSERT INTO (first_name,last_name,email,phone_number,address,city,pin_code,birth_date,hobbies,courses,country,gender)
            VALUES('$this->firstName','$this->lastName','$this->emailId',' $this->phoneNumber','$this->address','$this->city','$this->pinCode','$this->dateOfBirth','$this->hobbies','$this->courses','$this->country','$this->gender')";
            if ($connection->query($sql)) {
             
               echo "inserted sucessfully";
            } else {
                echo "error";
            }
           
        }
}




$student=new Student();
$student->setFirstName("kiki");
$student->setLastName("lk");
$student->setEmailId("kiki@gmail.com");
$student->setPhoneNumber(123456677);
$student->setAddress("fa euefr shrfnfjht hdth");
$student->setCity("trichy");
$student->setPinCode(620006);
$student->setDateOfBirth(08-07-1999);
$student->setHobbies("playing");
$student->setCourses("m.com");
$student->setCountry("India");
$student->setGender("male");
$student->insert();




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
