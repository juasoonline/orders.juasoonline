<?php

namespace App\Traits;

trait Relatives
{
    private $relationships;

    /**
     * Relatives constructor.
     */
    public function __construct()
    {
        $this -> relationships = includeResources();
    }

    /**
     * @return bool|mixed
     */
    public function loadRelationships() : bool
    {
        return ( bool ) count( $this -> relationships );
    }
}
