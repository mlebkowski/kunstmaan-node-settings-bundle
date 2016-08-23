<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Entity\NodeTranslation;

trait HasNodeTranslationTrait
{
    /**
     * @var NodeTranslation
     * @ORM\ManyToOne(targetEntity="Kunstmaan\NodeBundle\Entity\NodeTranslation")
     * @ORM\JoinColumn(name="node_translation_id", nullable=false, onDelete="CASCADE")
     */
    protected $nodeTranslation;

    /**
     * @return NodeTranslation
     */
    public function getNodeTranslation()
    {
        return $this->nodeTranslation;
    }

    /**
     * @param NodeTranslation $nodeTranslation
     *
     * @return $this
     */
    public function setNodeTranslation(NodeTranslation $nodeTranslation)
    {
        $this->nodeTranslation = $nodeTranslation;

        return $this;
    }


}
