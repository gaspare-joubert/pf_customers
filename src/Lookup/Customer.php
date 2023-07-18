<?php
declare(strict_types=1);

namespace Podfather\Techtest\Lookup;

use Podfather\Techtest\Entity\Customer as CustomerEntity;
use Podfather\Techtest\Storage;

final class Customer
{
    public function __construct(private readonly Storage $storage)
    {
    }

    /**
     * @return CustomerEntity[]
     */
    public function get(): array
    {
        return $this->storage->loadAll(CustomerEntity::class);
    }

    public function getByIdOrFail(string $id): CustomerEntity
    {
        $all = $this->get();
        $customer = $all[$id] ?? null;
        if (!$customer instanceof CustomerEntity) {
            throw new \Exception("Could not find customer by id '$id' in " . json_encode($all));
        }

        return $customer;
    }
}
