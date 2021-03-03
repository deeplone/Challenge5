<?php

namespace common\libs;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Crypter {

    /**
     * 
     * @param string $c
     * @param string $action
     * @return string
     */
    public static function fnCrypter($c, $action = 'decrypt') {
        $key = 'd1ece99613461a7e27d877216875920c';

        return $action == 'decrypt' ? (new self)->decrypt(trim($c), $key) : (new self)->encrypt(trim($c), $key);
    }

    /**
     * 
     * @param string $data
     * @param string $key
     * @return string
     */
    protected function encrypt($data, $key) {
        return base64_encode(openssl_encrypt($data, 'aes-256-ecb', $key, OPENSSL_PKCS1_PADDING));
    }

    /**
     * 
     * @param string $data
     * @param string $key
     * @return string
     */
    protected function decrypt($data, $key) {
        return openssl_decrypt(base64_decode($data), 'aes-256-ecb', $key, OPENSSL_PKCS1_PADDING);
    }

}
