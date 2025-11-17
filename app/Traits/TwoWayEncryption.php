<?php

namespace App\Traits;

trait TwoWayEncryption
{
    protected function encryptData($plaintext)
    {
        $key = base64_decode(env('ENC_KEY'));
        $iv  = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));

        $ciphertext = openssl_encrypt(
            $plaintext,
            'aes-256-cbc',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );

        return base64_encode($iv . $ciphertext);
    }
    protected function decryptData($ciphertextBase64)
    {
        $key = base64_decode(env('ENC_KEY'));
        $data = base64_decode($ciphertextBase64);

        $ivLen = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $ivLen);
        $ciphertext = substr($data, $ivLen);

        return openssl_decrypt(
            $ciphertext,
            'aes-256-cbc',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
    }
}
