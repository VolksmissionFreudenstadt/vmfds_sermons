<?php

/*
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
 * @author Christoph Fischer <chris@toph.de>
 * @date 2016-06-04
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */


$EM_CONF[$_EXTKEY] = array(
    'title' => 'Sermons',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Christoph Fischer',
    'author_email' => 'christoph.fischer@volksmission.de',
    'author_company' => 'Volksmission Freudenstadt',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '1.0',
    'constraints' => array(
        'depends' => array(
            'extbase' => 'undefined',
            'fluid' => 'undefined',
            'typo3' => '6.0',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);
?>