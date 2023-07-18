<?php
declare(strict_types=1);

namespace Podfather\Techtest;

use Podfather\Techtest\Entity\EntityInterface;

/**
 * Since this is a toy application, we just store data to the filesystem as JSON.
 * Feel free to use a more realistic storage system if you're feeling fancy.
 */
final class Storage
{
    /**
     * @template T of EntityInterface
     * @param class-string<T> $entityClassName
     *
     * @return array<string, T>
     */
    public function loadAll(string $entityClassName): array
    {
        $path = $this->getPathForClassName($entityClassName);
        $contents = file_get_contents($path);
        $output = [];
        foreach (json_decode($contents, true, 512, JSON_THROW_ON_ERROR) as $id => $entityArray){
            $entityArray['id'] = $id;
            $output[$id] = $entityClassName::createFromArray($entityArray);
        }

        return $output;
    }

    public function save(EntityInterface $entity): void
    {
        $path = $this->getPathForClassName(get_class($entity));
        $contents = file_get_contents($path);
        $dataSet = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        $entityArray = $entity->toArray();
        unset($entityArray['id']); // No point saving the id twice

        $dataSet[$entity->getId()] = $entityArray;
        file_put_contents($path, json_encode($dataSet, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));
    }

    private function getPathForClassName(string $entityClassName): string
    {
        $classNameParts = explode('\\', $entityClassName);
        return '/var/podfather/techtest/storage/' . strtolower(end($classNameParts)) . '.json';
    }
}
