<?php

use Nassau\KunstmaanNodeSettingsBundle\Entity\AbstractNodeSettingEntity;

use Doctrine\ORM\Mapping as ORM;

class FooSetting extends AbstractNodeSettingEntity
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $bar = "";

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $fooVariant;

    /**
     * @return string
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * @param string $bar
     *
     * @return $this
     */
    public function setBar($bar)
    {
        $this->bar = (string)$bar;

        return $this;
    }

    /**
     * @return string
     */
    public function getFooVariant()
    {
        return $this->fooVariant;
    }

    /**
     * @param string $fooVariant
     *
     * @return $this
     */
    public function setFooVariant($fooVariant)
    {
        $this->fooVariant = $fooVariant;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return "" !== $this->bar;
    }
}
