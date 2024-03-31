<?php

class tripsdb {

    var $pdo;
    var $dsn = 'mysql:host=localhost;dbname=etripsdb';
    var $user = 'root';
    var $pass = '';

    function __construct() {
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
    }

    function gettrips() {

//        $records = [];
        $statement = $this->pdo->query("select * from trips");
        $statement->setfetchmode(PDO::FETCH_ASSOC);
        $records = $statement->fetchall();
//        var_dump($records);
        return $records;
    }

    function deletetrip($id) {
        $records = [];
        $statement = $this->pdo->prepare("delete from trips  where id = $id");
        $succes = $statement->execute();
//        $count = $statement->rowCount();
//        if ($count == '0') {
//            echo "there is no row data with this $id ";
//        } else {
//            echo "the data with $id succefully deleted ";
//        }
//        $statement = $this->pdo->query("select * from trips");
//        $statement->setfetchmode(PDO::FETCH_ASSOC);
//        $records = $statement->fetchall();
//
//        return $records;
       $count = $statement->rowCount();
       
//        $statement = $this->pdo->query("select * from trips");
//        $statement->setfetchmode(PDO::FETCH_ASSOC);
//        $records = $statement->fetchall();
        return $count;
    }

    function updatetrip($id, $values) {
//        $records = [];
//         $filename = $_FILES["image"]["name"];
//        $temp_file = $_FILES["image"]["tmp_name"];
//        $destination = './static/assets/photos/';
//        $target_file = $destination . $filename;
//        move_uploaded_file($temp_file, $target_file);
        $startdate = $values[0];
        $enddate = $values[1];
        $description = $values[2];
        $location = $values[3];
        $city = $values[4];
        $country = $values[5];
        if ($id && $startdate) {
            $statement = $this->pdo->prepare("update trips set start_date=:startdate where id =$id");
            $statement->bindParam(':startdate', $startdate);
            $succes = $statement->execute();
             $count = $statement->rowCount();
        } elseif ($id && $enddate) {
            $statement = $this->pdo->prepare("update trips set end_date=:enddate where id =$id");
            $statement->bindParam(':enddate', $enddate);
            $succes = $statement->execute();
             $count = $statement->rowCount();
        } elseif ($id && $description) {
            $statement = $this->pdo->prepare("update trips set description=:description where id =$id");
            $statement->bindParam(':description', $description);
            $succes = $statement->execute();
             $count = $statement->rowCount();
        } elseif ($id && $location) {
            $statement = $this->pdo->prepare("update trips set location=:location where id =$id");
            $statement->bindParam(':location', $location);
            $succes = $statement->execute();
             $count = $statement->rowCount();
        }elseif ($id && $city) {
            $statement = $this->pdo->prepare("update trips set city=:city where id =$id");
            $statement->bindParam(':city', $city);
            $succes = $statement->execute();
             $count = $statement->rowCount();
        }elseif ($id && $country) {
            $statement = $this->pdo->prepare("update trips set country=:country where id =$id");
            $statement->bindParam(':country', $country);
            $succes = $statement->execute();
             $count = $statement->rowCount();
        } elseif ($id && $filename) {
            $statement = $this->pdo->prepare("update trips set filename=:filename where id =$id");
            $statement->bindParam(':filename', $filename);
            $succes = $statement->execute();
             $count = $statement->rowCount();
        }
//        var_dump(PDO::exec($succes));
//        var_dump(mysql_query($succes));
//        $count = $statement->rowCount();
//        if ($count == '0') {
//            echo "there is no row data with this $id to be updated ";
//        } else {
//            echo "the data with $id successfully updated ";
//        }
//        $statement = $this->pdo->query("select * from trips");
//        $statement->setfetchmode(PDO::FETCH_ASSOC);
//        $records = $statement->fetchall();
//
//        return $records;
           
       
//        $statement = $this->pdo->query("select * from trips");
//        $statement->setfetchmode(PDO::FETCH_ASSOC);
//        $records = $statement->fetchall();
        return $count;

    }

     function searchtrip($keyword) {
//        $records = [];
//       $values = ['start_date','end_date','email','description','photo1.jpg'];

//        foreach ($keyword as $key) {
            $statement = $this->pdo->query("Select * from trips"
                    . " where start_date LIKE '%$keyword%'"
                    . " OR end_date LIKE '%$keyword%'"
                    . " OR description LIKE '%$keyword%'"
                    . " OR location LIKE '%$keyword%'"
                    . " OR city LIKE '%$keyword%'"
                    . " OR country LIKE '%$keyword%'"
                    . " OR filename LIKE '%$keyword%'");
            $statement->setfetchmode(PDO::FETCH_ASSOC);
            $records = $statement->fetchall();
            return $records;
//        }
    }

    function addtrip($values) {
//        $records = [];
        $statement = $this->pdo->prepare('insert into trips' . '(start_date,end_date,description,location,city,country,filename)' . 'values (:start_date,:end_date,:description,:location,:city,:country,:filename)');
//        $id = $values['id'];
//        $filename = $_FILES["image"]["name"];
//        $temp_file = $_FILES["image"]["tmp_name"];
//        $destination = './static/assets/photos/';
//        $target_file = $destination . $filename;
//        move_uploaded_file($temp_file, $target_file);
//        $startdate = $values['start_date'];
//        $enddate = $values['end_date'];
//        $description = $values['description'];
//        $location = $values['location'];
//        $city = $values['city'];
//        $country = $values['country'];
        $statement->bindParam(":start_date", $values[0]);
        $statement->bindParam(":end_date", $values[1]);
        $statement->bindParam(":description", $values[2]);
        $statement->bindParam(":location", $values[3]);
        $statement->bindParam(":city", $values[4]);
        $statement->bindParam(":country", $values[5]);
        $statement->bindParam(":filename", $values[6]);
//        $filename = $values['filename'];
//        $statement->bindParam(":id", $id);
        $success = $statement->execute();
        $count = $statement->rowCount();
       
//        $statement = $this->pdo->query("select * from trips");
//        $statement->setfetchmode(PDO::FETCH_ASSOC);
//        $records = $statement->fetchall();
        return $count;
    }

    function gettrip($id) {
        $records = [];
        $statement = $this->pdo->query("select * from trips where id = $id");
        $statement->setfetchmode(PDO::FETCH_ASSOC);
        $records = $statement->fetchall();
        return $records;
    }

}
