<?php

/**
 * save and upload the audio video files into directories and link of files in database

 *
 * @package    mod
 * @subpackage newmodule
 * @copyright  2014 krishna
 * @license    http://www.vidyamantra.com
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');
require_once ($CFG->dirroot.'/course/moodleform_mod.php');
global $DB;

/*
$id = optional_param('id', 0, PARAM_INT); // course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // newmodule instance ID - it should be named as the first character of the module

if ($id) {
    $cm         = get_coursemodule_from_id('newmodule', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $newmodule  = $DB->get_record('newmodule', array('id' => $cm->instance), '*', MUST_EXIST);
} elseif ($n) {
    $newmodule  = $DB->get_record('newmodule', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $newmodule->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('newmodule', $newmodule->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

//require_login($course, true, $cm);
$context = context_module::instance($cm->id);
   
echo $context;
echo $context->id;

*/
foreach(array('video', 'audio') as $type) {
    if (isset($_FILES["${type}-blob"])) {
    
     
     // echo 'uploads/';
        
	$fileName = $_POST["${type}-filename"];
       $uploadDirectory = 'uploads/'.$fileName;
      
        
    /*    $uploaded_file_path = $_FILES["${type}-blob"]["tmp_name"];  // temp path to the actual file
        $filename = $_POST["${type}-filename"];                // the original (human readable) filename
       
        $file_storage = get_file_storage();
        // $context = context_module::instance($id);
            $fileinfo = array(
                'contextid' => $context->id,
                'component' => 'mod_newmodule',       // mod_[your-mod-name]
                'filearea' => 'newmodule_docs',  // arbitrary string
                'itemid' => 1,               // use a unique id in the context of the filearea and you should be safe
                'filepath' => '/',             // virtual path
                'filename' => $filename);      // virtual filename

         //   $file_storage = get_file_storage();
            
            if ($file_storage->file_exists($fileinfo['contextid'],
                                 $fileinfo['component'],
                                 $fileinfo['filearea'],
                                 $fileinfo['itemid'],
                                 $fileinfo['filepath'],
                                 $fileinfo['filename'])) return false; // (this code is actually in a function)

  $file = $file_storage->create_file_from_path($fileinfo, $uploaded_file_path);
         */
        
     //upload the audio-video files
       if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
            echo(" problem moving uploaded file");
         }
                echo "<br>".$fileName." has been uploaded";
		echo($fileName);
                 
               //  $tmp=$_FILES["${type}-blob"]["tmp_name"];
                $url="http://localhost/moodle27d/mod/newmodule/uploads/$fileName";
         
         $record = new stdClass();
               $record->name = $fileName;
               $record->url = $url;
               $lastinsertid = $DB->insert_record('videos', $record, false);
    }
}
?>