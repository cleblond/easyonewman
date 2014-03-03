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
 * Defines the editing form for the easyonewman question type.
 *
 * @package    qtype
 * @subpackage easyonewman
 * @copyright  2007 Jamie Pratt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * easyonewman question editing form definition.
 *
 * @copyright  2007 Jamie Pratt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->dirroot . '/question/type/shortanswer/edit_shortanswer_form.php');


/**
 * Calculated question type editing form definition.
 *
 * @copyright  2007 Jamie Pratt me@jamiep.org
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_easyonewman_edit_form extends qtype_shortanswer_edit_form {

    protected function definition_inner($mform) {
		global $PAGE, $CFG, $question, $DB;
		
		$PAGE->requires->js('/question/type/easyonewman/easyonewman_script.js');
		$PAGE->requires->css('/question/type/easyonewman/styles.css');
               // $mform->addElement('hidden', 'usecase', 1);
		if(isset($question->id)){
		$record = $DB->get_record('question_easyonewman', array('question' => $question->id ));
		$stagoreclip = $record->stagoreclip;
		//echo $stagoreclip;
		}
		else{
		$stagoreclip = 0;
		}
	//echo required_param('id',0);
	
	//echo $question->id;
	//var_dump($question);
	//echo required_param('stagoreclip', PARAM_INT);


        $mform->addElement('static', 'answersinstruct',
                get_string('correctanswers', 'qtype_easyonewman'),
                get_string('filloutoneanswer', 'qtype_easyonewman'));
        $mform->closeHeaderBefore('answersinstruct');



	$menu = array(
            get_string('staggered', 'qtype_easyonewman'),
            get_string('eclipsed', 'qtype_easyonewman')	    
        );
        $mform->addElement('select', 'stagoreclip',
                get_string('casestagoreclip', 'qtype_easyonewman'), $menu);



        $menu = array(
            get_string('caseconformfalse', 'qtype_easyonewman'),
            get_string('caseconformtrue', 'qtype_easyonewman')	    
        );
        $mform->addElement('select', 'conformimportant',
                get_string('caseconformimportant', 'qtype_easyonewman'), $menu);



        $menu = array(
            get_string('caseorientfalse', 'qtype_easyonewman'),
            get_string('caseorienttrue', 'qtype_easyonewman')	    
        );
        $mform->addElement('select', 'orientimportant',
                get_string('caseorientimportant', 'qtype_easyonewman'), $menu);


 






		
//		$appleturl = new moodle_url('/question/type/easyonewman/easyonewman/easyonewman.jar');


		//get the html in the easyonewmanlib.php to build the applet
//	    $easyonewmanbuildstring = "\n<applet code=\"easyonewman.class\" name=\"easyonewman\" id=\"easyonewman\" archive =\"$appleturl\" width=\"460\" height=\"335\">" .
//	  "\n<param name=\"options\" value=\"" . $CFG->qtype_easyonewman_options . "\" />" .
//      "\n" . get_string('javaneeded', 'qtype_easyonewman', '<a href="http://www.java.com">Java.com</a>') .
//	  "\n</applet>";
	//echo $data['stagoreclip'];

	 if($stagoreclip == 1){
$easyonewmanbuildstring=file_get_contents('type/easyonewman/edit_newman_eclip.html').file_get_contents('type/easyonewman/newman_dragable.html');
	}
	else{
$easyonewmanbuildstring=file_get_contents('type/easyonewman/edit_newman.html').file_get_contents('type/easyonewman/newman_dragable.html');
	}

//echo "here".$easyonewmanbuildstring;

	//echo $mform->get_data();




        //output the marvin applet
        //$mform->addElement('html', html_writer::start_tag('div', array('style'=>'width:650px;')));
		//$mform->addElement('html', html_writer::start_tag('div', array('style'=>'float: right;font-style: italic ;')));
		//$mform->addElement('html', html_writer::start_tag('small'));
		//$easyonewmanhomeurl = 'http://www.easyochem.com';
		//$mform->addElement('html', html_writer::link($easyonewmanhomeurl, get_string('easyonewmaneditor', 'qtype_easyonewman')));
		//$mform->addElement('html', html_writer::empty_tag('br'));
		//$mform->addElement('html', html_writer::tag('span', get_string('author', 'qtype_easyonewman'), array('class'=>'easyonewmanauthor')));
		//$mform->addElement('html', html_writer::end_tag('small'));
		//$mform->addElement('html', html_writer::end_tag('div'));


		//$mform->addElement('html', html_writer::start_tag('div', array('id'=>'newman_template')));
		$mform->addElement('html',$easyonewmanbuildstring);
		//$mform->addElement('html', html_writer::end_tag('div'));



		//$mform->addElement('html', html_writer::end_tag('div'));

			$jsmodule = array(
			    'name'     => 'qtype_easyonewman',
			    'fullpath' => '/question/type/easyonewman/easyonewman_script.js',
			    'requires' => array(),
			    'strings' => array(
				array('enablejava', 'qtype_easyonewman')
			    )
			);




	    $htmlid=1;
 	    $module = array('name'=>'easyonewman', 'fullpath'=>'/question/type/easyonewman/module.js', 'requires'=>array('yui2-treeview'));
	    //$htmlid = 'private_files_tree_'.uniqid();
            //$url = 'http://localhost/eolms/question/type/easyonewman/template_update.php?htmlid='+$htmlid;
		$url = $CFG->wwwroot . '/question/type/easyonewman/template_update.php?stagoreclip=';
            //$this->page->requires->js_init_call('M.block_ejsapp_file_browser.init_tree', array(false, $htmlid));
            $PAGE->requires->js_init_call('M.qtype_easyonewman.init_reload', array($url, $htmlid),		
                                      true,
                                      $jsmodule);
            $html = '<div id="'.$htmlid.'">';
            //$html .= $this->htmllize_tree($tree, $tree->dir);
            $html .= '</div>';









///crl add structure to page




	$PAGE->requires->js_init_call('M.qtype_easyonewman.insert_structure_into_applet',
                                      array(),		
                                      true,
                                      $jsmodule);




        $this->add_per_answer_fields($mform, get_string('answerno', 'qtype_easyonewman', '{no}'),
                question_bank::fraction_options());

        $this->add_interactive_settings();
    }
	
	protected function get_per_answer_fields($mform, $label, $gradeoptions,
            &$repeatedoptions, &$answersoption) {
		
        $repeated = parent::get_per_answer_fields($mform, $label, $gradeoptions,
                $repeatedoptions, $answersoption);
		
		//construct the insert button
//crl mrv		$scriptattrs = 'onClick = "getSmilesEdit(this.name, \'cxsmiles:u\')"';
		$scriptattrs = 'onClick = "getSmilesEdit(this.name, \'cxsmiles\')"';


        $insert_button = $mform->createElement('button','insert',get_string('insertfromeditor', 'qtype_easyonewman'),$scriptattrs);
        array_splice($repeated, 2, 0, array($insert_button));

        return $repeated;
    }

    protected function data_preprocessing($question) {
        $question = parent::data_preprocessing($question);
        return $question;
    }

    public function qtype() {
        return 'easyonewman';
    }
}
