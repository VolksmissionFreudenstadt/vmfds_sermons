<?php

namespace TYPO3\VmfdsSermons\View\Sermon;

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Shape\Drawing\File;
use PhpOffice\PhpPresentation\DocumentLayout;
use PhpOffice\PhpPresentation\Style\Font;

class Presentation extends \TYPO3\CMS\Extbase\Mvc\View\AbstractView
{

    /**
     * Renders the view
     *
     * @return string The rendered view
     */
    public function render()
    {
        $settings = $this->variables['settings'];
        $sermon = $this->variables['sermon'];
        $preachers = [];
        foreach ($sermon->getPreacher() as $preacher) {
            $preachers[] = $preacher->getName();
        }

        $ppt = new PhpPresentation();
        $ppt->getProperties()->setCreator(join(', ', $preachers))
                ->setLastModifiedBy(join(', ', $preachers))
                ->setTitle($sermon->getTitle())
                ->setDescription($sermon->getDescription())
                ->setCategory('Predigten');
        $ppt->getLayout();

        $slideIdx = 0;

        /*
          [cx] => 9144000 / 960
          [cy] => 6858000 / 720
         */
        foreach ($sermon->getSlides() as $slide) {
            if ($slideIdx) {
                $currentSlide = $ppt->createSlide();
            } else {
                $currentSlide = $ppt->getActiveSlide();
            }
            $slideIdx++;



            $image = PATH_site . $slide->getImage()->getOriginalResource()->getOriginalFile()->getPublicUrl();
            if (file_exists($image)) {
                $shape = $currentSlide->createDrawingShape();
                $shape->setPath($image)
                        ->setWidth(960)
                        ->setOffsetX(0)
                        ->setOffsetY(0);
            }
            $text = $slide->getPresentationTitle();
            if ($text) {
                $fontSize = $slide->getPresentationFontSize();
                $fontSize = $fontSize ? $fontSize : 45;
                $shape = $currentSlide->createRichTextShape()
                        ->setHeight(300)
                        ->setWidth(920)
                        ->setOffsetX(20)
                        ->setOffsetY(400);
                $alignment = $shape->getActiveParagraph()->getAlignment();
                $alignment->setHorizontal(Alignment::HORIZONTAL_RIGHT)
                        ->setVertical(Alignment::VERTICAL_BOTTOM);
                $textRun = $shape->createTextRun($text);
                $textRun->getFont()->setName('Open Sans Extrabold')
                        ->setBold(true)
                        ->setColor(new Color('FFFFFFFF'))
                        ->setSize($fontSize);
                $shape->getShadow()->setVisible(true)->setAlpha(75)->setBlurRadius(2)->setDirection(45);
            }
        }

        $fileName = ($settings['forceFileName'] ? $settings['forceFileName'] : '/typo3temp/predigt.pptx');
        $oWriterPPTX = IOFactory::createWriter($ppt, 'PowerPoint2007');
        $oWriterPPTX->save(PATH_site . $fileName);
        Header('Location: ' . $fileName);

        return '';
    }

}
