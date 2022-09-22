<?php
    class User
    {
        public $firstName;
        public $lastName;
        public $email;
        public $login;
        public $address;
        protected $role;
        private $password;
        

        public function __construct($firstName, $lastName, $email, $login, $address, $password)
        {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->login = $login;
            $this->role = 'Client';
            $this->address = $address;
            $this->password = $password;
        }

        public function sign_in()
        {
            return;
        }

        public function sign_up()
        {
            return;
        }

        public function change_password()
        {
            return;
        }
    } 

    class Client extends User
    {
        public function buy($product)
        {
            return;
        }

        public function cancel_order($order)
        {
            return;
        }

        public function add_to_favorites($product)
        {
            return;
        }

        public function remove_from_favorites($product)
        {
            return;
        }

        public function add_to_basket($product)
        {
            return;
        }

        public function remove_from_basket($product)
        {
            return;
        }

        public function edit_accout()
        {
            return;
        }
    }

    class Admin extends User
    {
        public function edit_user($user)
        {
            return;
        }

        public function remove_user($user)
        {
            return;
        }

        public function add_user($user)
        {
            return;
        }

        public function export_stats()
        {
            return;
        }
    }

    class Moderator extends User
    {
        public function add_product($product)
        {
            return;
        }

        public function edit_product($product)
        {
            return;
        }

        public function remove_product($product)
        {
            return;
        }

        public function create_coupon($discont_amount)
        {
            return;
        }

        public function export_stats()
        {
            return;
        }
    }


?>