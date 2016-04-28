<?php

namespace TYPO3\VmfdsSermons\Task;

class FeedImportTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask
{

    /**
     * Execute task from the scheduler
     *
     * @return boolean TRUE on successful execution, false on error
     */
    public function execute()
    {
        return true;
    }

}
