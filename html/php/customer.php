<?php
    class Customer {

        // Private Customer properties
        private $number;
        private $name;
        private $email;
        private $phone;
        
        // Getters/Setters
        public function getNumber() {
            return $this->number;
        }

        public function getName() {
            return $this->name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPhone() {
            return $this->phone;
        }

        public function setNumber($num) {
            $this->number = $num;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
        }
    }
?>