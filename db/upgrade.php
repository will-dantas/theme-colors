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

function CriaNovoCampoInfoN($shortname, $name, $type='text',$categoryid, $configdata)
{
    global $DB;
    if ($DB->record_exists('customfield_field', ['shortname'=>$shortname])) {
        echo "<div class='alert alert-success'>Campo de '$shortname' já existe.</div>";
        return;
    }
    $ultimo = $DB->get_record_sql('SELECT coalesce(max(sortorder), 0) + 1 as sortorder from {customfield_field}');
    $course_info_field = new stdClass();
    $course_info_field->name = $name;
    $course_info_field->shortname = $shortname;
    $course_info_field ->sortorder = $ultimo->sortorder;
    $course_info_field->timemodified = time();
    $course_info_field->descriptionformat = 1;
    $course_info_field->timecreated = time();
    $course_info_field->categoryid = $categoryid;
    $course_info_field->type = $type;
    $course_info_field->configdata = $configdata;
    echo "<div class='alert alert-info'>Campo de '$shortname' não existe. O campo será criado com o apelido '$name'...</div>";
    return $DB->insert_record("customfield_field", $course_info_field, true);
}

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

    if (empty($DB->get_record('customfield_category', array('name' => 'Outros campos')))) {
        echo '<div class="alert alert-success">A categoria "Outros campos" não existe. A categoria será criada.</div>';
        $categoria = new stdClass();
        $categoria->name = 'Outros campos';
        $ultimo = $DB->get_record_sql('SELECT coalesce(max(sortorder), 0) + 1 as sortorder from {customfield_category}');
        $categoria->sortorder = $ultimo->sortorder;
        $categoria->descriptionformat = 0;
        $categoria->component = 'core_course';
        $categoria->area = 'course';
        $categoria->timemodified = time();
        $categoria->timecreated = time();
        $categoria->contextid = 1;
        $categoria->id = $DB->insert_record("customfield_category", $categoria);
    } else {
        echo '<div class="alert alert-info">A categoria "Outros campos" já existe.</div>';
        $categoria = $DB->get_record('customfield_category', ['name'=>'Outros campos']);
    }
    
    require_once($CFG->dirroot.'/theme/colors/locallib.php');
    CriaNovoCampoCourseInfo('ch', 'Carga horária','text', $categoria->id,'{"required":"0","uniquevalues":"0","defaultvalue":"","displaysize":50,"maxlength":1333,"ispassword":"0","link":"","locked":"0","visibility":"2"}');
    CriaNovoCampoCourseInfo('obj', 'Objetivos','textarea', $categoria->id,'{"required":"0","uniquevalues":"0","locked":"0","visibility":"2","defaultvalue":"","defaultvalueformat":"1"}');
    CriaNovoCampoCourseInfo('con','Conteudo','textarea',$categoria->id,'{"required":"0","uniquevalues":"0","locked":"0","visibility":"2","defaultvalue":"","defaultvalueformat":"1"}');
    CriaNovoCampoCourseInfo('org','Organização','textarea',$categoria->id,'{"required":"0","uniquevalues":"0","locked":"0","visibility":"2","defaultvalue":"","defaultvalueformat":"1"}');
    CriaNovoCampoCourseInfo('vd','Visibilidade no dashboard','checkbox',$categoria->id,'{"required":"0","uniquevalues":"0","checkbydefault":"0","locked":"0","visibility":"2"}');
    CriaNovoCampoCourseInfo('rp','Restrito a perfis','checkbox',$categoria->id,'{"required":"0","uniquevalues":"0","checkbydefault":"0","locked":"0","visibility":"2"}');
    CriaNovoCampoCourseInfo('ft','Filtros temáticos','select',$categoria->id,'{"required":"0","uniquevalues":"0","options":"Cuidado\nGestão em saúde coletiva\nEnsino na Saúde\nVigilância em Saúde","defaultvalue":"","locked":"0","visibility":"2"}');
    
    return true;
}
