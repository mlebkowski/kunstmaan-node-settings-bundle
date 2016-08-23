<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class AbstractNodeSettingEntity implements CanBeEmptyInterface
{
    use HasNodeTranslationTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
