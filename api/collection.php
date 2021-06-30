<?php
    //getting option from url
    $option=$_GET["option"];

    //parameters required to connect with db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "praktykant_api";

    //checking what option was chosen by user (adding, deleting records...)
    if($option=="add"){

        //creating object which will store result and will be sent back to client
        $obj=new stdClass();

        //creating connection with database
        $conn = new mysqli($servername, $username, $password,$dbname);

        if ($conn->connect_error) {
            $obj->result="Connection failed: " . $conn->connect_error;
            //if failed, user receives information
            echo json_encode($obj);
            return;
        }

        //query which inserts values into table
        $sql="INSERT INTO words(word) VALUES('".$_GET["query"]."');";

        //client reveives information based on outcome
        if ($conn->query($sql) === TRUE) {
            $obj->result= "New record created successfully";
        } else {
            $obj->result="Error: " . $conn->error;
        }
        //sending information to client
        echo json_encode($obj);
        //closing connection with database
        $conn->close();
    }
    if($option=="del"){
        //creating object which will store result and will be sent back to client
        $obj=new stdClass();

        //creating connection with database
        $conn = new mysqli($servername, $username, $password,$dbname);

        if ($conn->connect_error) {
            $obj->result="Connection failed: " . $conn->connect_error;
            //if failed, user receives information
            echo json_encode($obj);
            return;
        }

        //query which inserts values into table
        $sql="DELETE FROM words WHERE WORD='".$_GET["query"]."' LIMIT 1;";

        //client reveives information based on outcome
        if ($conn->query($sql) === TRUE) {
            $obj->result= "Record has been deleted";
        } else {
            $obj->result="Error: ". $conn->error;
        }
        //sending information to client
        echo json_encode($obj);
        //closing connection with database
        $conn->close();
    }
    if($option=="count"){
        //creating object which will store result and will be sent back to client
        $obj=new stdClass();

        //creating connection with database
        $conn = new mysqli($servername, $username, $password,$dbname);

        if ($conn->connect_error) {
            $obj->result="Connection failed: " . $conn->connect_error;
            //if failed, user receives information
            echo json_encode($obj);
            return;
        }

        //query which inserts values into table
        $sql="SELECT COUNT(*) FROM words WHERE word='".$_GET["query"]."';";
        $result = $conn->query($sql);
        //client reveives information based on outcome
        if ($result->num_rows > 0) {
            //getting result from mysql and saving it in $obj
            $row = mysqli_fetch_assoc($result);
            $obj->result=$row["COUNT(*)"];
        } else {
            echo $conn->error;
            $obj->result="Error: " . $conn->error;
        }
        //sending information to client
        echo json_encode($obj);
        //closing connection with database
        $conn->close();
    }
    if($option=="distinct"){
        //creating object which will store result and will be sent back to client
        $obj=new stdClass();

        //creating connection with database
        $conn = new mysqli($servername, $username, $password,$dbname);

        if ($conn->connect_error) {
            $obj->result="Connection failed: " . $conn->connect_error;
            //if failed, user receives information
            echo json_encode($obj);
            return;
        }

        //query which selects distinct values from table
        $sql="SELECT DISTINCT word FROM words";
        $result = $conn->query($sql);
        //declaration of array which stores result of query
        $result_array=array();
        if ($result->num_rows > 0) {
            //looping through entire result and adding each value into array
            while($row = mysqli_fetch_assoc($result)){
                array_push($result_array,$row["word"]);
            }
        } else {
            echo $conn->error;
            $obj->result="Error: " . $conn->error;
        }
        //adding array into object
        $obj->result=$result_array;
        //sending information to client
        echo json_encode($obj);
        //closing connection with database
        $conn->close();
    }
?>