<?php

$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
$ciphertext = sodium_crypto_secretbox("password", $nonce, $key);
$encoded = base64_encode($nonce . $ciphertext);

echo $encoded . "<br>";
echo $key . "<br>";


$decoded = base64_decode($encoded);
$nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
$ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
$plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
echo $plaintext;
