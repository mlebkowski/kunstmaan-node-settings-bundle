<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Services;

use Kunstmaan\NodeBundle\Entity\HasNodeInterface;
use Kunstmaan\NodeBundle\Entity\NodeVersion;
use Symfony\Component\Form\FormTypeInterface;

interface NodeSettingsHandlerInterface
{
    /**
     * You may add settings only to selected nodes. Use this method to determine if the handler should fire or not
     *
     * @param NodeVersion      $nodeVersion
     * @param HasNodeInterface $page
     *
     * @return bool
     */
    public function supports(NodeVersion $nodeVersion, HasNodeInterface $page);

    /**
     * A unique, computer friendly name of your setting used in the form builder
     *
     * @return string
     */
    public function getName();

    /**
     * Unique name of a tab you want to use. Translation key is recommended
     *
     * @return string
     */
    public function getTabName();

    /**
     * Attach this form type to handle your data. Eiter a FormTypeInterface|string is expected or an
     * array with keys: 'type', 'data' and 'options'
     *
     * @param NodeVersion      $nodeVersion
     * @param HasNodeInterface $page
     *
     * @return array|FormTypeInterface|string
     */
    public function getBuilderData(NodeVersion $nodeVersion, HasNodeInterface $page);

}
