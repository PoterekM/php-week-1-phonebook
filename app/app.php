<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contacts.php";

    session_start();

    if(empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig', array('contacts' => Contact::getAll()));
    });

    $app->post("/new_contact_display", function() use($app) {
        $contact = new Contact($_POST['name'], $_POST['number'], $_POST['address'], $_POST['image']);
        $contact->save();
        return $app['twig']->render('new_contact_display.html.twig', array('contacts' => $contact));
    });

    $app->get("/search", function() use ($app){
        $contacts = Contact::getAll();
        $contacts_matching_search = array();
        if (empty($contacts_matching_search) == true) {
            foreach ($contacts as $contact) {
                if ($contact->getName() == $_GET['search']) {
                    array_push($contacts_matching_search, $contact);
                }
            }
        }
        return $app['twig']->render('search.html.twig', array('contacts' => $contacts_matching_search));
    });

    $app->post("/delete", function() use($app){
        return $app['twig']->render('delete_all.html.twig', array('contacts' => Contact::deleteAll()));
    });


    return $app;
?>
