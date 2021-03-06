<?php

namespace RestApiBundle\DTO\Docs\Schema;

use RestApiBundle;

class ObjectType implements RestApiBundle\DTO\Docs\Schema\SchemaTypeInterface
{
    /**
     * @var array<string, RestApiBundle\DTO\Docs\Schema\SchemaTypeInterface>
     */
    private $properties;

    /**
     * @var bool
     */
    private $nullable;

    public function __construct(array $properties, bool $nullable)
    {
        $this->properties = $properties;
        $this->nullable = $nullable;
    }

    /**
     * @return array<string, RestApiBundle\DTO\Docs\Schema\SchemaTypeInterface>
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getNullable(): bool
    {
        return $this->nullable;
    }

    public function setNullable(bool $nullable)
    {
        $this->nullable = $nullable;

        return $this;
    }
}
