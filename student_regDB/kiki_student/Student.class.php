<?php
namespace Student\Model\Entity;


class Student {
   protected $id;
   protected $errors = [];
   protected $firstName;
   protected $lastName;
   protected $emailId;
   protected $dateOfBirth;
   protected $phoneNumber;
   protected $gender;
   protected $address;
   protected $city;
   protected $pincode;
   protected $country;
   protected $hobbies;
   protected $courses;
   protected $qualifications = [];
   
   public function __construct()
    {
        $this->db = \Student\Config\Db::getInstance();
    }
   public function setId($id)
   {
       $this->id = $this->db->insert_id;     
   }
   public function getId()
   {
       return $this->id;
   }

   public function setQualification($qualification)
   {
       $this->qualifications[] = $qualification;
       $qualification->setStudent($this);
   }
   public function getQualification()
   {
       return $this->qualifications;
   }
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
   public function  setErrors($errors)
   {
       $this->errors[] = $errors;
   }
   public function getErrors()
   {
       return $this->errors;
   }
   public function validation()
    {
        if (empty($this->firstname)) {
            $this->errors['first_name'] = 'Name field is required';
        }
        if (empty($this->lastName)) {
            $this->errors['last_name'] = 'Name field is required';
        }
        if(empty($this->emailId)) {
            $this->errors['email'] = 'Email is required';
        }
        if (empty($this->errors)) {
            return true;
        } else {
         return false;
        }
    }
     
    public function insert() 
    {
        if ($this->validation() == true) {
            if (empty($this->id)) {

                    $sql = "INSERT INTO studentDetails(first_name,last_name,email,phone_number,address,city,pin_code,birth_date,hobbies,courses,country,gender)
                    VALUES('$this->firstName','$this->lastName','$this->emailId',' $this->phoneNumber','$this->address','$this->city','$this->pinCode','$this->dateOfBirth','$this->hobbies','$this->courses','$this->country','$this->gender')";
                    if ($db->query($sql)) {
                        $this->id = $db->insert_id;
                        foreach ($this->qualifications as $qualifications) {
                           $qualifications->setStudent($this);
                           $qualifications->insert(); 
                        }
                    } else {            
                    $sql = '
                       UPDATE  studentDetails
                            SET first_name = "' . $this->firstName . '",
                                last_name = "'. $this->lastName.'",
                                email = "' . $this->emailId . '",
                                phone_number = "' . $this->phoneNumber . '", 
                                address = "' . $this->address . '",
                                city = "' . $this->city . '",
                                pin_code = "' . $this->pincode . '",
                                birth_date = "' . $this->dateOfBirth . '",
                                hobbies = "' . $this->hobbies . '",
                                courses = "' . $this->courses . '",     
                                country = "' . $this->country . '",
                                gender = "' . $this->gender . '",          
                                WHERE student_id = "'.$this->id.'"
                            ';
                    }
                    return $this->db->query($sql);
                   
            }
        }
    }    
    public function delete()
    {
         if(!empty($this->id)) {
               $sql = "DELETE FROM studentDetails WHERE id = '$this->id'";
                return $this->db->query($sql); 
                $qualification = new Qualification();
                $deleteQualification = $qualification->deleteQualification();
                
         }
    }     
    public function getStudent()
    {
        if (empty($this->id)) {
            return false;
        }

        $query  = 'SELECT * FROM studentDetails WHERE student_id = "' . $this->id . '"';
        $result = ->query($query);
        $user   = $result->fetch_assoc();
        
        $this->id = $user['student_id'];
        $this->firstName = $user['first_name'];
        $this->lastName = $user['last_name'];
        $this->emailId = $user['email'];
        $this->phoneNumber = $user['phone_number'];
        $this->address = $user['address'];
        $this->city = $user['city'];
        $this->pincode = $user['pin_code'];
        $this->dateOfBirth = $user['birth_date'];
        $this->hobbies = $user['hobbies'];
        $this->courses = $user['courses'];
        $this->country = $user['country'];
        $this->gender = $user['gender'];
       
        $qualification = new Qualifiation();
        $getQualification = $qualification->getQualification();
    }
}