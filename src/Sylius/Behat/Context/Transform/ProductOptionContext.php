<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Sylius\Component\Variation\Repository\OptionRepositoryInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <grzegorz.sadowski@lakion.com>
 */
final class ProductOptionContext implements Context
{
    /**
     * @var OptionRepositoryInterface
     */
    private $productOptionRepository;

    /**
     * @param OptionRepositoryInterface $productOptionRepository
     */
    public function __construct(OptionRepositoryInterface $productOptionRepository)
    {
        $this->productOptionRepository = $productOptionRepository;
    }

    /**
     * @Transform /^product option "([^"]+)"$/
     * @Transform /^"([^"]+)" option$/
     * @Transform :productOption
     */
    public function getProductOptionByName($productOptionName)
    {
        $productOptions = $this->productOptionRepository->findByName($productOptionName);

        Assert::eq(
            1,
            count($productOptions),
            sprintf('%d product options has been found with name "%s".', count($productOptions), $productOptionName)
        );

        return $productOptions[0];
    }
}
