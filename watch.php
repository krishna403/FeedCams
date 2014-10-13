<?php
/**
 * watch and play the audio video files.

 *
 * @package    mod
 * @subpackage newmodule
 * @copyright  2014 krishna
 * @license    http://www.vidyamantra.com
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
//require_once(dirname(__FILE__).'/lib.php');
global $DB;




echo '<script src="http://localhost/moodle27d/mod/newmodule/js/need.js"></script>';

echo '<body>';
echo '<fieldset><legend><font color="black"  size="4"><b style="font-family:  "Hoefler Text", Georgia, "Times New Roman", serif;">RECORDINGS </b></font> </legend>';

$id2='';
$url2='';

       if(isset($_GET['id'])){
           
           $id=$_GET['id'];
           $id2=$id+1;
           
           //fetching video from database
           $query = $DB->get_records_sql('SELECT * FROM {videos} WHERE id = ?', array($id));
               
           foreach ($query as $value) { 
                    $url=  $value->url;
                    $name=$value->name;
               }
           
         //  while($row=mysqli_fetch_assoc($query)){
            
         //      $url=$row['url'];
         //      $name=$row['name'];
         //  }
           
            // fetching audio from database
            $query2 = $DB->get_records_sql('SELECT * FROM {videos} WHERE id = ?', array($id2));
         //  $query= mysqli_query($conn,"SELECT * FROM videos WHERE id='$id' ");
            
            foreach ($query2 as $value2) { 
                $url2=  $value2->url;
                $name2=$value2->name;
            }
           
               echo "<font color='green'><b><div align='center'>you are watching : ".$name." .wav </b><br/><br/></font>";
             //  echo "<video src='$url' id='player' style='border: 1px solid rgb(15, 158, 238); height: 500px; width: 700px;' autoplay></video></div><br/><br/>";
             //  echo "<audio autoplay src='$url2'></audio>"; 
               
               
            //  echo "<div align=center><A HREF='javascript:history.go(0)'><input type=button value='REPLAY' name='home' style='height: 30px; width: 220px;' /></A><a href='javascript:window.close()'><button id='edit' name='database' style='height: 30px; width: 200px;'>Close this Window</button></a></a></div>";
             
         
             

                  //  function goFullscreen(id) {
                      // Get the element that we want to take into fullscreen mode
                 //     var element = document.getElementById(id);


                  //    if (element.mozRequestFullScreen) {
                  //      element.mozRequestFullScreen();
                  //    }
                 //     else if (element.webkitRequestFullScreen) {
                 //       element.webkitRequestFullScreen();
                 //    }
                 //   }
             

             //     echo '<img class="video_player" src="image.jpg" id="player"></img>';
               //  echo '<div align="center"> <button onclick="goFullscreen('player'); return false" style="height: 30px; width: 200px;" >Click for Full Screen</button></div>';
                 
              // echo "<video src='$url' id='video' style='border: 1px solid rgb(15, 158, 238); height: 500px; width: 700px;' autoplay></video></div><br/><br/>";
              
            //  echo '<script type="text/javascript" charset="utf-8" src="/mod/newmodule/js/need.js"></script>';
           // $PAGE->requires->js('/mod/newmodule/js/need.js'); 
//            $PAGE->requires->js('/mod/newmodule/js/need.js');		

                
             echo '<div id="video-container">';
                      //  <!-- Video -->
                         
                      echo "<audio src='$url2'  id='audio' autoplay></audio>";
                       echo "<video src='$url' id='video' style='border: 1px solid rgb(15, 158, 238); height: 500px; width: 700px;' autoplay></video></div><br/><br/>";
                       
                        echo "<A HREF='javascript:history.go(0)'><input type=button value='REPLAY' name='home' style='height: 30px; width: 150px;' /></A><button type='button' id='full-screen' style='height: 30px; width: 150px;'>Full-Screen</button><a href='javascript:window.close()'><button id='edit' name='database' style='height: 30px; width: 150px;'>Close this Window</button></a></a><br><br>";
  
                         
                       echo '</video>';
                         echo '<!-- Video Controls -->';
                         echo '<div id="video-controls">';
                         echo '<button type="button" id="play-pause" style="height: 30px; width: 100px;">Play</button>';
                         echo '<input type="range" id="seek-bar" value="0"><br>';
                         echo '<button type="button" id="mute" style="height: 30px; width: 100px;">Mute</button>';
                         echo '<input type="range" id="volume-bar" min="0" max="1" step="0.1" value="1"><br>';
                        
                       echo '</div>';
                     echo '</div>';
 
       }
       
      else{
          echo 'error';     
      }
     
     echo '</fieldset>';
     
  echo '</body>';
   