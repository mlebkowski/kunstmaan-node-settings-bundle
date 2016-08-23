<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Services;

use Kunstmaan\AdminBundle\Helper\FormWidgets\Tabs\TabInterface;
use Kunstmaan\NodeBundle\Entity\HasNodeInterface;
use Kunstmaan\NodeBundle\Entity\NodeVersion;
use Nassau\KunstmaanNodeSettingsBundle\Helper\FormWidget;
use Nassau\KunstmaanNodeSettingsBundle\Helper\Tab;
use Symfony\Component\Translation\TranslatorInterface;

class NodeSettingsAdaptor implements NodeSettingsAdaptorInterface
{

    /**
     * @var NodeSettingsHandlerInterface[]
     */
    private $handlers;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param NodeSettingsHandlerInterface[]|\Traversable $handlers
     * @param TranslatorInterface                         $translator
     */
    public function __construct(\Traversable $handlers, TranslatorInterface $translator)
    {
        $this->handlers = $handlers;
        $this->translator = $translator;
    }


    /**
     * @param NodeVersion      $nodeVersion
     * @param HasNodeInterface $page
     *
     * @return TabInterface[]
     */
    public function getTabs(NodeVersion $nodeVersion, HasNodeInterface $page)
    {
        /** @var Tab[] $tabs */
        $tabs = [];

        foreach ($this->getSupportedHandlers($nodeVersion, $page) as $handlers) {
            $tabName = $handlers->getTabName();

            if (false === isset($tabs[$tabName])) {
                $tabs[$tabName] = (new Tab($this->translator->trans($tabName), new FormWidget($this)))->setIdentifier($tabName);
            }

            /** @var FormWidget $formWidget */
            $formWidget = $tabs[$tabName]->getWidget();

            $formWidget->addType($handlers->getName(), $handlers->getBuilderData($nodeVersion, $page));
        }

        return $tabs;
    }

    /**
     * @param NodeVersion      $nodeVersion
     * @param HasNodeInterface $page
     *
     * @return NodeSettingsHandlerInterface[]
     */
    protected function getSupportedHandlers(NodeVersion $nodeVersion, HasNodeInterface $page)
    {
        return array_filter(iterator_to_array($this->handlers),
            function (NodeSettingsHandlerInterface $handler) use ($nodeVersion, $page) {
                return $handler->supports($nodeVersion, $page);
            });
    }
}
