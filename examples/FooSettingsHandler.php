<?php

use Kunstmaan\NodeBundle\Entity\HasNodeInterface;
use Kunstmaan\NodeBundle\Entity\NodeVersion;
use Nassau\KunstmaanNodeSettingsBundle\Services\AbstractNodeSettingsHandler;

class FooSettingsHandler extends AbstractNodeSettingsHandler
{

    public function getName()
    {
        return 'foo';
    }

    protected function getFormType(NodeVersion $nodeVersion, HasNodeInterface $page)
    {
        return FooSettingAdminType::class;
    }

    protected function getEntityName()
    {
        return FooSetting::class;
    }
}
