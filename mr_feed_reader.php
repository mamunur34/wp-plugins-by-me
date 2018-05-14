<?php

/*
Plugin Name: Mr Feed Reader
Plugin URI: 
Description: This is custom plugin to read json feed and update UI. 
Version: 1.0.0
Author: Md. Mamunur Rasid
Author URI: https://www.upwork.com/fl/~018526cb97aef21e26
License: GPLv2
*/

/* 
 Array
(
    [title] => Twangcity Radio Recent Tracks
    [description] => 
    [link] => http://twangcity.com
    [date] => 1526146811
    [generator] => Centova Cast
    [category] => Music
    [items] => Array
        (
            [0] => Array
                (
                    [title] => Louvin Brothers - Have I Stayed Away Too Long
                    [link] => 
                    [description] => 
                    [date] => 1526143205
                    [enclosure] => Array
                        (
                            [url] => https://us1.internet-radio.com:2197/static/twangcity/covers/nocover.png
                            [type] => image/png
                        )

                )

            [1] => Array
                (
                    [title] => Van Morrison - Autumn Song
                    [link] => 
                    [description] => 
                    [date] => 1526142570
                    [enclosure] => Array
                        (
                            [url] => https://us1.internet-radio.com:2197/static/twangcity/covers/nocover.png
                            [type] => image/png
                        )

                )

            [2] => Array
                (
                    [title] => The New Englanders - Lost Tears
                    [link] => 
                    [description] => 
                    [date] => 1526142350
                    [enclosure] => Array
                        (
                            [url] => https://us1.internet-radio.com:2197/static/twangcity/covers/nocover.png
                            [type] => image/png
                        )

                )

            [3] => Array
                (
                    [title] => Dale Watson - Help Me Joe
                    [link] => 
                    [description] => 
                    [date] => 1526142199
                    [enclosure] => Array
                        (
                            [url] => https://us1.internet-radio.com:2197/static/twangcity/covers/nocover.png
                            [type] => image/png
                        )

                )

            [4] => Array
                (
                    [title] => John Prine - Dear Abby
                    [link] => 
                    [description] => 
                    [date] => 1526141943
                    [enclosure] => Array
                        (
                            [url] => https://us1.internet-radio.com:2197/static/twangcity/covers/nocover.png
                            [type] => image/png
                        )

                )

        )

)
 * Into a shortcode that I can use in wordpress site that shows recently played songs/artists/etc, and times in pacific time. Display should work well on all devices. Ignore "cover" field.
 */
 class Mr_feed_reader {
	public static function mr_read_feed_func( $atts, $content = "" ) {
		//return "content = $content";
            $feed = 'https://control.internet-radio.com:2199/recentfeed/twangcity/json/';
            
            $output = '';
            $obj = json_decode(file_get_contents($feed), true);
            
if($obj):
    $date = date('m-d-Y', $obj['date']);
    $input = $obj['date'];
    $oDate = new DateTime('@' . $input, new DateTimeZone('America/Los_Angeles'));

    $mr_date =  $oDate->format('d-m-Y h:i A');

        //$output.= "<h2".$obj['title']."</h1>";

     //echo $obj['title'];
    $output.= '<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 

    <div class="w3-container">
    <div class="w3-responsive">
    <a href="'.$obj['link'].'" target="_blank"><h2>'.$obj['title'].'</h2> </a>
    <p>Updated at: '.$mr_date.'<p>';

    if (!empty($obj['items'])){
        $output.= '<table class="w3-table-all w3-hoverable">';
        $output.= '<tr>
          <th>Title & Description</th>
          <th>Date & Time</th>
        </tr>';
       
      
        foreach ($obj['items'] as $item){
            $inputx = $item['date'];
                $oDatex = new DateTime('@' . $inputx, new DateTimeZone('America/Los_Angeles'));

                $mr_datex =  $oDatex->format('m-d-Y h:i A');


            $output.= '<tr>';
            $output.= '<td>'.$item['title'].'<br>'.$item['description'].'</td><td >'.$mr_datex.'</td>';

            $output.= '</tr>';
        }

        $output.= '</table>';
    }else{
        $output.= '<p>No item is exist to show here</p>';
    }
    
    $output.= '</div></div>';
else:
        $output .="<p>Feed Error Please check internet</p>";
endif;
$output .= '';



    return $output;
 
	}
        
       
        
 }
 
 
 
  add_shortcode( 'mr_read_feed', array( 'Mr_feed_reader', 'mr_read_feed_func' ) );
