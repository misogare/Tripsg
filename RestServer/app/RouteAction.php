<?php

include_once 'tripsdb.php';

//use Twig\Environment;
//use Twig\Loader\FilesystemLoader;

class RouteAction {

    var $trips;

    public function __construct() {
        $this->trips = new tripsdb();
//        $loader = new FilesystemLoader(__DIR__.'/../templates');
//        $this->view = new Environment($loader);
    }

    function index($request, $response, $args) {
        include_once __DIR__.'/../templates/home.php';
//        echo "welcome to wahtever asfasfasfasf";
    }

//    function getdata($request, $response, $args) {
//    $records = [
//            ["name" => 'John Smith', 'email' => 'johnsmith@gmail.com', 'mobile' => '0423123123', 'filename' => 'photo1.jpg'],
//            ['name' => 'Lisa Gregg', 'email' => 'lisagregg@gmail.com', 'mobile' => '0411123120', 'filename' => 'photo3.jpg'],
//            ['name' => 'Li Song', 'email' => 'song@yahoo.com', 'mobile' => '0451128823', 'filename' => 'photo4.jpg'],
//            ['name' => 'Peter Lake', 'email' => 'lake12@yahoo.com', 'mobile' => '042823773', 'filename' => 'photo6.jpg']
//        ];
//    return $response->withheader('content-type' , 'application/json')->write(json_encode($records));
//    }
    function gettrips($request, $response, $args) {
        $records = $this->trips->gettrips();
//        var_dump($records);
        return $response->withheader('content-type', 'application/json')->write(json_encode($records));
    }

    function deletetrip($request, $response, $args) {
        $id = $args['id'];
        $count = $this->trips->deletetrip($id);
        if ($count >= 1) {
            $data = ['message' => 'found and deleted'];
        } else {
            $data = ['message' => "this $id not found try again with right id "];
        }
        return $response->withheader('content-type', 'application/json')->write(json_encode($data));
    }

    function updatetrip($request, $response, $args) {
        $id = $args['id'];
        $post = $request->GetParsedBody();
        foreach ($post as $key => $value) {
            $$key = $value;
        }

        $values = [$start_date, $end_date, $description, $location, $city, $country, $image];
        $count = $this->trips->updatetrip($id, $values);
        if ($count >= 1) {
            $data = ['message' => "the $id matches the database the changes have been made "];
        } else {
            $data = ['message' => "the $id does not exist"];
        }
        return $response->withheader('content-type', 'application/json')->write(json_encode($data));
    }

    function searchtrip($request, $response, $args) {
        $keyword = $args['keyword'];
        $records = $this->trips->searchtrip($keyword);
        return $response->withheader('content-type', 'application/json')->write(json_encode($records));
    }

    function addtrip($request, $response, $args) {
        $post = $request->GetParsedBody();
        foreach ($post as $key => $value) {
            $$key = $value;
        }
        $values = [$start_date, $end_date, $description, $location, $city, $country, $image];
        $count = $this->trips->addtrip($values);
//        var_dump($count);
        if ($count>0) {
            $data = ['message' => 'saved in database'];
        } else {
            $data = ['message' => 'not saved'];
        }
        return $response->withheader('content-type', 'application/json')->write(json_encode($data));
    }

    function gettrip($request, $response, $args) {
        $id = $args['id'];
         $records = $this->trips->gettrip($id);
     return $response->withheader('content-type', 'application/json')->write(json_encode($records));

    }

}
