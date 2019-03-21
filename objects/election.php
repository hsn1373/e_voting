<?php
class election{
 
    // database connection and table name
    private $conn;
    private $table_name = "election";
 
    // object properties
    public $id;
    public $title;
    public $start_time;
    public $end_time;
    public $list_of_choices;
    public $number_of_votes;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    //          Get All Elections Function                
    //**************************************************************************
    //**************************************************************************
    //**************************************************************************

    // read elections
    function get_all_elections(){
 
        // select all query
        $query = " SELECT * FROM " . $this->table_name . " ORDER BY id ASC";
 
        // prepare query statement
        $stmt = $this->conn->prepare($query);
 
        // execute query
        $stmt->execute();
 
        return $stmt;
    }


    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    //          Create An Election Function                
    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    
    // create election
    function create_election(){
 
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    title=:title, start_time=:start_time, end_time=:end_time, list_of_choices=:list_of_choices, number_of_votes=:number_of_votes";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->start_time=htmlspecialchars(strip_tags($this->start_time));
        $this->end_time=htmlspecialchars(strip_tags($this->end_time));
        $this->number_of_votes=htmlspecialchars(strip_tags($this->number_of_votes));

        //**************************
        // Save ListOfChioces To DataBase With This Format
        // Choice1-Choice2-Choice3
        $choices_str="";
        for($i=0 ; $i<sizeof($this->list_of_choices);$i++)
        {
            $choices_str=$choices_str."-".$this->list_of_choices[$i];
        }
        $choices_str = substr($choices_str, 1);
        //***************************
    
        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":start_time", $this->start_time);
        $stmt->bindParam(":end_time", $this->end_time);
        $stmt->bindParam(":list_of_choices", $choices_str);
        $stmt->bindParam(":number_of_votes", $this->number_of_votes);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
     
    }


    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    //          Edit An Election Function                
    //**************************************************************************
    //**************************************************************************
    //**************************************************************************

    // edit the election
    function edit_election(){
    
        // update query
        $query = "UPDATE " . $this->table_name . "
                SET
                    title = :title,
                    start_time = :start_time,
                    end_time = :end_time,
                    list_of_choices = :list_of_choices,
                    number_of_votes=:number_of_votes
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->start_time=htmlspecialchars(strip_tags($this->start_time));
        $this->end_time=htmlspecialchars(strip_tags($this->end_time));
        $this->number_of_votes=htmlspecialchars(strip_tags($this->number_of_votes));

        //**************************
        // Save ListOfChioces To DataBase With This Format
        // Choice1-Choice2-Choice3
        $choices_str="";
        for($i=0 ; $i<sizeof($this->list_of_choices);$i++)
        {
            $choices_str=$choices_str."-".$this->list_of_choices[$i];
        }
        $choices_str = substr($choices_str, 1);
        //***************************
    
        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":start_time", $this->start_time);
        $stmt->bindParam(":end_time", $this->end_time);
        $stmt->bindParam(":list_of_choices", $choices_str);
        $stmt->bindParam(":number_of_votes", $this->number_of_votes);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    //          Remove An Election Function                
    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    

    // remove the election
    function remove_election(){


        //***************************************
        // Check The Election Running Or Not
        $query="SELECT start_time,end_time
                FROM ". $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $current_date_time=date('Y-m-d H:i:s');

        if($row['start_time']<=$current_date_time&&$row['end_time']>=$current_date_time)
        {
            return "1";
        }
        //***************************************
        else
        {
            // delete query
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
            // prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);
        
            // execute query
            if($stmt->execute()){
                return "2";
            }
        
            return "3";
        }
        
    }


    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    //          Increament Number Of Votes                
    //**************************************************************************
    //**************************************************************************
    //**************************************************************************

    // edit the election
    function increament_number_of_votes(){
    
        // update query
        $query = "UPDATE " . $this->table_name . "
                SET
                    number_of_votes=number_of_votes + 1
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // bind values
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    //          Get List Of Choices For An Election                
    //**************************************************************************
    //**************************************************************************
    //**************************************************************************

    // read elections
    function get_list_of_choices(){
 
        // select all query
        $query = " SELECT list_of_choices FROM " . $this->table_name . "
            WHERE
                id = :id";
 
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(':id', $this->id);
 
        // execute query
        if($stmt->execute()){
 
            return $stmt;
        }
        return false;
    }

    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    //          Check An Election Exists               
    //**************************************************************************
    //**************************************************************************
    //**************************************************************************

    // read elections
    function election_exists(){
 
        // select all query
        $query = " SELECT id FROM " . $this->table_name . "
            WHERE
                id = :id";
 
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(':id', $this->id);
 
        // execute query
        if($stmt->execute()){
 
            return $stmt;
        }
        return false;
    }

    //**************************************************************************
    //**************************************************************************
    //**************************************************************************
    //          Get An Election Detail               
    //**************************************************************************
    //**************************************************************************
    //**************************************************************************

    function get_election_detail(){
    
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . "
            WHERE
                id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(':id', $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->title = $row['title'];
        $this->start_time = $row['start_time'];
        $this->end_time = $row['end_time'];
        $this->list_of_choices = $row['list_of_choices'];
        $this->number_of_votes = $row['number_of_votes'];
    }
}
