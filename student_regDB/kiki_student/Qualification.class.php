<?php

class Qualification {
    protected $id;
    protected $board;
    protected $percent;
    protected $year;
    protected $name;
    protected $student;
    
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setStudent($student)
    {
        $this->student = $student;
    }
    public function getStudent()
    {
        return $this->student;
    } 
    
    public function  setBoard($board)
    {
        $this->board = $board;
    }
    public function getBoard()
    {
        return $this->board;
    }
    public function  setPercent($percent)
    {
        $this->percent = $percent;
    }
    public function getPercent()
    {
        return $this->percent;
    } 
    public function  setYear($year)
    {
        $this->year = $year;
    }
    public function getYear()
    {
        return $this->year;
    }
    public function  setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

   public function insert() {
        $db = DB::getInstance();
//            echo var_dump(var_export($this->student, true));die;             
            $sql = "INSERT INTO student_qualification(student_id,name,board,percent,year)
            VALUES({$this->student->getId()},'$this->name','$this->board', $this->percent,$this->year)";
            if ($db->query($sql)) {
               echo "sucess";
            } else {
               echo "error ";
            }
            
        }
       
   }


//$qualification = new Qualification();
//$qualification ->setName("tenth");
//$qualification ->setBoard("cbse");
//$qualification ->setPercent(9);
//$qualification ->setYear(2014);


