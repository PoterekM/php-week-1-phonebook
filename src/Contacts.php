<!-- source folder -->


<?php

    class Contact {

        private $name;
        private $number;
        private $address;
        private $image;

        function __construct($name, $number, $address, $image)
        {
            $this->name = $name;
            $this->number = $number;
            $this->address = $address;
            $this->image = $image;
        }

        function getName()
        {
            return $this->name;
        }
        function getNumber()
        {
            return $this->number;
        }
        function getAddress()
        {
            return $this->address;
        }
        function getImage()
        {
            return $this->image;
        }
        function setName($new_name)
        {
            $this->name = $new_name;
        }
        function setNumber($new_number)
        {
            $this->number = $new_number;
        }
        function setAddress($new_address)
        {
            $this->address = $new_address;
        }
        function setImage($new_image)
        {
            $this->image = $new_image;
        }

        static function getAll()
        {
            return $_SESSION['list_of_contacts'];
        }
        // way to loop through all of our saved tasks.
        // this is a static method.
        // it is a getter but it works on the whole class
        // static methods are called on the class itself rather than on one instance. Classes are the car factory.
        // function save()
        {
            array_push($_SESSION['list_of_contacts'], $this);
        }

        static function deleteAll()
        {
            return $_SESSION['list_of_contacts'] = array();
        }



    }



 ?>
