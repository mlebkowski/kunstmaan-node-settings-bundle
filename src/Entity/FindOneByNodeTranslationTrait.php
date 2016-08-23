<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Entity;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Kunstmaan\NodeBundle\Entity\NodeTranslation;

trait FindOneByNodeTranslationTrait
{
    protected $nodeTranslationFieldName = 'nodeTranslation';

    public function getOrCreateForNodeTranslation(ObjectRepository $repository, ClassMetadata $metadata, NodeTranslation $nodeTranslation)
    {
        if (false === $metadata->hasAssociation($this->nodeTranslationFieldName)) {
            throw new \InvalidArgumentException(sprintf('The entity needs to have a `%s` field', $this->nodeTranslationFieldName));
        }

        $item = $repository->findOneBy([$this->nodeTranslationFieldName => $nodeTranslation]);

        if (null === $item) {
            $item = $metadata->getReflectionClass()->newInstance();
            $metadata->setFieldValue($item, $this->nodeTranslationFieldName, $nodeTranslation);
        }

        return $item;
    }
}
