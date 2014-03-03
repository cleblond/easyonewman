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
 * marvin Molecular Editor question definition class.
 *
 * @package    qtype
 * @subpackage easyonewman
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/shortanswer/question.php');


/**
 * Represents a easyonewman question.
 *
 * @copyright  1999 onwards Martin Dougiamas {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_easyonewman_question extends qtype_shortanswer_question {
	// all comparisons in easyonewman are case sensitive
	public function compare_response_with_answer(array $response, question_answer $answer) {

	$conformimportant = $this->conformimportant;
	$orientimportant = $this->orientimportant;
	//echo "conformimportant=".$conformimportant;
	//echo "orientimportant=".$orientimportant;
	$usranswer=$response['answer'];
	$coranswer=$answer->answer;

	$cor=explode("-",$coranswer);
	$usr=explode("-",$usranswer);


	///strip image number for now
	for ($i = 0; $i <= 5; $i++) {

	$cor[$i]=substr($cor[$i], 0, -1);
	$usr[$i]=substr($usr[$i], 0, -1);
 	 
	}
//	echo "<br>cor=";
//	var_dump($cor);
//	echo "<br>usr=";
//	var_dump($usr);


//	echo "usranswer=".$response['answer'];
//	echo "coranswer=".$answer->answer;


////quick check to see if they got it exactly correct
	if($cor==$usr){
	//echo "here 1";
	return 1;}
	else{
	//echo "here 0";
//	return 0;
	}
	$usr_temp=$usr;


	////orientation important  - Only need to check from front face "I think"
	if($orientimportant == 1){ 
	//echo "orientation important!";


		////conformation important
    		if($conformimportant==1){


			$return_flag = $this->check_conform_important($usr,$cor);
			return $return_flag;
		}
		else{
		////conformation not important
		///check back

			$return_flag = $this->check_conform_not_important($usr, $cor);
			return $return_flag;


		}

	}
	////oreiantation not important
	elseif($orientimportant == 0){
	//return 1;
		///conformation important
		if($conformimportant==1){
			////check from front - forward thorugh a

			$return_flag1 = $this->check_conform_important($usr_temp,$cor);
	
				$usr_temp=array_reverse($usr);
			////check from back - forward thorugh a	

			$return_flag2=$this->check_conform_important($usr_temp,$cor);


			if($return_flag1 == 1 || $return_flag2 == 1){
			$return_flag = 1;}
			else{
			$return_flag = 0;
			}

		}
		else{
		///conformation not important
//echo "HHHHERERRE";


		$return_flag1 = $this->check_conform_not_important($usr, $cor);

		$usr_temp=array_reverse($usr);

		$return_flag2 = $this->check_conform_not_important($usr_temp, $cor);

		//echo "ret1 and ret2 $return_flag1 , $return_flag2";
		if($return_flag1 == "1" || $return_flag2 == "1"){
		//echo "retun_flag";
			$return_flag=1;}
			else{
			$return_flag=0;
		}
		


		}

	//echo "Orientation not important $return_flag";


	
	}

//echo "latter $return_flag";

//return 1;
	return $return_flag;

}
 


	public function check_conform_important($usr_temp, $cor){
			for ($i = 0; $i <= 5; $i++) {

				///rotate usr array by 1 (clockwise)	
				$new_array = array();
				foreach($usr_temp as $key => $value){
				   //echo "<br>key=$key";
				   if($key==4){
					$new_array[0]=$value;
					}
					elseif($key==5){
					$new_array[1]=$value;
					}
					else{
					$new_array[$key+2] = $value;
					}
				}
				$usr_temp = $new_array;
				ksort($usr_temp);
				//echo "<br>cor=";
				//var_dump($cor);
				//echo "<br>usr=";
				//var_dump($usr_temp);

				if($cor==$usr_temp){
				//echo "check_conform_important - returned 1";
				return 1;
				}
				
				

			}
			return 0;


	}


public function check_conform_not_important($usr, $cor) {
     
			///check back
			///split arrays into front(odd) and back(even) 
			$cor_front = array();
			$cor_back = array();
		
			$corodd = array();
			$coreven = array();
			$both = array(&$coreven, &$corodd);
			array_walk($cor, function($v, $k) use ($both) { $both[$k % 2][] = $v; });
			//echo "<br>corodd=";
			///var_dump($corodd);
			//echo "<br>coreven=";
			//var_dump($coreven);


			$usr_front = array();
			$usr_back = array();
		
			$usrodd = array();
			$usreven = array();
			$both = array(&$usreven, &$usrodd);
			array_walk($usr, function($v, $k) use ($both) { $both[$k % 2][] = $v; });

			//echo "<br>usrodd=";
			//var_dump($usrodd);
			//echo "<br>usreven=";
			//var_dump($usreven);
				//$oddflag=false;
				$oddflag=false;
				$evenflag=false;
				///check back(even)
				$usr_temp=$usreven;
				for ($i = 0; $i <= 2; $i++) {

					///rotate usr array by 1 (clockwise)	
					$new_array = array();
					foreach($usr_temp as $key => $value){
					   
					   if($key==2){
						$new_array[0]=$value;
						}
						else{
						$new_array[$key+1] = $value;
						}
					}
					$usr_temp = $new_array;
					ksort($usr_temp);
					if($coreven==$usr_temp){
					$evenflag=true;
					//echo "<br>even flag TRUE";
					}
					
					//echo "<br>shf=";
					//var_dump($usr);

				}


				///check front(odd)
				$usr_temp=$usrodd;
				for ($i = 0; $i <= 2; $i++) {

					///rotate usr array by 1 (clockwise)	
					$new_array = array();
					foreach($usr_temp as $key => $value){
					   
					   if($key==2){
						$new_array[0]=$value;
						}
						else{
						$new_array[$key+1] = $value;
						}
					}
					$usr_temp = $new_array;
					ksort($usr_temp);
					//echo "<br>corodd=";
					//var_dump($corodd);
					//echo "<br>usrtemp=";
					//var_dump($usr_temp);
			
					if($corodd==$usr_temp){
					$oddflag=true;
					//echo "<br>odd flag true";
					}
					//echo "<br>shf=";
					//var_dump($usr);

				}



				if($oddflag == true && $evenflag == true){
				//echo "odd even both true";
				return 1;

				}
				else{
				//echo "either odd even false";
				return 0;
				}



    }





	
	public function get_expected_data() {
        return array('answer' => PARAM_RAW, 'easyonewman' => PARAM_RAW, 'mol' => PARAM_RAW);
    }
}
