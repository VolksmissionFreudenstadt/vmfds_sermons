<?php
namespace TYPO3\VmfdsSermons\ViewHelpers;

/**
 *
 * Example
 * {namespace s=TYPO3\VmfdsSermons\ViewHelpers}
 * <s:orderedList length="7" />
 *
 * @package TYPO3
 * @subpackage vmfds_sermons
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class OrderedListViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Renders a text as an ordered list (one item per line)
     *
     * @param string $list The number of characters of the dummy content
     * @validate $length StringValidator
     * @param string $underlineMode
     * @param string $listStyle
     * @param string $itemStyle
     * @param string $breakAfter
     * @return string as ordered list
     * @author Christoph Fischer <christoph.fischer@volksmission.de>
     */
    public function render($list, $underlineMode='html5', $listStyle='', $itemStyle='', $breakAfter=FALSE) {
    	switch ($underlineMode) {
			case 'blank':
				$list = str_replace(array('<u>', '</u>'), array('<span style="color: white; border-bottom: solid 1px black">', '</span>'), $list);
				break;
			case 'html5':
				$list = str_replace(array('<u>', '</u>'), array('<span style="text-decoration: underline;">', '</span>'), $list);
				break;
			case 'remove':
				$list = str_replace(array('<u>', '</u>'), array('', ''), $list);
				break;
		}
    	$items = explode("\r", $list);
    	if (is_array($items)) {
    		return '<ol '.($listStyle ? 'style="'.$listStyle.'"' : '').'><li '.($itemStyle ? 'style="'.$itemStyle.'"' : '').'>'.join('</li><li '.($itemStyle ? 'style="'.$itemStyle.'"' : '').'>', $items).($breakAfter ? '<br />' : '').'</li></ol>';
    	} else {
    		return $list;
    	}
    }
}

?>
