<?php

// Start the session so we can store our generated key inside it for later retrieval

session_start( );

// Set to whatever size you want, or randomize for more security

$captchaTextSize = 9;

do {

    // Generate a random string and encrypt it with md5

    $md5Hash = md5( microtime( ) * mktime( ) );

    // Remove any hard to distinguish characters from our hash

    preg_replace( '([1aeilou0])', "", $md5Hash );

} while( strlen( $md5Hash ) < $captchaTextSize );

// we need only 7 characters for this captcha

$letras = substr( $md5Hash, 0, $captchaTextSize);

// Add the newly generated key to the session. Note, it is encrypted.

$_SESSION['key'] = md5($letras);

// grab the base image from our pre-generated captcha image background

$captchaImage = imagecreatefrompng( "images/captcha.png" );

/* 

Select a color for the text. Since our background is an aqua/greenish color, we choose a text color that will stand out, but not completely. A slightly darker green in our case.

*/ 

$textColor = imagecolorallocate( $captchaImage, 113, 198, 249 );

/* 

Select a color for the random lines we want to draw on top of the image, in this case, we are going to use another shade of green/blue

*/

$lineColor = imagecolorallocate( $captchaImage, 11, 145, 225 );

// get the size parameters of our image

$imageInfo = getimagesize( "images/captcha.png" );

// decide how many lines you want to draw

$linesToDraw = 10;

// Add the lines randomly to the image

for( $i = 0; $i < $linesToDraw; $i++ )  {

	// generate random start spots and end spots

    $xStart = mt_rand( 0, $imageInfo[ 0 ] );
    $xEnd = mt_rand( 0, $imageInfo[ 0 ] );

    // Draw the line to the captcha

    imageline( $captchaImage, $xStart, 0, $xEnd, $imageInfo[1], $lineColor );

}

/* 

Draw our randomly generated string to our captcha using the given true type font. In this case, I am using BitStream Vera Sans Bold, but you could modify it to any other font you wanted to use.

*/

imagettftext( $captchaImage, 15, 0, 10, 20, $textColor, "fonts/VeraBd.ttf", $letras);

// Output the image to the browser, header settings prevent caching


imagepng( $captchaImage );

?>