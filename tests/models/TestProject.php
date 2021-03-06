<?php
/**************************************************************************
 *
 *   Copyright 2010 American Public Media Group
 *
 *   This file is part of AIR2.
 *
 *   AIR2 is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   AIR2 is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with AIR2.  If not, see <http://www.gnu.org/licenses/>.
 *
 *************************************************************************/

require_once 'Project.php';
require_once 'trec_utils.php';

class TestProject extends Project {
    public static $UUID_COL = 'prj_uuid';
    public static $UUIDS = array('TESTPROJECT1', 'TESTPROJECT2', 'TESTPROJECT3', 'TESTPROJECT4',
        'TESTPROJECT5', 'TESTPROJECT6', 'TESTPROJECT7');
    public $my_uuid;


    /**
     * Call util to set remove stale records and set UUID, and then setup any
     * table-specific data.
     *
     * @param Doctrine_Event $event
     */
    function preInsert($event) {
        trec_make_new($this);

        // table-specific
        $this->prj_name = strtolower('project-'.$this->prj_uuid);
        $this->prj_display_name = 'Project '.$this->prj_uuid;
        $this->prj_status = 'A';
        $this->prj_type = 'T'; //test
        parent::preInsert($event);
    }


    /**
     * Delete from the database on exit
     */
    function __destruct() {
        trec_destruct($this);
    }


}
