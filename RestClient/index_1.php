                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php
include_once 'app/tripsdb.php';
include_once 'config.php';
$trips = new tripsdb();
if (isset($_GET['action'])) {

    $action = $_GET['action'];
    if ($action == 'addtrip') {
        if (isset($_POST['submit'])) {
//            $records[] = $_POST;
        
            $records = $trips->addtrip($_POST);
            echo $view->render('trip_table.twig', ['records' => $records]);
        } else {
//            include_once 'includes/trip_form.php';
            echo $view->render('trip_form.twig');
        }
    } elseif ($action == 'gettrips') {


        $records = $trips->gettrips();
        echo $view->render('trip_table.twig', ['records' => $records]);
//        $records = [[
//                'name' => 'john smith',
//                'email' => 'john@yahoo.com',
//                'mobile' => '04312314124124',
//                'filename' => 'photo1.jpg'
//            ], [
//                'name' => 'susan jasmi',
//                'email' => 'susan@yahoo.com',
//                'mobile' => '56353212',   
//                'filename' => 'photo2.jpg'
//            ], [
//                'name' => 'peter williams',
//                'email' => 'peter@yahoo.com',
//                'mobile' => '12412415125',
//                'filename' => 'photo3.jpg'
//            ], [
//                'name' => 'alice rechards',
//                'email' => 'alice@yahoo.com',
//                'mobile' => '125125674364',
//                'filename' => 'photo4.jpg'
//            ]
//        ];
//        var_dump($records);
//        echo $view->render('trip_table.twig', ['records' => $records]);
    } else if ($action == 'deletetrips') {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $records = $trips->deletetrip($id);
            echo $view->render('trip_table.twig', ['records' => $records]);
        } else {
            echo $view->render('delete_form.twig');
        }
    } else if ($action == 'edittrips') {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $records = $trips->updatetrip($id, $_POST);
            echo $view->render('trip_table.twig', ['records' => $records]);
        } else {
            echo $view->render('edit_form.twig');
        }
    } else if ($action == 'searchtrips') {
        if (isset($_POST['submit'])) {
            $records = $trips->searchtrip($_POST);
            echo $view->render('trip_table.twig', ['records' => $records]);
        } else {
            echo $view->render('search_form.twig');
        }
    } elseif ($action == 'gettrip') {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $records = $trips->gettrip($id);
            echo $view->render('trip_table.twig', ['records' => $records]);
        } else {
            echo $view->render('get_trip.twig');
        }
    }
} else {
    echo $view->render('index.twig');
}




