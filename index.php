<?php 
  error_reporting('E_ALL');
  include("Color.php");

  use Mexitek\PHPColors\Color;

?>
<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <title>Color Gen</title>
    
    <?php

      
      if( isset( $_GET['hex'] ) ) {
      
      // get the submitted hex code
      $hex = htmlentities( $_GET['hex'] );
      
      // convert the hex code to HSL
      $hsl = HEX_TO_HSL( $hex );
      
      // convert the HSL to RGB, to later convert to hex
      $rgb = HSL_TO_RGB($hsl[0], $hsl[1], $hsl[2]);
      $rgb_light = lighten( $hsl );
      $rgb_dark = darken( $hsl );
      
      
      // convert the RGB back into HEX for output
      $outout_hex = RGB_TO_HEX( $rgb );
      
      $color_primary = '#' . $hex;
      $color_primary_dark = RGB_TO_HEX( $rgb_dark );
      $color_primary_light = RGB_TO_HEX( $rgb_light );
      
      $color_secondary_rgb = decrease_hue( $hsl ); // outputs RGB array
      $color_secondary_hsl = RGB_TO_HSL( $color_secondary_rgb[0], $color_secondary_rgb[1], $color_secondary_rgb[2]); // outputs HSL
      $color_secondary = RGB_TO_HEX( $color_secondary_rgb ); // outputs HEX string
      
      $color_secondary_rgb_dark = darken( $color_secondary_hsl );
      $color_secondary_rgb_light = lighten( $color_secondary_hsl );
      
      $color_secondary_dark = RGB_TO_HEX( $color_secondary_rgb_dark );
      $color_secondary_light = RGB_TO_HEX( $color_secondary_rgb_light );
      
      $color_tertiary_rgb = increase_hue( $hsl ); // outputs RGB array
      $color_tertiary_hsl = RGB_TO_HSL( $color_tertiary_rgb[0], $color_tertiary_rgb[1], $color_tertiary_rgb[2]); // outputs HSL
      $color_tertiary = RGB_TO_HEX( $color_tertiary_rgb ); // outputs HEX string
      
      $color_tertiary_rgb_dark = darken( $color_tertiary_hsl );
      $color_secondary_rgb_light = lighten( $color_tertiary_hsl );
      
      $color_tertiary_dark = RGB_TO_HEX( $color_tertiary_rgb_dark );
      $color_tertiary_light = RGB_TO_HEX( $color_secondary_rgb_light );
      
    ?>
    
    <style>
      
      body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      
    	.block {
    		width: 33.333333%;
    		padding: 20px 0;
    		margin: 0;
    		float: left;
    		display: flex;
    		align-items: center;
    		text-align: center;
    		height: 100px;
    		color: #fff;
    	}
    	
    	.block--content {
      	text-align: center;
        width: 100%;
    	}
    	
    	.hex {
      	margin: 0;
      	padding: 0;
      	font-size: 16px;
    	}
    	
    	.label {
      	margin: 0 0 10px;
      	padding: 0;
      	text-transform: uppercase;
      	font-size: 20px;
      	font-weight: 700;
    	}
    	
      .row:before,
      .row:after {
        content: " ";
        display: table;
      }
      
      .row:after {
        clear: both;
      }
    	
    	.color-primary {
      	background: <?php echo $color_primary; ?>;
      	color: <?php if ( get_brightness( $color_primary ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}
    	
    	.color-primary-light {
      	background: <?php echo $color_primary_light; ?>;
      	color: <?php if ( get_brightness( $color_primary_light ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}
    	
    	.color-primary-dark {
      	background: <?php echo $color_primary_dark; ?>;
      	color: <?php if ( get_brightness( $color_primary_dark ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}
    	
    	.color-secondary {
      	background: <?php echo $color_secondary; ?>;
      	color: <?php if ( get_brightness( $color_secondary ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}
    	
    	.color-secondary-light {
      	background: <?php echo $color_secondary_light; ?>;
      	color: <?php if ( get_brightness( $color_secondary_light ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}
    	
    	.color-secondary-dark {
      	background: <?php echo $color_secondary_dark; ?>;
      	color: <?php if ( get_brightness( $color_secondary_dark ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}
    	
    	.color-tertiary {
      	background: <?php echo $color_tertiary; ?>;
      	color: <?php if ( get_brightness( $color_tertiary ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}
    	
    	.color-tertiary-light {
      	background: <?php echo $color_tertiary_light; ?>;
      	color: <?php if ( get_brightness( $color_tertiary_light ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}
    	
    	.color-tertiary-dark {
      	background: <?php echo $color_tertiary_dark; ?>;
      	color: <?php if ( get_brightness( $color_tertiary_dark ) > 130 ) { echo '#000'; } else { echo '#fff'; } ?>;
    	}

    </style>
    
    <?php } ?>
    
  </head>
  <body>

  <?php if( isset($_GET['hex']) ) {  ?>

  <div class="row">

    <div class="block color-secondary-dark">
      <div class="block--content">
      <p class="hex"><?php echo $color_secondary_dark; ?></p>
      </div>
    </div><!--/.block.color-*-->
    
    <div class="block color-secondary">
      <div class="block--content">
      <p class="hex"><?php echo $color_secondary; ?></p>
      </div>
    </div><!--/.block.color-*-->
    
    <div class="block color-secondary-light">
      <div class="block--content">
      <p class="hex"><?php echo $color_secondary_light; ?></p>
      </div>
    </div><!--/.block.color-*-->
    
  </div><!--/.row-->
  
  <div class="row">
  
    <div class="block color-primary-dark">
      <div class="block--content">
      <p class="hex"><?php echo $color_primary_dark; ?></p>
      </div>
    </div><!--/.block.color-*-->
    
    <div class="block color-primary">
      <div class="block--content">
        <p class="label">Base Color</p>
        <p class="hex"><?php echo $color_primary; ?></p>
      </div>
    </div><!--/.block.color-*-->
    
    <div class="block color-primary-light">
      <div class="block--content">
      <p class="hex"><?php echo $color_primary_light; ?></p>
      </div>
    </div><!--/.block.color-*-->
  
  </div><!--/.row-->
  
  <div class="row">
    
    <div class="block color-tertiary-dark">
      <div class="block--content">
      <p class="hex"><?php echo $color_tertiary_dark; ?></p>
      </div>
    </div><!--/.block.color-*-->
  
    <div class="block color-tertiary">
      <div class="block--content">
      <p class="hex"><?php echo $color_tertiary; ?></p>
      </div>
    </div><!--/.block.color-*-->
    
    <div class="block color-tertiary-light">
      <div class="block--content">
      <p class="hex"><?php echo $color_tertiary_light; ?></p>
      </div>
    </div><!--/.block.color-*-->
  
  </div><!--/.row-->
  
  <?php } ?>

  </body>
</html>
