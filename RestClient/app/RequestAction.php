<?php

require __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use GuzzleHttp\Client;

/**
 * Description of RequestAction
 *
 * @author mesvak 
 */
class RequestAction {

    var $view;
    var $client;

    public function __construct() {
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        $this->view = new Environment($loader);
//        $this->client = new Client(['base_uri' => 'http://localhost/RestServer/']);
             $this->client = new Client(['base_uri' => 'http://54.162.204.66/RestServer/']);
//        var_dump($this->client);
    }

    function index() {
        echo $this->view->render('index.twig');
    }

    function gettrips() {
        $uri = 'trips';
        $response = $this->client->get($uri);
//        var_dump($response);
        $records = json_decode($response->getbody()->getcontents(), true);
//        var_dump($records);
//        echo " sample data in php array format : <br><br>";
//        foreach ($records as $data) {
//            foreach ($data as $key => $value) {
//                echo "$key : $value <br>";
//            }
//        }
//        $records = json_decode($contents,true);
        echo $this->view->render('trip_table.twig', ['records' => $records]);
    }

    function addtrip() {
        if (isset($_POST['submit'])) {
            $filename = $_FILES['image']['name'];
            $temp_file = $_FILES['image']['tmp_name'];
            $error_level = $_FILES['image']['error'];
            $destination = 'static/assets/photos/';
            $target_file = $destination . $filename;
            move_uploaded_file($temp_file, $target_file);
            $_POST['image'] = $filename;
            $uri = 'trips';

            $response = $this->client->request('post', $uri, ['form_params' => $_POST]);
//        var_dump($response);
            $contents = $response->getBody()->getContents();
            $data = json_decode($contents, true);
            $message = $data['message'];
            echo $this->view->render('message.twig', ['message' => $message]);
//             $records = json_decode($contents,true);
//             $message = $records['message'];
//             echo $view->render('message.twig', ['message' => $message]);
//            echo $this->view->render('trip_table.twig',['records' => $records]);
        } else {
//            include_once 'includes/trip_form.php';
            echo $this->view->render('trip_form.twig');
        }
    }

    function searchtrip() {
        if (isset($_POST['submit'])) {
            $keyword = $_POST['keyword'];
            $uri = "trips/keyword/$keyword";
            $response = $this->client->get($uri);
            $records = json_decode($response->getbody()->getcontents(), true);
//            $records = $trips->searchtrip($_POST);
            echo $this->view->render('trip_table.twig', ['records' => $records]);
        } else {
            echo $this->view->render('search_form.twig');
        }
    }

    function updatetrip() {
        if (isset($_POST['submit'])) {
            $filename = $_FILES['image']['name'];
            $temp_file = $_FILES['image']['tmp_name'];
            $error_level = $_FILES['image']['error'];
            $destination = 'static/assets/photos/';
            $target_file = $destination . $filename;
            move_uploaded_file($temp_file, $target_file);
            $_POST['image'] = $filename;
            $id = $_POST['id'];

            $uri = "trips/id/$id";
            $response = $this->client->request('PUT', $uri, ['form_params' => $_POST]);
            $contents = $response->getBody()->getContents();
            $data = json_decode($contents, true);
            $message = $data['message'];
            echo $this->view->render('message.twig', ['message' => $message]);
        } else {
            echo $this->view->render('edit_form.twig');
        }
    }

    function deletetrip() {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $uri = "delete/$id";
            $response = $this->client->delete($uri);
            $contents = $response->getBody()->getContents();
             $data = json_decode($contents, true);
             $message = $data['message'];
            echo $this->view->render('message.twig', ['message' => $message]);
        } else {
            echo $this->view->render('delete_form.twig');
        }
    }

    function gettrip() {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
             $uri = "trips/$id";
            $response = $this->client->get($uri);
        $records = json_decode($response->getbody()->getcontents(), true);
        echo $this->view->render('trip_table.twig', ['records' => $records]);
        } else {
            echo $this->view->render('get_trip.twig');
        }
    }

}
