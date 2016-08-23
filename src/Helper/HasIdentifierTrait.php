<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Helper;

trait HasIdentifierTrait
{
    private $identifier;

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     *
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = preg_replace('/[^a-z0-9_]/i', '_', $identifier);

        return $this;
    }
}
