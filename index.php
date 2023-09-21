<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <link rel="shortcut icon" href="https://valveantiche.at/favicon.ico">
   <link href="./boost_files/bootstrap.min.css" rel="stylesheet" media="all">
   <link rel="stylesheet" type="text/css" href="./boost_files/bg-animation.css">
   <link href="./boost_files/database.css" rel="stylesheet" media="all">



   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta property="og:type" content="website">
   <meta name="theme-color" content="#A652BB">
   <title> Jaydips 2023 Stats </title>
   <meta property="og:site_name" content="Stats">
   <meta name="og:description" content="XP, Wins and More!">
   <meta property="og:image" content="https://i.imgur.com/KjM4AT9.gif">
   <meta http-equiv="refresh" content="33">
</head>

<body>

   <div id="background" style="opacity: 0.1"></div>

   <div id="bg" class="bg-animation">
      <div id="stars"></div>
      <div id="stars2"></div>
      <div id="stars4"></div>
      <div id="background" style="opacity: 0.1"></div>
      <div id="player" style="position: fixed; z-index: -99; width: 100%; background-color: black; opacity: 1"></div>
   </div>

   <br>
   <br>
   <br>
   <br>
   <center>
      <div class="container">
         <div class="card" style="min-width: 20rem; max-width: 35rem;">
            <h5 class="card-header">Jaydips 2023 Stats</h5>
            <div class="card-body">

               <?php
               $remaining_time = null;
               $white_remaining_time = null;
               $green_remaining_time = null;
               $blue_remaining_time = null;
               $purple_remaining_time = null;
               $pink_remaining_time = null;
               $red_remaining_time = null;
               require_once('timestamp.php');
               require_once("steam.php");
               require_once('db.php');
               $xp_per_game = 107; // xp achieved per mm game
               $game_time = 8; // game time in mins



               function formatTimeRemaining($days)
               {
                  $totalSeconds = $days * 86400;
                  $remainingDays = floor($totalSeconds / 86400);
                  $hours = floor(($totalSeconds % 86400) / 3600);
                  $minutes = floor(($totalSeconds % 3600) / 60);
                  $seconds = $totalSeconds % 60;

                  $formattedTime = "";

                  if ($remainingDays > 0) {
                     $formattedTime .= "$remainingDays days ";
                  }
                  if ($hours > 0 || $remainingDays > 0) {
                     $formattedTime .= "$hours hours ";
                  }
                  if ($minutes > 0 || $hours > 0 || $remainingDays > 0) {
                     $formattedTime .= "$minutes minutes ";
                  }
                  if ($seconds > 0 || $minutes > 0 || $hours > 0 || $remainingDays > 0) {
                     $formattedTime .= "$seconds seconds";
                  }

                  return $formattedTime;
               }
               $sql = "SELECT * FROM boost ORDER BY acc ASC";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                     if ($row['is_blacklisted'] != TRUE) {
                        if ($row['private_rank'] == "40") {
                           $private_rank = '<font color="darkgreen">40</font>';
                        } else {
                           $private_rank = $row['private_rank'];
                        }

                        if ($row['shared_secret'] != 'N/A') {
                           $shared_secret = $SteamAuth->GenerateSteamGuardCode($row['shared_secret']);
                        } else {
                           $shared_secret = "<font color='#330008'>N/A</font>";
                        }


                        $service_medal_tier = $row['service_medal_tier'];
                        $current_accum_xp = intval($service_medal_tier) * 200000;

                        $current_total_xp = (((5000 * intval($row['private_rank'])) + $row["current_xp"]));

                        $remaining_games = round(((200000 - $current_total_xp) / intval($xp_per_game)), 0);
                        
                        $remaining_time_calc = round(((((200000 - ((5000 * intval($row['private_rank'])) + intval($row["current_xp"]))) / intval($xp_per_game))) * intval($game_time)) / 60, 0);
                        $remaining_time_mins = round(((((5000 - intval($row['current_xp']))) / intval($xp_per_game)) * intval($game_time)), 0);



                        $tier_remaining_games = round(((5000 - intval($row["current_xp"])) / intval($xp_per_game)), 0);
                        $tier_remaining_time_calc =  round(((((5000 - intval($row["current_xp"])) / intval($xp_per_game))) * intval($game_time)) / 60, 0);

                        $white_remaining_games = round((((200000 - intval($current_accum_xp)) - $current_total_xp) / intval($xp_per_game)), 0);
                        $white_remaining_time_calc =  (round(((((((200000 - intval($current_accum_xp)) - ((5000 * intval($row['private_rank'])) + intval($row["current_xp"]))) / intval($xp_per_game))) * intval($game_time) / 60) / 24), 2));

                        $green_remaining_games = round((((400000 - intval($current_accum_xp)) - $current_total_xp) / intval($xp_per_game)), 0);
                        $green_remaining_time_calc =  (round(((((((400000 - intval($current_accum_xp)) - ((5000 * intval($row['private_rank'])) + intval($row["current_xp"]))) / intval($xp_per_game))) * intval($game_time) / 60) / 24), 2));

                        $blue_remaining_games = round((((600000 - intval($current_accum_xp)) - $current_total_xp) / intval($xp_per_game)), 0);
                        $blue_remaining_time_calc =  (round(((((((600000 - intval($current_accum_xp)) - ((5000 * intval($row['private_rank'])) + intval($row["current_xp"]))) / intval($xp_per_game))) * intval($game_time) / 60) / 24), 2));

                        $purple_remaining_games = round((((800000 - intval($current_accum_xp)) - $current_total_xp) / intval($xp_per_game)), 0);
                        $purple_remaining_time_calc =  (round(((((((800000 - intval($current_accum_xp)) - ((5000 * intval($row['private_rank'])) + intval($row["current_xp"]))) / intval($xp_per_game))) * intval($game_time) / 60) / 24), 2));

                        $pink_remaining_games = round((((1000000 - intval($current_accum_xp)) - $current_total_xp) / intval($xp_per_game)), 0);
                        $pink_remaining_time_calc =  (round(((((((1000000 - intval($current_accum_xp)) - ((5000 * intval($row['private_rank'])) + intval($row["current_xp"]))) / intval($xp_per_game))) * intval($game_time) / 60) / 24), 2));

                        $red_remaining_games = round((((1200000 - intval($current_accum_xp)) - $current_total_xp) / intval($xp_per_game)), 0);
                        $red_remaining_time_calc =  (round(((((((1200000 - intval($current_accum_xp)) - ((5000 * intval($row['private_rank'])) + intval($row["current_xp"]))) / intval($xp_per_game))) * intval($game_time) / 60) / 24), 2));

                        $red_overload_games = round((((1400000 - intval($current_accum_xp)) - $current_total_xp) / intval($xp_per_game)), 0);
                        $red_overload_time_calc = (round(((((((1400000 - intval($current_accum_xp)) - ((5000 * intval($row['private_rank'])) + intval($row["current_xp"]))) / intval($xp_per_game))) * intval($game_time) / 60) / 24), 2));


                        $objDateTime = new DateTime('NOW');
                        $objDateTimeC = $objDateTime->format('c');

                        if ($tier_remaining_time_calc <= 0) {
                           $tier_remaining_time = "<font color='darkgreen'>NEARLY COMPLETED!</font>";
                        } else {
                           $tier_remaining_time = $tier_remaining_time_calc . " hours) - (" . date('d/m/Y H:i:s', strtotime(date($objDateTimeC) . '+ ' . $tier_remaining_time_calc . ' hours'));
                        }


                        if ($remaining_time_calc <= 0) {
                           $remaining_time = "<font color='darkgreen'>COMPLETED!</font>";
                        }

                        if ($white_remaining_time_calc <= 0) {
                           $white_remaining_time = "<font color='darkgreen'>COMPLETED!</font>";
                        } else {
                           $formattedTime = formatTimeRemaining($white_remaining_time_calc);
                           $white_remaining_time = "$formattedTime) <br>(" . date('d/m/Y H:i:s', strtotime(date($objDateTimeC) . '+ ' . $white_remaining_time_calc * 86400 . ' seconds'));
                        }


                        if ($green_remaining_time_calc <= 0) {
                           $green_remaining_time = "<font color='darkgreen'>COMPLETED!</font>";
                        } else {
                           $formattedTime = formatTimeRemaining($green_remaining_time_calc);
                           $green_remaining_time = "$formattedTime) <br>(" . date('d/m/Y H:i:s', strtotime(date($objDateTimeC) . '+ ' . $green_remaining_time_calc * 86400 . ' seconds'));
                        }

                        if ($blue_remaining_time_calc <= 0) {
                           $blue_remaining_time = "<font color='darkgreen'>COMPLETED!</font>";
                        } else {
                           $formattedTime = formatTimeRemaining($blue_remaining_time_calc);
                           $blue_remaining_time = "$formattedTime) <br>(" . date('d/m/Y H:i:s', strtotime(date($objDateTimeC) . '+ ' . $blue_remaining_time_calc * 86400 . ' seconds'));
                        }

                        if ($purple_remaining_time_calc <= 0) {
                           $purple_remaining_time = "<font color='darkgreen'>COMPLETED!</font>";
                        } else {
                           $formattedTime = formatTimeRemaining($purple_remaining_time_calc);
                           $purple_remaining_time = "$formattedTime) <br>(" . date('d/m/Y H:i:s', strtotime(date($objDateTimeC) . '+ ' . $purple_remaining_time_calc * 86400 . ' seconds'));
                        }

                        if ($pink_remaining_time_calc <= 0) {
                           $pink_remaining_time = "<font color='darkgreen'>COMPLETED!</font>";
                        } else {
                           $formattedTime = formatTimeRemaining($pink_remaining_time_calc);
                           $pink_remaining_time = "$formattedTime) <br>(" . date('d/m/Y H:i:s', strtotime(date($objDateTimeC) . '+ ' . $pink_remaining_time_calc * 86400 . ' seconds'));
                        }

                        if ($red_remaining_time_calc <= 0) {
                           $red_remaining_time = "<font color='darkgreen'>COMPLETED!</font>";
                        } else {
                           $formattedTime = formatTimeRemaining($red_remaining_time_calc);
                           $red_remaining_time = "$formattedTime) <br>(" . date('d/m/Y H:i:s', strtotime(date($objDateTimeC) . '+ ' . $red_remaining_time_calc * 86400 . ' seconds'));
                        }

                        if ($red_overload_time_calc <= 0) {
                           $red_overload_time = "<font color='darkgreen'>COMPLETED!</font>";
                        } else {
                           $formattedTime = formatTimeRemaining($red_overload_time_calc);
                           $red_overload_time = "$formattedTime) <br>(" . date('d/m/Y H:i:s', strtotime(date($objDateTimeC) . '+ ' . $red_overload_time_calc * 86400 . ' seconds'));
                        }


                        if ($remaining_games <= 0) {
                           $remaining_games = "0";
                        }
                        if ($white_remaining_games <= 0) {
                           $white_remaining_games = "0";
                        }
                        if ($green_remaining_games <= 0) {
                           $green_remaining_games = "0";
                        }
                        if ($blue_remaining_games <= 0) {
                           $blue_remaining_games = "0";
                        }
                        if ($purple_remaining_games <= 0) {
                           $purple_remaining_games = "0";
                        }
                        if ($pink_remaining_games <= 0) {
                           $pink_remaining_games = "0";
                        }
                        if ($red_remaining_games <= 0) {
                           $red_remaining_games = "0";
                        }
                        if ($red_overload_games <= 0) {
                           $red_overload_games = "0";
                        }


                        if ($row['service_medal_tier'] == '1') {
                           $service_medal = "color:#737373";
                        } else if ($row['service_medal_tier'] == '2') {
                           $service_medal = "color:darkgreen";
                        } else if ($row['service_medal_tier'] == '3') {
                           $service_medal = "color:blue";
                        } else if ($row['service_medal_tier'] == '4') {
                           $service_medal = "color:#6a3aa2";
                        } else if ($row['service_medal_tier'] == '5') {
                           $service_medal = "color:#fc03d7";
                        } else if ($row['service_medal_tier'] == '6') {
                           $service_medal = "color:red";
                        } else {
                           $service_medal = "color:black";
                        }
                        echo "<style>
                        .form-group {
                            text-align: center; !important
                            margin: 0 auto; !important
                        }
                    
                        .stats {
                            display: inline-block; !important
                            text-align: center; !important
                            margin-top: 10px; !important
                        }
                    
                        .stats p {
                            line-height: 1.2; !important
                            margin: 5px 0; !important
                        }
                    
                        .profile-image {
                            display: block;
                            margin: 0 auto; 
                        }

                        .screenshot-image {
                           display: block;
                           margin: 0 auto; 
                       }
                    </style>
                            
                           <div class=\"form-group\">
                               <img class=\"profile-image\" width=\"125\" height=\"125\" src=\"" . $row['profile_image_url'] . "\">
                               <div class=\"stats\">
                                   <p style=\"font-weight: bold; " . $service_medal . "\">" . $row['account'] . "</p>
                                   <!--<p>2FA: " . $shared_secret . "</p> -->
                                   <p>Rank: " . $private_rank . " ~ XP: " . $row['current_xp'] . "</p>
                                   <progress value=\"" . $row['current_xp'] . "\" max=\"5000\"></progress>
                                   <p style=\"font-size: 10px; color:#c46200\">Private Rank: " . $tier_remaining_games . " games <br>(" . $tier_remaining_time . ")</p>
                                   <p style=\"font-size: 10px;\">Tier 1: " . $white_remaining_games . " games <br>(" . $white_remaining_time . ")</p>
                                   <p style=\"font-size: 10px; color:green\">Tier 2: " . $green_remaining_games . " games <br>(" . $green_remaining_time . ")</p>
                                   <p style=\"font-size: 10px; color:blue\">Tier 3: " . $blue_remaining_games . " games <br>(" . $blue_remaining_time . ")</p>
                                   <p style=\"font-size: 10px; color:#6b03fc\">Tier 4: " . $purple_remaining_games . " games <br>(" . $purple_remaining_time . ")</p>
                                   <p style=\"font-size: 10px; color:#fc03d7\">Tier 5: " . $pink_remaining_games . " games <br>(" . $pink_remaining_time . ")</p>
                                   <p style=\"font-size: 10px; color:red\">Tier 6: " . $red_remaining_games . " games <br>(" . $red_remaining_time . ")</p>
                                   <p style=\"font-size: 10px; color:red\">Tier 6 <b>MAX</b>: " . $red_overload_games . " games <br>(" . $red_overload_time . ")</p>
                                   <!-- You can add other lines similar to the above one for different tiers , for example if they ever add the black medals back-->
                                   <!-- ... -->
                               </div>
                               <div class=\"entries\" style=\"font-size: 9px; margin-top: 10px;\">
                              <p><i>Last Updated: " . $row['last_updated'] . " UTC (" . getRelativeTime($row['last_updated'] . '-1 hour', 1) . ")</i></p>
                               </div>
                           </div>
                           <br><br>";
                     }
                  }



                  $conn->close();
               } else {
                  //echo "Error: " . $sql . "<br>" . $conn->error;
               }
               ?>
               </a>
               <?php
               $filename = 'uploads/screenshot.png';

               if (file_exists($filename)) {
                  $fileTimestamp = filemtime($filename);
                  $formattedTimestamp = date('Y-m-d H:i:s', $fileTimestamp);
                  echo "<a href='" . $filename . "?v=". rand(-9999999999999, 9999999999999) . "' target='_blank'>
   <img id= 'screenshot-image' class='screenshot-image hi-michelle-no-one-will-see-this-but-its-another-easter-egg-hehe' height='175' src='$filename'></a>
   <p id='timestamp'><i>Debug image generated @ " . $formattedTimestamp . " UTC (" . getRelativeTime($formattedTimestamp) . ")</i></p>";
               } else {
                  echo "Server Screenshot Not Found!";
               }
               ?>
               <script>
                  function refreshImage() {
                     var img = document.getElementById('screenshot-image');
                     var url = img.src.split("?")[0];
                     img.src = url + '?v=' + Date.now();
                     setTimeout(refreshImage, 31000);
                  }
                  
                  function updateTimeStamp(){
                     var timestamp = Date.now();
                     var d = new Date(timestamp * 1000);

                     document.getElementById("timestamp").innerText = "Debug image generated @ '" + d.getFullYear() + "-" +("00" + (d.getMonth() + 1)).slice(-2) + "-" +("00" + d.getDate()).slice(-2) + " " +("00" + d.getHours()).slice(-2) + ":" + ("00" + d.getMinutes()).slice(-2) + ":" + ("00" + d.getSeconds()).slice(-2) +" UTC ";
                     
                  }
                  
                  window.onload = refreshImage;
               </script>
            </div>
         </div>
      </div>
      </div>
   </center>
   <style>
      input[type="submit"] {
         text-align: center;
      }

      input[type="action"] {
         text-align: center;
      }

      .content {
         position: fixed;
         bottom: 0;
         background: rgba(0, 0, 0, 0.5);
         color: #f1f1f1;
         width: 100%;
         padding: 20px;

      }

      #myVideo {
         position: fixed;
         right: 0;
         bottom: 0;
         min-width: 100%;
         min-height: 100%;
         filter: blur(4px);
         opacity: 0.3;
      }
   </style>

   <p style="text-align: center; font-size: 9px; color:white">Hi Michelle UwU ❤️, Version 2.1.4</p>
</body>

</html>