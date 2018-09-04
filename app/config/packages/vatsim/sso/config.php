<?php
/*
 * DO NOT PUBLISH THE KEY, SECRET AND CERT TO CODE REPOSITORIES
 * FOR SECURITY. PLEASE USE LARAVEL'S .env.php FILES TO PROTECT
 * SENSITIVE DATA.
 * http://laravel.com/docs/configuration#protecting-sensitive-configuration
 */

return array(

	/*
	 * The location of the VATSIM OAuth interface
	 */
	'base' => 'https://cert.vatsim.net/sso/',

	/*
	 * The consumer key for your organisation (provided by VATSIM)
	 */
	'key' => 'ZJX15ARTCC',

	 /*
	 * The secret key for your organisation (provided by VATSIM)
	 * Do not give this to anyone else or display it to your users. It must be kept server-side
	 */
	'secret' => 'cXNNp1R4bU8Th514rtf',

	/*
	 * The URL users will be redirected to after they log in, this should
	 * be on the same server as the request
	 */
	'return' => 'http://www.zjxartcc.org/login',

	/*
	 * The signing method you are using to encrypt your request signature.
	 * Different options must be enabled on your account at VATSIM.
	 * Options: RSA / HMAC
	 */
	'method' => 'RSA',

	/*
	 * Your RSA **PRIVATE** key
	 * If you are not using RSA, this value can be anything (or not set)
	 */
	'cert' => '-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEA1aOAI1PBSq54WysVbZYsWqYZHZBSK5ig8BnkqnaFheUL+KWd
VoYxuMOT0qstdAmoW2Qx0Cbd7LRxzakndw0UiHk9QPvEXnosL3191hc2qnbiE2Wy
qh1Tz23g6WJrwD6OrqzEHVRbD2pXMmOg1zDcz0YJIaH9dmxUTWuawRzC61p6TYTU
vW7YNi1cHbRSFeJOTNLu+9t2wbMJGhBShFfhKovM/MyTuSs/1jy905+WnT46NhbP
wegJ9Hst9up0Iycx71U4Uf89NBDdH5o1ws/k5ijgJsg1pBQu8tMnQy5oPbgKHhgR
8HSzPnIsr4GKZIE8OUn5mXznRDV8/wqpcyGghwIDAQABAoIBAQCnGfz3JOLShEcV
oExhbA4DVVnduu3atcZkJwypnIzx3ucPNJMtg0dO6oMsS8IAujEaUvN3iX8aT0WY
hI+e2fdOi+4ybvr4nv0CpFiR5ZRXnydT3r7xuoC8hYhfZCE9vHCkBfRbsIiNNTNA
8ZZz2v9LjM9FpEv5neAOsnTYSaPYq32SbN4rSj8Kv//z/32bawPJ8m/GER/YhYAg
YellFNQ5dE4TPPNuY0YigaYbH3Bz5eeXwLEQUx3x5xaw68OarqlJ95r4tyYFRsha
g1vua+2d+vupW5CuC8eERPKKpPMRusIBRRDkyMs/6Sa4w2T4+l3T/rAumPFdfsx2
V7tSz9oRAoGBAOxoAY+mpLvDlMDPoh3yEqpmCpn7OELc8oV15fvgg112RNN+AC8m
bju/6hzSF7AOnLCFP7CZu6WghJSw29zcEt75bhIrUfsT3z1hRtGfLWFK9ftMaezl
VOCazzlGK/FQLzJWslaZirsutxtwXQK4dY0i4ht3/Khb51E/142tbuZfAoGBAOdY
ay48RxsE9N+LLltrJeLufLvHC/A4kL916QmP0+27QZu7+vqgsrxQVbE1M5ppQ4R1
b0a+o2OHYcDKobulp8dNxhVvNGxwLz0awIdnPW8vn7xvOEY1xza7UJG8OrbHRV/l
hrET1d4mF5LxS3whAnS11AXgiGGYC496M2y+OebZAoGBAMjwqosIkTMLze+JTPn5
HYZ6z34Me8jRds6b5M0QC3iwo1XE3rE1EDN3L64poXrDIMolqHoaYdYpNygPoAH9
iYi/KKEG81rfjDvm6EQa8X6mMajVTZ/PWjLDQ2oiTA2EI2m9KT7UqYfq8DbBbj12
vmwlf1zrwvTzkQ2Nn1FMXlwvAoGBAJy0H6Wp3uBGczgYpsX1xiv5LzRil4uYRTPr
QnbfncYiWUaMBm1N/MPiBqmKR/IH61wFz+Izr6jzQxu8JeFdTFCMNei+8tuhAd56
CH+vRsXRlHmnPI8STmacau7MeVjlkfBrINlBflSDqOQ33dGu6mLz5zIz7S1uOCZv
t/WoxL/BAoGAZL+pKzJx/hJWHLlzKm5e4Vu3rQzbXawOwQpoeAdd+pQxJwTCrwIO
NI5sSWUHgEIonhwskwOQTCPfAQApml3/NVF2Mb3gVscp0CI4wl42h8t53TInAnow
FomZciljAAW1Kallcly4TOQDZ9fF+79OGKRYRWgQtxH2I0lo7rjTrNg=
-----END RSA PRIVATE KEY-----'
	
);
