<!-- this file folder holds our routes -->


<?php
    date_default_timezone_set('America/Los_Angeles');
    // avoid any timezone errors
    require_once __DIR__."/../vendor/autoload.php";
    // opens the autoload file which composer put into the vendor folder. loads silex files into project.
    require_once __DIR__."/../src/Contacts.php";
    // telling silex where to find our class declaration
    // any time we include external files in code we need to include this.

    session_start();
// starts our session
    if(empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
        // storing the objects in cookies on user's browser. session is a built in php variable




    $app = new Silex\Application();
    // creates new instance of the silex application and stores it in a variable called app.
    // app represents our entire website as an entity.
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
        // telling twig to look at our template files in a folder called views
    ));

    $app->get("/", function() use ($app) {
        // use is giving the route access the app variable
        // get: indicates a resource is being retrieved
        return $app['twig']->render('home.html.twig', array('contacts' => Contact::getAll()));
        // tells the app object to use twig to render a file called home.html.twig
        // render is a method
    });

    $app->post("/new_contact_display", function() use($app) {
        // post indicates a resource is being retrieved
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
