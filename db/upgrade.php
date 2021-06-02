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
 * Plugin upgrade steps are defined here.
 *
 * @package     theme_colors
 * @category    upgrade
 * @copyright   2020 Mateus Abrantes <mateus.abrantes@lais.huol.ufrn.br>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__.'/upgradelib.php');

/**
 * Execute theme_colors upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_theme_colors_upgrade($oldversion) {
    global $DB,$CFG;

    // $dbman = $DB->get_manager();

    // For further information please read the Upgrade API documentation:
    // https://docs.moodle.org/dev/Upgrade_API
    //
    // You will also have to create the db/install.xml file by using the XMLDB Editor.
    // Documentation for the XMLDB Editor can be found at:
    // https://docs.moodle.org/dev/XMLDB_editor
    
    if (empty($DB->get_record('config_plugins', array('plugin' => 'theme_colors', 'name' => 'navbarheadercolor',)))) {
        echo '<div class="alert alert-success">A tabela "cores_header" não existe. A tabela sera criada.</div>';        
    } else {
        echo '<div class="alert alert-info">A tabela "cores_header" ja exite.</div>';
        $cor = $DB->get_record('cores_header', array('name' => $corHexa, 'rgb' => $corHexa));
    } 
    return true;
}
