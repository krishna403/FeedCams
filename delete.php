
<?php
/**
 * save and upload the audio video files into directories and link of files in database

 *
 * @package    mod
 * @subpackage newmodule
 * @copyright  2014 krishna
 * @license    http://www.vidyamantra.com
 */

//require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
//global $DB;

$conn=mysqli_connect('localhost','root',"mummy","moodle27d");
 
if (isset($_POST['delete-file'])) {
  
    $fileName = 'uploads/'.$_POST['delete-file'];
    $name=$_POST['delete-file'];
    $withvideoext=$_POST['delete-file'].'.webm';
    $withaudioext=$_POST['delete-file'].'.wav';
    
    
    
        if(!file_exists('uploads/'.$withvideoext)){

                 mysqli_query($conn,"DELETE FROM mdl_videos WHERE name='$withvideoext' OR name='$withaudioext' ");
                    echo "Sorry Video had been currupted and did not stored on server<br /><br/>";
                 //  $DB->delete_records("videos", array(sql_compare_text("name")=>$value));
               }

                else{
                     unlink('uploads/'.$withvideoext);
                     unlink('uploads/'.$withaudioext);

                     mysqli_query($conn,"DELETE FROM mdl_videos WHERE name='$withvideoext' OR name='$withaudioext' ");
                     // $DB->delete_records("mdl_videos", array('name'=>$withvideoext));
                     // $DB->delete_records("mdl_videos", array('name'=>$withaudioext));
                     echo "$withvideoext and $withaudioext has been successfully deleted !!";
                 //   $DB->delete_records("videos", array(sql_compare_text("name")=>$value));
                 }
    
    
}
?>