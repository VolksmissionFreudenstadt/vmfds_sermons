<?php
/**
 * This file is part of PHPOffice Common
 *
 * PHPOffice Common is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/Common/contributors.
 *
 * @link        https://github.com/PHPOffice/Common
 * @copyright   2009-2014 PHPOffice Common contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\Common\Tests;

use PhpOffice\Common\XMLWriter;

/**
 * Test class for XMLWriter
 *
 * @coversDefaultClass PhpOffice\Common\XMLWriter
 */
class XMLWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
    public function testConstruct()
    {
        // Memory
        $object = new XMLWriter();
        $object->startElement('element');
            $object->text('AAA');
        $object->endElement();
        $this->assertEquals('<element>AAA</element>'.chr(10), $object->getData());

        // Disk
        $object = new XMLWriter(XMLWriter::STORAGE_DISK);
        $object->startElement('element');
            $object->text('BBB');
        $object->endElement();
        $this->assertEquals('<element>BBB</element>'.chr(10), $object->getData());
    }
}
