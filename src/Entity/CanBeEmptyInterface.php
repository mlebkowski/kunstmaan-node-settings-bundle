<?php

namespace Nassau\KunstmaanNodeSettingsBundle\Entity;

interface CanBeEmptyInterface
{
    /**
     * @return bool
     */
    public function isEmpty();
}
