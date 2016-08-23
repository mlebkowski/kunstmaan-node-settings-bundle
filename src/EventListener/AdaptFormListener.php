<?php

namespace Nassau\KunstmaanNodeSettingsBundle\EventListener;

use Kunstmaan\NodeBundle\Event\AdaptFormEvent;
use Kunstmaan\NodeBundle\Event\Events;
use Nassau\KunstmaanNodeSettingsBundle\Services\NodeSettingsAdaptorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdaptFormListener implements EventSubscriberInterface
{
    /**
     * @var NodeSettingsAdaptorInterface
     */
    private $nodeSettingsAdaptor;

    /**
     * @param NodeSettingsAdaptorInterface $nodeSettingsAdaptor
     */
    public function __construct(NodeSettingsAdaptorInterface $nodeSettingsAdaptor)
    {
        $this->nodeSettingsAdaptor = $nodeSettingsAdaptor;
    }


    public static function getSubscribedEvents()
    {
        return [
            Events::ADAPT_FORM => 'onAdaptForm'
        ];
    }

    public function onAdaptForm(AdaptFormEvent $event)
    {
        $tabs = $this->nodeSettingsAdaptor->getTabs($event->getNodeVersion(), $event->getPage());

        foreach ($tabs as $tab) {
            $event->getTabPane()->addTab($tab);
        }

    }
}
