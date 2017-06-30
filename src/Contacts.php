<?php

    class Contacts {

        private $name;
        private $number;
        private $address;

        function __construct($name, $number, $address)
        {
            $this->name = $name;
            $this->number = $number;
            $this->address = $address;
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

        static function getAll()
        {
            return $_SESSION['list_of_contacts'];
        }



    }






 ?>
