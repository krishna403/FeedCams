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
 * The main newmodule configuration form
 *
 * It uses the standard core Moodle formslib. For more info about them, please
 * visit: http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * @package    mod
 * @subpackage newmodule
 * @copyright  2011 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Module instance settings form
 */
class mod_newmodule_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     */
    public function definition() {

        $mform = $this->_form;

        //-------------------------------------------------------------------------------
        // Adding the "general" fieldset, where all the common settings are showed
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field
        $mform->addElement('text', 'name', get_string('newmodulename', 'newmodule'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'newmodulename', 'newmodule');

        // Adding the standard "intro" and "introformat" fields
        $this->add_intro_editor();

        //-------------------------------------------------------------------------------
        // Adding the rest of newmodule settings, spreeading all them into this fieldset
        // or adding more fieldsets ('header' elements) if needed for better logic
        $mform->addElement('static', 'label1', 'newmodulesetting1', 'Your newmodule fields go here. Replace me!');

        $mform->addElement('header', 'newmodulefieldset', get_string('newmodulefieldset', 'newmodule'));
        $mform->addElement('static', 'label2', 'newmodulesetting2', 'Your newmodule fields go here. Replace me!');

        //-------------------------------------------------------------------------------
        // add standard elements, common to all modules
        $this->standard_coursemodule_elements();
        //-------------------------------------------------------------------------------
        // add standard buttons, common to all modules
        $this->add_action_buttons();
    }

/*
function add_completion_rules() {
 
    $mform =& $this->_form;

    $group=array();
    $group[] =& $mform->createElement('checkbox', 'completionrecordenabled', ' ', get_string('completionrecord','newmodule'));
  //  $group[] =& $mform->createElement('text', 'completionrecord', ' ', array('size'=>3));
    $mform->setType('completionrecord',PARAM_INT);
    $mform->addGroup($group, 'completionrecordgroup', get_string('completionrecordgroup','newmodule'), array(' '), false);
   // $mform->setHelpButton('completionrecordgroup', array('completion', get_string('completionrecordhelp', 'newmodule'), 'newmodule'));
    $mform->disabledIf('completionrecord','completionrecordenabled','notchecked');

    
     $group=array();
    $group[] =& $mform->createElement('checkbox', 'completionwatchenabled', ' ', get_string('completionwatch','newmodule'));
  
    $mform->setType('completionwatch',PARAM_INT);
    $mform->addGroup($group, 'completionwatchgroup', get_string('completionwatchgroup','newmodule'), array(' '), false);
   // $mform->setHelpButton('completionwatchgroup', array('completion', get_string('completionwatchhelp', 'newmodule'), 'newmodule'));
    $mform->disabledIf('completionwatch','completionwatchenabled','notchecked');
    
    
    return array('completionrecordgroup','completionwatchgroup');
}

 function completion_rule_enabled($data) {
        return (!empty($data['completionrecordenabled']) && $data['completionrecord']!=0) ||
            (!empty($data['completionwatchenabled']) && $data['completionwatch']!=0);
    }
    
    
    function get_data() {
        $data = parent::get_data();
        if (!$data) {
            return false;
        }
        // Turn off completion settings if the checkboxes aren't ticked
        if (!empty($data->completionunlocked)) {
            $autocompletion = !empty($data->completion) && $data->completion==COMPLETION_TRACKING_AUTOMATIC;
            if (empty($data->completionrecordenabled) || !$autocompletion) {
                $data->completionrecord = 0;
            }
            if (empty($data->completionwatchenabled) || !$autocompletion) {
                $data->completionwatch = 0;
            }
        }
        return $data;
    }
    */
    
    
    
    function get_data() {
        $data = parent::get_data();
        if (!$data) {
            return false;
        }
        // Set up completion section even if checkbox is not ticked
        if (!empty($data->completionunlocked)) {
            if (empty($data->completionrecord)) {
                $data->completionrecord = 0;
            }
            
             if (empty($data->completionwatch)) {
                $data->completionwatch = 0;
            }
        }
      //  print_r($data);
      //  exit();
        return $data;
        
    }

    function add_completion_rules() {
        $mform =& $this->_form;

        $mform->addElement('checkbox', 'completionrecord', '', get_string('completionrecord', 'newmodule'));
        $mform->addElement('checkbox', 'completionwatch', '', get_string('completionwatch', 'newmodule'));
        return array('completionrecord','completionwatch');
    }

    function completion_rule_enabled($data) {
        return (!empty($data['completionrecord']) || !empty($data['completionwatch']));
    }
    
    
   /* function data_preprocessing(&$default_values) {
        
        parent::data_preprocessing($default_values);

        // Set up the completion checkboxes which aren't part of standard data.
        // We also make the default value (if you turn on the checkbox) for those
        // numbers to be 1, this will not apply unless checkbox is ticked.
        $default_values['completionrecord']=
            !empty($default_values['completionrecord']) ? 1 : 0;
        if (empty($default_values['completionrecord'])) {
            $default_values['completionrecord']=1;
        }
        $default_values['completionwatch']=
            !empty($default_values['completionwatch']) ? 1 : 0;
        if (empty($default_values['completionwatch'])) {
            $default_values['completionwatch']=1;
        }
       
    }*/
    
    
    
}