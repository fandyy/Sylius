<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ProductBundle\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Product\Repository\VariantRepositoryInterface;

/**
 * @author Alexandre Bacco <alexandre.bacco@gmail.com>
 */
class VariantRepository extends EntityRepository implements VariantRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        return $this->findBy(['name' => $name]);
    }

    /**
     * {@inheritdoc}
     */
    public function createQueryBuilderWithProduct($productId)
    {
        return $this->createQueryBuilder('o')
            ->where('o.object = :productId')
            ->setParameter('productId', $productId)
        ;
    }
}
