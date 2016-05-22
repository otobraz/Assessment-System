<?php

namespace SISNTI\AutBundle\Services;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class CustomLDAPPasswordEncoder implements PasswordEncoderInterface {

    public function __construct() {

    }
    
    public function encodePassword($raw, $salt) {
        $password = base64_encode($this->hexToStr(md5($raw)));
        return $password;
    }

    public function isPasswordValid($encoded, $raw, $salt) {
        $password = base64_encode($this->hexToStr(md5($raw)));
        return $password == $encoded;
    }

    function hexToStr($hex) {
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i+=2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        return $string;
    }

}
