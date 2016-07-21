<?php

/*
  Brightness
*/

function get_brightness( $hex ) {
   // returns brightness value from 0 to 255
   // strip off any leading #
   $hex = str_replace('#', '', $hex);

   $c_r = hexdec(substr($hex, 0, 2));
   $c_g = hexdec(substr($hex, 2, 2));
   $c_b = hexdec(substr($hex, 4, 2));

   return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
}

/*
  Lightness
*/

function lighten( $arr, $val = '.15' ) {

  $lightness = ($arr['2'] + $val);

  $output = HSL_TO_RGB( $arr['0'], $arr['1'], $lightness );

  return $output;

}

function darken( $arr, $val = '.15' ) {

  $lightness = ($arr['2'] - $val);

  $output = HSL_TO_RGB( $arr['0'], $arr['1'], $lightness );

  return $output;

}

/*
  Hue
*/

function decrease_hue( $arr, $val = '.15' ) {

  $hue = ($arr['0'] - $val);

  $output = HSL_TO_RGB( $hue, $arr['1'], $arr['2'] );

  return $output;

}

function increase_hue( $arr, $val = '.15' ) {

  $hue = ($arr['0'] + $val);

  $output = HSL_TO_RGB( $hue, $arr['1'], $arr['2'] );

  return $output;

}

function HEX_TO_RGB ( $HEX )
  {

    $hex = str_replace("#", "", $HEX);

   if(strlen($hex) == 3)
   {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   }
   else
   {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }

   $rgb = array($r, $g, $b);

   return $rgb; // returns an array with the rgb values

  }

/*
  Hex to HSL
*/

function HEX_TO_HSL ($hexcode) {

    $redhex  = substr($hexcode,0,2);
    $greenhex = substr($hexcode,2,2);
    $bluehex = substr($hexcode,4,2);

    $var_r = (hexdec($redhex)) / 255;
    $var_g = (hexdec($greenhex)) / 255;
    $var_b = (hexdec($bluehex)) / 255;

    $var_min = min($var_r,$var_g,$var_b);
    $var_max = max($var_r,$var_g,$var_b);
    $del_max = $var_max - $var_min;

    $l = ($var_max + $var_min) / 2;

    if ($del_max == 0)
    {
            $h = 0;
            $s = 0;
    }
    else
    {
      if ($l < 0.5)
      {
              $s = $del_max / ($var_max + $var_min);
      }
      else
      {
              $s = $del_max / (2 - $var_max - $var_min);
      };

      $del_r = ((($var_max - $var_r) / 6) + ($del_max / 2)) / $del_max;
      $del_g = ((($var_max - $var_g) / 6) + ($del_max / 2)) / $del_max;
      $del_b = ((($var_max - $var_b) / 6) + ($del_max / 2)) / $del_max;

      if ($var_r == $var_max)
      {
              $h = $del_b - $del_g;
      }
      elseif ($var_g == $var_max)
      {
              $h = (1 / 3) + $del_r - $del_b;
      }
      elseif ($var_b == $var_max)
      {
              $h = (2 / 3) + $del_g - $del_r;
      };

      if ($h < 0)
      {
              $h += 1;
      };

      if ($h > 1)
      {
              $h -= 1;
      };
    }

    $HSL['0'] = $h;
    $HSL['1'] = $s;
    $HSL['2'] = $l;

    return $HSL;

}

/*
  Source: http://stackoverflow.com/questions/1773698/rgb-to-hsv-in-php
*/

  function RGB_TO_HSL ( $R, $G, $B )
  {

     $HSL = array();

     $var_R = ($R / 255);
     $var_G = ($G / 255);
     $var_B = ($B / 255);

     $var_Min = min($var_R, $var_G, $var_B);
     $var_Max = max($var_R, $var_G, $var_B);
     $del_Max = $var_Max - $var_Min;

     $V = $var_Max;

     if ($del_Max == 0)
     {
        $H = 0;
        $S = 0;
     }
     else
     {
        $S = $del_Max / $var_Max;

        $del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
        $del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
        $del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;

        if      ($var_R == $var_Max) $H = $del_B - $del_G;
        else if ($var_G == $var_Max) $H = ( 1 / 3 ) + $del_R - $del_B;
        else if ($var_B == $var_Max) $H = ( 2 / 3 ) + $del_G - $del_R;

        if ($H<0) $H++;
        if ($H>1) $H--;
     }

     $HSL['0'] = $H;
     $HSL['1'] = $S;
     $HSL['2'] = $V;

     return $HSL;
  }

  /*
    Source: http://stackoverflow.com/questions/20423641/php-function-to-convert-hsl-to-rgb-or-hex
  */

  function HSL_TO_RGB( $h, $s, $l )
  {

    $r = $l;
    $g = $l;
    $b = $l;
    $v = ($l <= 0.5) ? ($l * (1.0 + $s)) : ($l + $s - $l * $s);

    if ($v > 0)
    {
      $m;
      $sv;
      $sextant;
      $fract;
      $vsf;
      $mid1;
      $mid2;

      $m = $l + $l - $v;
      $sv = ($v - $m ) / $v;
      $h *= 6.0;
      $sextant = floor($h);
      $fract = $h - $sextant;
      $vsf = $v * $sv * $fract;
      $mid1 = $m + $vsf;
      $mid2 = $v - $vsf;

      switch ($sextant)
      {
        case 0:
          $r = $v;
          $g = $mid1;
          $b = $m;
          break;

        case 1:
          $r = $mid2;
          $g = $v;
          $b = $m;
          break;

        case 2:
          $r = $m;
          $g = $v;
          $b = $mid1;
          break;

        case 3:
          $r = $m;
          $g = $mid2;
          $b = $v;
          break;

        case 4:
          $r = $mid1;
          $g = $m;
          $b = $v;
          break;

        case 5:
          $r = $v;
          $g = $m;
          $b = $mid2;
          break;
      }
    }

    $RGB['0'] = round( $r * 255.0 );
    $RGB['1'] = round( $g * 255.0 );
    $RGB['2'] = round( $b * 255.0 );

    return $RGB;
  }

function RGB_TO_HEX( $rgb )
{

   $hex = "#";
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}

?>
