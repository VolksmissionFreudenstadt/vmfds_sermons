<?php

namespace TYPO3\VmfdsSermons\ViewHelpers\Format;

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('vmfds_sermons') . 'vendor/autoload.php');

class MarkdownViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Convert input to markdown
     */
    public function render()
    {
        $converter = new \League\HTMLToMarkdown\HtmlConverter(['strip_tags' => true, 'italic_style' => '*', 'bold_style' => '**']);
        return $converter->convert(htmlspecialchars_decode($this->renderChildren()));
    }

}
