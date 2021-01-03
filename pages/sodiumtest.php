<?php
//Generates cryptographically secure pseudo-random KEY from sodium library
$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
//Generates cryptographically secure pseudo-random nonce from sodium library
$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
//Authenticated secret-key encryption
$ciphertext = sodium_crypto_secretbox("password", $nonce, $key);
//Encode into 64
$encoded = base64_encode($nonce . $ciphertext);

echo $encoded . "<br>";
echo $key . "<br>";

//Decode ciphertext from base64 to plain string
$decoded = base64_decode($encoded);
$nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
$ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
$plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
echo $plaintext;
