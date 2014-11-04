
<?php
/**
 * save and upload the audio video files into directories and link of files in database

 *
 * @package    mod
 * @subpackage feedcam
 * @copyright  2014 krishna
 * @license    http://www.vidyamantra.com
 */


require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');
require_once(dirname(__FILE__).'/locallib.php');
require_once ($CFG->dirroot.'/course/moodleform_mod.php');
global $DB,$USER;



$id = optional_param('cmid', 0, PARAM_INT);
//$id= $_GET['id'];
//echo $id;


if ($id) {
    $cm         = get_coursemodule_from_id('feedcam', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $feedcam  = $DB->get_record('feedcam', array('id' => $cm->instance), '*', MUST_EXIST);
} 

$context = context_module::instance($id);

//$conn=mysqli_connect('localhost','root',"mummy","moodle27d");
 



if (isset($_POST['delete-file'])) {
  
 //   $fileName = 'uploads/'.$_POST['delete-file'];
    $name=$_POST['delete-file'];
    $withvideoext=$_POST['delete-file'].'.webm';
    $withaudioext=$_POST['delete-file'].'.wav';
    
    
   // $vext="$withvideoext";
    
   // echo $withvideoext;
  //  exit();
       // $videoitemid = $DB->get_record_sql('SELECT id FROM {videos} WHERE name = ?', array($withvideoext));
          //  $videoitemid = $DB->get_field('videos', 'id', array ('name' => $vext));
         $sql='SELECT id FROM {videos} WHERE name = ?';    
         $videoitemid = $DB->get_field_sql($sql, array($withvideoext));
         $audioitemid=$videoitemid+1;
      //  print_r($videoitemid);
     //   exit;
        
        
    
       // echo $videoitemid;
       // echo 'name '.$withvideoext;
        
    
      //  if(!file_exists('uploads/'.$withvideoext)){
            if(!($DB->record_exists('files', array('contextid' =>$context->id, 'itemid'=>$videoitemid)))){  
                 
                 $DB->delete_records('videos', array ('id'=> $videoitemid));
                 $DB->delete_records('videos', array ('id'=> $audioitemid));
                 echo "Sorry, Video had been currupted and did not store on server<br /><br/>";
            //     mysqli_query($conn,"DELETE FROM mdl_videos WHERE name='$withvideoext' OR name='$withaudioext' ");
                    
                 //  $DB->delete_records("videos", array("name"=>$value));
               }

                else{
                    
                    fileDeletion($videoitemid,$withvideoext,$context->id);
                    fileDeletion($videoitemid,".",$context->id);
                    fileDeletion($audioitemid,$withaudioext,$context->id);
                    fileDeletion($audioitemid,".",$context->id);
                                
                       $vid=$DB->delete_records('videos', array ('id'=> $videoitemid));
                       $aud=$DB->delete_records('videos', array ('id'=> $audioitemid));
                      
                       echo $vid."  ".$aud;
                    // mysqli_query($conn,"DELETE FROM mdl_videos WHERE name='$withvideoext' OR name='$withaudioext' ");
                     // $DB->delete_records("mdl_videos", array('name'=>$withvideoext));
                     // $DB->delete_records("mdl_videos", array('name'=>$withaudioext));
                     echo "$withvideoext and $withaudioext has been successfully deleted !!";
                 //   $DB->delete_records("videos", array(sql_compare_text("name")=>$value));
                 }
    
    }
    
    
  
?>