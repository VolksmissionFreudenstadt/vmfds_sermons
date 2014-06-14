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
	
	
	private $OSISNames = array(
		'MAT' => 'Matthäus',
	);

    /**
     * Renders a bible reference as a qr code for YouVersion
     *
     * @param string $reference
     * @return string as qr code
     * @author Christoph Fischer <christoph.fischer@volksmission.de>
     */
    public function render($reference) {
    	$o = array();
    	$refs = explode(';', $reference);
    	foreach ($refs as $ref) {
    		// remove all verse ranges (we only link to the first verse)
    		if (strpos($ref, '-') !== FALSE) $ref = trim(substr($ref, 0, strpos($ref, '-')));
    		if (strpos($ref, '.') !== FALSE) $ref = trim(substr($ref, 0, strpos($ref, '.')));
    		
    		// replace all separators with a dot
    		$ref = str_replace(',', '.', $ref);
    		$ref = str_replace(':', '.', $ref);
    		$ref = str_replace(' ', '.', $ref);
    		
    		// replace book name with OSIS code
    		$tmp = explode('.', $ref);
    		$ref = str_replace($tmp[0], array_search($tmp[0], $this->OSISNames), $ref);
    		
    		$o[] = 'youversion://bible?reference='.$ref; 
    	}
    	return join (' ', $o); 
    }
}

?>
