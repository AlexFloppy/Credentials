<?php

/*
 * This file is part of Laravel Credentials.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Credentials;

use GrahamCampbell\Binput\BinputServiceProvider;
use GrahamCampbell\Credentials\CredentialsServiceProvider;
use GrahamCampbell\Security\SecurityServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;
use GrahamCampbell\Throttle\ThrottleServiceProvider;
use McCool\LaravelAutoPresenter\LaravelAutoPresenterServiceProvider;

/**
 * This is the abstract test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the required service providers.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string[]
     */
    protected function getRequiredServiceProviders($app)
    {
        return [
            LaravelAutoPresenterServiceProvider::class,
            SecurityServiceProvider::class,
            BinputServiceProvider::class,
            ThrottleServiceProvider::class,
        ];
    }

    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return CredentialsServiceProvider::class;
    }
}
