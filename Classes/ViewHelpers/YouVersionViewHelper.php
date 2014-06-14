<?php
namespace TYPO3\VmfdsSermons\ViewHelpers;

/**
 *
 * Example
 * {namespace s=TYPO3\VmfdsSermons\ViewHelpers}
 * <s:youVersion reference="Matthäus 6,10" />
 *
 * @package TYPO3
 * @subpackage vmfds_sermons
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class YouVersionViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Renders a bible reference as a qr code for YouVersion
     *
     * @param string $reference
     * @return string as qr code
     * @author Christoph Fischer <christoph.fischer@volksmission.de>
     */
    public function render($reference) {
    	return 'Youversion: '.$reference;
    }
}

?>
