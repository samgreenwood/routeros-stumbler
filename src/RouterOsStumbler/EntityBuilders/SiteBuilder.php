<?php namespace RouterOsStumbler\EntityBuilders;

use Aura\Marshal\Entity\BuilderInterface;
use RouterOsStumbler\Site;

class SiteBuilder implements BuilderInterface
{
    /**
     * @var string
     */
    protected $class = Site::class;

    /**
     * @var array
     */
    protected $fieldMapping = [
        'id' => 'id',
        'name' => 'name'
    ];

    /**
     * @param array $data
     * @return Site
     */
    public function newInstance(array $data)
    {
        $reflectionClass = new \ReflectionClass($this->class);
        $entity = $reflectionClass->newInstanceWithoutConstructor();

        foreach ($data as $field => $value) {
            if(array_key_exists($field, $this->fieldMapping))
            {
                $entityField = $this->fieldMapping[$field];

                $p = $reflectionClass->getProperty($entityField);
                $p->setAccessible(true);
                $p->setValue($entity, $value);
            }
        }

        return $entity;
    }
}
