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
 * @copyright  2014 onwards Carl LeBlond
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../../config.php');
require_login(0, false);
global $OUTPUT;
$stagoreclip = required_param('stagoreclip', PARAM_TEXT);
if ($stagoreclip == 1) {
    $easyonewmanbuildstring = file_get_contents('edit_newman_eclip.html').file_get_contents('newman_dragable.html');
} else {
    $easyonewmanbuildstring = file_get_contents('edit_newman.html').file_get_contents('newman_dragable.html');
}
echo $easyonewmanbuildstring;
