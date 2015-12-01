<?php

namespace Depot\EventStore\Serialization\Adapter\MoniiReflectionPropertiesSerializer;

use Depot\Contract\ContractResolver;
use Depot\Contract\Contract;
use Depot\EventStore\Serialization\Serializer;
use Monii\Serialization\ReflectionPropertiesSerializer\ReflectionPropertiesSerializer;

class MoniiReflectionPropertiesSerializer implements Serializer
{
    public function __construct(
        ContractResolver $contractResolver,
        ReflectionPropertiesSerializer $serializer = null
    ) {
        $this->contractResolver = $contractResolver;
        $this->serializer = $serializer ?: new ReflectionPropertiesSerializer();
    }

    public function canSerialize(
        Contract $type,
        $data
    ) {
        return true;
    }

    public function canDeserialize(
        Contract $type,
        array $data
    ) {
        return true;
    }

    public function serialize(
        Contract $type,
        $object
    ) {
        return $this->serializer->serialize($object);
    }

    public function deserialize(
        Contract $type,
        array $data
    ) {
        return $this->serializer->deserialize($type->getClassName(), $data);
    }
}
