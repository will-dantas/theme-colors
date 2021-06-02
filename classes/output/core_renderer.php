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

namespace theme_colors\output;

use moodle_url;

defined('MOODLE_INTERNAL') || die;
require_once($CFG->dirroot.'/theme/colors/locallib.php');

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_colors
 * @copyright  2012 Bas Brands, www.basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \core_renderer {
    
    public function edit_button(moodle_url $url) {
        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $editstring = get_string('turneditingoff');
        } else {
            $url->param('edit', 'on');
            $editstring = get_string('turneditingon');
        }
        $button = new \single_button($url, $editstring, 'post', ['class' => 'btn btn-primary']);
        return $this->render_single_button($button);
    }

    public function custom_header(){
        global $DB;

        $returnstr = "";
        $sql = "SELECT name FROM {cores_header} ORDER BY ID DESC LIMIT 1";
        $corAtual = $DB->get_records_sql($sql);
        foreach ($corAtual as $atual){
            $returnstr .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item">Cor atual: ' .$atual->name. '</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" style="text-align:center" href="/moodle/admin/settings.php?section=themesettingcolors">Alterar cor</a>
                          </div>';    
        }            
        return $returnstr;
    }

    public function user_ativo()
    {
        global $DB;

        $returnstr = "";
        $data = time() - (5*60);
        $sql = "SELECT DISTINCT u.id, u.firstname, u.lastname FROM {user} as u INNER JOIN {logstore_standard_log} as l ON u.id = l.userid WHERE l.timecreated > $data";
        $users = $DB->get_records_sql($sql);
        $cont=0;
        foreach ($users as $user){
            $cont++;
            $returnstr .= '<li class="navbar-brand logo mr-md-3"><a class="navbar-brand logo mr-md-3" href="/moodle/user/profile.php?user='.$user->firstname ." ".$user->lastname.'">'.$user->firstname ." ".$user->lastname.'</a></li>';    
        }
        $returnstr .= '<li class="navbar-brand logo mr-md-3"><h2>Total de usuários ativos: '.$cont.'</h2></li>';
        return $returnstr;
    }       
} 
