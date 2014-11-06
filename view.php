<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Prints a particular instance of feedcam
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    mod
 * @subpackage feedcam
 * @copyright  2011 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/// (Replace feedcam with the name of your module and remove this line)

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');
require_once(dirname(__FILE__).'/locallib.php');
require_once ($CFG->dirroot.'/course/moodleform_mod.php');

$id = optional_param('id', 0, PARAM_INT); // course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // feedcam instance ID - it should be named as the first character of the module

if ($id) {
    $cm         = get_coursemodule_from_id('feedcam', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $feedcam  = $DB->get_record('feedcam', array('id' => $cm->instance), '*', MUST_EXIST);
} elseif ($n) {
    $feedcam  = $DB->get_record('feedcam', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $feedcam->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('feedcam', $feedcam->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);
$context = context_module::instance($cm->id);
//$context = get_context_instance(CONTEXT_MODULE, $cm->id);

//add_to_log($course->id, 'feedcam', 'view', "view.php?id={$cm->id}", $feedcam->name, $cm->id);

 $eventdata = array();
    $eventdata['objectid'] = $feedcam->id;
    $eventdata['context'] = $context;

    $event = \mod_feedcam\event\course_module_viewed::create($eventdata);
    $event->add_record_snapshot('course_modules', $cm);
    $event->add_record_snapshot('course', $course);
    $event->trigger();

    
 
/// Print the page header

$PAGE->set_url('/mod/feedcam/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($feedcam->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

// other things you may want to set - remove if not needed
//$PAGE->set_cacheable(false);
//$PAGE->set_focuscontrol('some-html-id');
//$PAGE->add_body_class('feedcam-'.$somevar);

$completion = new completion_info($course);
$completion->set_module_viewed($cm);

// Output starts here                         
echo $OUTPUT->header();

if ($feedcam->intro) { // Conditions to show the intro can change to look for own settings or whatever
    echo $OUTPUT->box(format_module_intro('feedcam', $feedcam, $cm->id), 'generalbox mod_introbox', 'feedcamintro');
}

// Replace the following lines with you own code

$PAGE->requires->js('/mod/feedcam/js/record.js');
//require_capability($capability, $context);
//$_SESSION['id']=0;


        //$mform    =& $this->_form;
        
//$mform->addElement('filemanager', 'my_filemanager', 'Upload a file', null, array('maxbytes' => $CFG->maxbytes, 'maxfiles' => 1, 'accepted_types' => array('*.zip')));

//if ($draftitemid = file_get_submitted_draft_itemid('my_filemanager')) {
 //   file_save_draft_area_files($draftitemid, $context->id, 'mod_assignment', 'my_filemanager', 0, array('subdirs' => false, 'maxfiles' => 1));
//}

//file_encode_url($CFG->wwwroot . '/pluginfile.php', '/' . $this->context->id . '/mod_assignment/my_filemanager');

$_SESSION['flip']=0;


if(isset($_POST['submit'])){
    $_SESSION['flip']=1;
}
if(isset($_POST['database'])){
    $_SESSION['flip']=1;
}
if(isset($_POST['delete'])){
    $_SESSION['flip']=1;
}
if(isset($_POST['back'])){
    $_SESSION['flip']=1;
}



if(((!isset($_POST['database'])) && (!isset($_POST['delete'])) && !isset($_POST['submit']) && !isset($_POST['back'])) && $_SESSION['flip']==0){
    
    
         //     $conn= mysqli_connect('localhost','root',"mummy","quizmantra");


               echo '<div class="page">';
                echo  "<fieldset><legend><font color='black'  size='4'><b>FEED CAM </b> </legend>";
                
                    
                            //   $DB->get_records_sql('SELECT subname,subid FROM {videos}');
                             //    $quer2=mysqli_query($conn,"SELECT subname,subid FROM 'subject' ");
                     
                                      echo "<form method=post name='home' action=''>";
                                            
                                               echo '<div style="border-bottom:1px solid #36AE79;height:170px;width:800px;"><br><font ><p style="text-align:justify">Lectures Tube is newly generated plugin for moodle. This provides the real user interface for recording and uploading audio-video lectures'
                                             . '. Lectures Tube is based on webRTC so, there is no need of external plugins and it gives very less load to server. Here we provide multiple options and privileges for different type of users. You can delete your recently '
                                                       . 'recorded lectures as well as multiple deletion feature for previously recorded lectures. This is one of the poweful plugin that can automatically upload the lectures on server side therefore local space does not required much.   </p></div>';
                                               
                                    
                                      
                                     echo "<br><input type=submit value=START name='submit' style='color: #36AE79;height:40px;width:100px;'> | <a href=testcategory.php>Reset</a>";

                                   echo "</form>";
                                           
            echo '</fieldset></div>';
  }







if(((!isset($_POST['database'])) && (!isset($_POST['delete'])) && (isset($_POST['back'])) || (isset($_POST['submit']))) && $_SESSION['flip']==1){
        
   echo '<body>';
       echo '<article>';
            echo '<section class="experiment">'  ;
            
             echo  "<fieldset><legend><font color='black'  size='3'><b>HOME </b> </legend>";
			
				echo '<p style="text-align:center;">';
				echo '<video id="preview" controls style="border: 1px solid rgb(15, 158, 238); height: 360px; width: 520px;"></video> <br/>';
                                   
                                 if (has_capability('mod/feedcam:godatabase', $context)) {
                                   echo  '<form method=post action="" ><input type="submit" value="Recording Database" name="database" /></form>';
                                 }
				echo'</p>';
				echo '<hr />';

			  
			// echo $OUTPUT->single_button(new moodle_url('#', array('id' => 'record')), 'Record &RightTriangleBar');
			
			//$form = new html_form();
				//$form->url = new moodle_url('http://domain.com/index.php', array('id' => 3, 'userid' => 5));
				//$form->button->text = 'My account';
				//echo $OUTPUT->button($form);
				
				
					
			     if (has_capability('mod/feedcam:record', $context)) {
                                echo '<button id="record" style="height: 40px; width: 180px;">Record &RightTriangleBar;</button>';
                             }
                             
                              echo '<button id="stop" style="height: 40px; width: 180px;" disabled>Stop &FilledSmallSquare;</button>';
                                 
                            if (has_capability('mod/feedcam:deleterecent', $context)) {
                         	     echo '<button id="delete" style="height: 40px; width: 180px;" disabled>Delete files</button>';
                           }

				 echo '<div id="container" style="padding:1em 2em;"></div>';
                echo '</fieldset>';               
             echo '</section>';
            
             //$id = optional_param('id', 0, PARAM_INT); // course_module ID
             
            // echo $id;
           //  exit();
             
         echo '<script>window.uniqueId ='.$id.' </script>';
	$PAGE->requires->js('/mod/feedcam/js/record2.js');		
           
			
       echo '</article>';
   echo '</body>';
   
    }



if(((isset($_POST['database'])) || (isset($_POST['delete']))  || !isset($_POST['back']) && !isset($_POST['submit'])) && ($_SESSION['flip']==1)){
 
    
     echo '<body>';
      echo '<fieldset><legend><font color="black"  size="4"><b style="font-family:  "Hoefler Text", Georgia, "Times New Roman", serif;">RECORDINGS </b></font> </legend>';

  

       
         //    global $DB;

          if(isset($_POST['delete']))  {   
                $names=$_POST['videoarr'];
                  foreach($names as $value){
                      
                      $idarr=array();
                     if(isset($value)){
                              
                               $idarr = (explode('/',$value,2));
                               $itemid=$idarr[0];
                               $itemname=$idarr[1];
                               
                          echo "<div  style='float:right;'><font color='#A80707'><b>".$itemid." |  </font></b></div>";
                               
                               
                            if(!($DB->record_exists('files', array('contextid' =>$context->id, 'itemid'=>$itemid)))){  

                                 $DB->delete_records('videos', array ('id'=> $itemid));
                                 echo "<div><font color='#A80707'>Sorry, Currupted media and did not store on server<font></div>";
                                 // mysqli_query($conn,"DELETE FROM mdl_videos WHERE name='$withvideoext' OR name='$withaudioext' ");

                                 //  $DB->delete_records("videos", array("name"=>$value));
                            }

                             else{
                                     fileDeletion($itemid,$itemname,$context->id);
                                     fileDeletion($itemid,".",$context->id);

                                        $vid=$DB->delete_records('videos', array ('id'=> $itemid));
                              }
                         //  if(!file_exists('uploads/'.$value)){
                        //        echo "Sorry Video had been currupted and did not stored on server<br /><br/>";
                        //         mysqli_query($conn,"DELETE FROM mdl_videos WHERE name='$value' ");   //db
                                 
                             //  $DB->delete_records("videos", array(sql_compare_text("name")=>$value));
                       //    }
                           
                       //     else{
                       //          unlink('uploads/'.$value);
                                 
                       //          mysqli_query($conn,"DELETE FROM mdl_videos WHERE name='$value' ");  //db
                           //   $DB->delete_records("videos", array(sql_compare_text("name")=>$value));
                        //     }
                                 
                       }
                          
                  }
                  echo "<div><font color='#A80707'> Successfully Deleted </font></div>"; 
             
           }
 
  
       
       
      // $DB->get_record_sql('SELECT * FROM {videos} WHERE firstname = ? AND lastname = ?', array('Martin', 'Dougiamas'));
  $query= $DB->get_records_sql('SELECT * FROM {videos}');
     
      //  $query= mysqli_query($conn,"SELECT * FROM videos "); // db 
        
    //     if (mysqli_num_rows($query) == 0){  
    //db
        if(!$query){
            
                echo "<form method='post' action='view.php?id={$cm->id}'><input type=submit name='back' value='Back to Video Capture' name='home' /></form>";
                echo "<div  style='float:right;'><font color='#A80707'><b>No Video File Exist</font></b></div>";
          }
            
        else {  
            
            echo "<table align='center'><tr><td><div align=center style><form method='post' action='view.php?id={$cm->id}'><input type=submit name='back' value='Back to Video Capture' name='home' style='height: 40px; width: 180px;' /></form></td>";
          //  echo "<div align=center><a href='view.php?id={$cm->id}'><input type=button value='Back to Video Capture' name='home' style='height: 40px; width: 180px;' /></a> | ";
          
            // echo '';
            
            if (has_capability('mod/feedcam:deletemultiple', $context)) {
               echo '<td><form action="" method=post><input type="submit" value="Delete Videos" name="delete" title="Delete" style="height: 40px; width: 180px;" /></div></td>';
            }
            
            echo '</tr></table><br/>';
            echo "<div style='overflow: scroll; width: 500px; height: 600px;margin-left:35%;'><table cellpadding=30 cellspacing=2 bordercolor=green border=1>";
            echo "<tr><th>Id</th><th>Name</th><th>Delete</th></tr>";
            
           // while($row=$DB->get_records_list($query)){   //db
        
        
        foreach ($query as $value) { 
                $id= $value->id;
                $feedcamid= $value->feedcam_id;
                $userid= $value->user_id;
                $name=$value->name;
                $urll=$value->url;

                
                $videoids=$id.'/'.$name;
               
               // $url=get_feedcam_doc_url($vid);
               //echo($url);
               
              //  echo($url);
              // exit();
                                       
                 //   $updateloginlink ="watch.php?id=$vid";
                                   
                                  
		   //  echo "<a href=\"javascript:create_window('$updateloginlink','500','800')\"><button id='edit' style='height: 40px; width: 200px;'>Update Login Data</button></a></td>";
                    
               // echo "<tr><td>$id</td><td><a href=\"javascript:create_window('watch.php?id=$id','500','800')\>$name</a><br /></td><td><input type=checkbox name=name[] value='$name' /></td></tr>";     
               // echo "<tr><td>$id</td><td><a href='watch.php?id=$id'>$name</a><br /></td><td><input type=checkbox name=name[] value='$name' /></td></tr>";
                echo "<tr><td>$id</td><td><a  href=\"javascript:create_window('watch.php?id=$id&feedcamid=$feedcamid')\">$name</a><br /></td><td><input type=checkbox name=videoarr[] value='$videoids' /></td></tr>";
            }
            
            echo "</table></div>";
     
             echo '</form>';
            
        }
      
     
      echo '</fieldset>';
   echo  '</body>';
   

    
    
    
}


// Finish the page
echo $OUTPUT->footer();
