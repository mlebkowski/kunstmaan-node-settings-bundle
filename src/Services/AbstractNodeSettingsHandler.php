<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Kunstmaan\NodeBundle\Entity\HasNodeInterface;
use Kunstmaan\NodeBundle\Entity\NodeVersion;
use Nassau\KunstmaanNodeSettingsBundle\Entity\FindOneByNodeTranslationTrait;

abstract class AbstractNodeSettingsHandler implements NodeSettingsHandlerInterface
{
    const DEFAULT_TAB_NAME = 'nassau.tab.settings';

    use FindOneByNodeTranslationTrait;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function supports(NodeVersion $nodeVersion, HasNodeInterface $page)
    {
        return true;
    }


    /**
     * @inheritDoc
     */
    public function getTabName()
    {
        return self::DEFAULT_TAB_NAME;
    }

    /**
     * @inheritDoc
     */
    public function getBuilderData(NodeVersion $nodeVersion, HasNodeInterface $page)
    {
        return [
            'type' => $this->getFormType($nodeVersion, $page),
            'data' => $this->getData($nodeVersion, $page),
            'options' => $this->getOptions($nodeVersion, $page),
        ];
    }

    protected function getData(NodeVersion $nodeVersion, HasNodeInterface $page)
    {
        $repository = $this->entityManager->getRepository($this->getEntityName());
        $metadata = $this->entityManager->getClassMetadata($this->getEntityName());

        return $this->getOrCreateForNodeTranslation($repository, $metadata, $nodeVersion->getNodeTranslation());
    }

    protected function getOptions(NodeVersion $nodeVersion, HasNodeInterface $page)
    {
        return [];
    }

    abstract protected function getFormType(NodeVersion $nodeVersion, HasNodeInterface $page);

    abstract protected function getEntityName();

}
