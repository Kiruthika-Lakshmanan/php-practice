 <?php
namespace Student\Model\Entity;

class User {
    private $db;

    /**
     * Unique ID
     *
     * @var integer 
     */
    private $id;
    /**
     *User Id
     * 
     * @var string 
     */
    private $userId;
    /**
     *User First Name
     * 
     * @var string 
     */
    private $firstName;
    /**
     *User Last Name
     * 
     * @var string 
     */
    private $middleInitial;
    /**
     *User Last Name
     * 
     * @var string 
     */
    private $lastName;
    /**
     *User Last Name
     * 
     * @var string 
     */
    private $email;
    /**
     *User Password
     * 
     * @var string 
     */
    private $password;
    /**
     *Confirm Password
     * 
     * @var string 
     */
    private $confirmPassword;
    /**
     *Address
     * 
     * @var string 
     */
    private $address;
    /**
     *Address
     * 
     * @var string 
     */
    private $city;
    /**
     *State
     * 
     * @var string 
     */
    private $state;
    /**
     *Pincode
     * 
     * @var string 
     */
    private $pincode;
    /**
     *Country
     * 
     * @var string 
     */
    private $country;
    /**
     *User Phone Number
     * 
     * @var string 
     */
    private $phone;
    /**
     *Lanaguage
     * 
     * @var string 
     */
    private $language;
    /**
     *User profile Image
     * 
     * @var image
     */
    private $image;
    /**
     *error occur handle propertie
     * 
     * @var array 
     */
    private $errors = [];
    /**
     * Constructor
     *
     * @param integer $id User ID
     */
    public function __construct($id = 0)
    {
        $this->db = \Student\Config\Db::getMysqli();
        if (!empty($id)) {
            $this->id = $id;
            $this->get();
        }
    }
    /**
     * unique id
     * 
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * 
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setMiddleInitial($middleInitial)
    {
        $this->middleInitial = $middleInitial;
    }
    
    public function getMiddleInitial()
    {
        return $this->middleInitial;
    }
    
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;
    }
    
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }
    
    public function setCity($city)
    {
        $this->city = $city;
    }
    
    public function getCity()
    {
        return $this->city;
    }
    
    public function setState($state)
    {
        $this->state = $state;
    }
    
    public function getState()
    {
        return $this->state;
    }
    
    public function setPincode($pincode)
    {
        $this->pincode = $pincode;
    }
    
    public function getPincode()
    {
        return $this->pincode;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }
    
    public function getCountry()
    {
        return $this->country;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    public function getPhone()
    {
        return $this->phone;
    }
   
    public function setLanguage($language)
    {
        $this->language = $language;
    }
    
    public function getLanguage()
    {
        return $this->language;
    }
    
    public function setImage($image)
    {
        $this->image = $image;
    }
    
    public function getImage() {
        return $this->image;
    }
    
    public function getError()
    {
        return $this->errors;
    }

    /**
     * 
     * @return boolean
     */
    protected function fieldValidation()
    {
        if(empty($this->userId)||empty($this->firstName)||empty($this->lastName)||empty($this->email)||empty($this->password)||empty($this->confirmPassword)) {
            $this->errors[] = 'Fill Mandatory Field * ';
        }
        if (
            !empty($this->password) &&
            !empty($this->confirmPassword) &&
            ($this->password !== $this->confirmPassword)
        ) {
            $this->errors[] = 'Password Mismatch !!! ';
        }
        $query='
                SELECT * FROM `' . DB_PREFIX . 'users` 
                    WHERE userId="' . $this->userId . '" OR 
                        email="' . $this->email . '"';
        $result = $this->db->query($query);
        if ($result->num_rows != 0) {
            $this->errors[] = 'User Id or Email Already Exists';
        }
        
        if (!empty($this->errors)) {
            return false;
        } else {
            return true;
        }
    }
    protected function fileValidation()
    {
        $this->image = $_FILES['file']['name'];
        $imageSize = $_FILES['file']['size'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions= array("jpeg","jpg","png");
        if(in_array($imageFileType,$extensions)=== false) {
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        } 
        if($imageSize > 2097152) {
            $errors[]='File size must be excately 2 MB';
        }
        if(empty($errors)==true) {
            $targetDir = dirname(__FILE__);
            move_uploaded_file($this->imageTmp,$targetDir . '/images/' . $this->image);
            $query = "insert into profile (image) values('". $this->image."')";
            if(!empty($this->db->query($query))) {
                return true;    
            }
        } 
    }
    protected function loginValidation()
    {
        if (empty($this->userId) || empty($this->password)) {
            $this->errors[] = 'UserId or Password missing';
        }
        if (!empty($this->errors)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 
     */
    public function checkLogin()
    {
        if (!$this->loginValidation()) {
            return false;
        }
        $query = '
                SELECT userId, password FROM `' . DB_PREFIX . 'users`
                WHERE userId = "' . $this->userId . '" AND
                    password = "' . $this->password .'"
                ';
        $result = $this->db->query($query);
        if ($result->num_rows == 1) {
            die("success login");
            return true;
        }
        return false;
    }
 
    /**
     * To insert and update the details
     * 
     * @return string
     */
    public function save()
    {
        if (!$this->fieldValidation() || !$this->fileValidation()) {
            return false;
        }
        if (empty($this->id)) {
            $query = '
                INSERT INTO `' . DB_PREFIX . 'users` 
                    SET userId = "' . $this->userId . '",
                        firstName = "' . $this->firstName . '",
                        middleInitial = "' . $this->middleInitial . '",
                        lastName = "'. $this->lastName.'",
                        email = "' . $this->email . '",
                        password = "' . $this->password . '",
                        address = "' . $this->address . '",
                        city = "' . $this->city . '",
                        state = "' . $this->state . '",
                        pincode = "' . $this->pincode . '",
                        country = "' . $this->country . '",
                        phone = "' . $this->phone . '",
                        language = "' . $this->language . '"
                    ';
        } else {
            $query = '
                UPDATE `' . DB_PREFIX . 'users` 
                    SET userId = "' . $this->userId . '",
                        firstName = "' . $this->firstName . '",
                        middleInitial = "' . $this->middleInitial . '",
                        lastName = "'. $this->lastName.'",
                        email = "' . $this->email . '",
                        password = "' . $this->password . '",
                        address = "' . $this->address . '",
                        city = "' . $this->city . '",
                        state = "' . $this->state . '",
                        pincode = "' . $this->pincode . '",
                        country = "' . $this->country . '",
                        phone = "' . $this->phone . '",
                        language = "' . $this->language . '"            
                        WHERE id = "'.$this->id.'"
                    ';
        }
        return $this->db->query($query);
    }

    /**
     * To delete the details of user
     * 
     * @return type
     */
    public function delete()
    {
        if(empty($this->id)) {
            return false;
        }
        $query = 'DELETE FROM `' . DB_PREFIX . 'users` WHERE id = "' . $this->id . '"';
        return $this->db->query($query);
    }

    protected function get()
    {
        if (empty($this->id)) {
            return false;
        }

        $query  = 'SELECT * FROM `' . DB_PREFIX . 'users` WHERE id = "' . $this->id . '"';
        $result = $this->db->query($query);
        $user   = $result->fetch_assoc();
        
        $this->id = $user['id'];
        $this->userId = $user['user_id'];
        $this->firstName = $user['first_name'];
        $this->middleInitial= $user['middle_initial'];
        $this->lastName = $user['last_name'];
        $this->email = $user['email'];
        $this->password = $user['password'];
        $this->confirmPassword = $user['confirm_password'];
        $this->address = $user['address'];
        $this->city = $user['city'];
        $this->state = $user['state'];
        $this->pincode = $user['pincode'];
        $this->country = $user['country'];
        $this->phone = $user['phone'];
        $this->language = $user['language'];
    }        
    /**
     * To get the overall user details
     * 
     * @return boolean
     */
    public function getAll()
    {
        $result = $this->db->query('SELECT * FROM `' . DB_PREFIX . 'users`');
        $resultArray = [];
        while ($row = $result->fetch_assoc()) {
            $resultArray[] = new User($row['id']);
        }
        return $resultArray;
    }
}