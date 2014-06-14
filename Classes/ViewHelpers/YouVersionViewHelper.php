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
		'GEN' => 'Genesis',
		'EXO' => 'Exodus',
		'LEV' => 'Leviticus',
		'NUM' => 'Numeri',
		'DEU' => 'Deuteronomium',
		'JOS' => 'Josua',
		'JDG' => 'Richter',
		'RUT' => 'Ruth',
		'1SA' => '1.Samuel',
		'2SA' => '2.Samuel',
		'1KI' => '1.Könige',
		'2KI' => '2.Könige',
		'1CH' => '1.Chronik',
		'2CH' => '2.Chronik',
		'EZR' => 'Esra',
		'NEH' => 'Nehemia',
		'EST' => 'Esther',
		'JOB' => 'Hiob',
		'PSA' => 'Psalm',
		'PRO' => 'Sprüche',
		'ECC' => 'Prediger',
		'SNG' => 'Hohelied',
		'ISA' => 'Jesaja',
		'JER' => 'Jeremia',
		'LAM' => 'Klagelieder',
		'EZK' => 'Hesekiel',
		'DAN' => 'Daniel',
		'HOS' => 'Hosea',
		'JOL' => 'Joel',
		'AMO' => 'Amos',
		'OBA' => 'Obadja',
		'JON' => 'Jona',
		'MIC' => 'Micha',
		'NAH' => 'Nahum',
		'HAB' => 'Habakkuk',
		'ZEP' => 'Zefanja',
		'HAG' => 'Haggai',
		'ZEC' => 'Sachraja',
		'MAL' => 'Maleachi',
		'MAT' => 'Matthäus',
		'MAR' => 'Markus',
		'LUK' => 'Lukas',
		'JHN' => 'Johannes',
		'ACT' => 'Apostelgeschichte',
		'ROM' => 'Römer',
		'1CO' => '1.Korinther',
		'2CO' => '2.Korinther',
		'GAL' => 'Galater',
		'EPH' => 'Epheser',
		'PHP' => 'Philipper',
		'COL' => 'Kolosser',
		'1TH' => '1.Thessalonicher',
		'2TH' => '2.Thessalonicher',
		'1TI' => '1.Timotheus',
		'2TI' => '2.Timotheus',
		'TIT' => 'Titus',
		'PHM' => 'Philemon',
		'HEB' => 'Hebräer',
		'JAS' => 'Jakobus',
		'1PE' => '1.Petrus',
		'2PE' => '2.Petrus',
		'1JN' => '1.Johannes',
		'2JN' => '2.Johannes',
		'3JN' => '3.Johannes',
		'JUD' => 'Judas',
		'REV' => 'Offenbarung',  
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
