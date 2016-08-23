<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Services;

use Kunstmaan\AdminBundle\Helper\FormWidgets\Tabs\TabInterface;
use Kunstmaan\NodeBundle\Entity\HasNodeInterface;
use Kunstmaan\NodeBundle\Entity\NodeVersion;

interface NodeSettingsAdaptorInterface
{

    /**
     * @param NodeVersion      $nodeVersion
     * @param HasNodeInterface $page
     *
     * @return TabInterface[]
     */
    public function getTabs(NodeVersion $nodeVersion, HasNodeInterface $page);
}
