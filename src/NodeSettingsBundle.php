<?php

namespace Nassau\KunstmaanNodeSettingsBundle;

use Nassau\RegistryCompiler\RegistryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NodeSettingsBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        (new RegistryCompilerPass)->register($container);
    }

}
