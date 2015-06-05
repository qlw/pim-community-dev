<?php

namespace Context;

use Behat\Behat\Exception\PendingException;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Session;

/**
 * Scripts manager
 *
 * @author    JM Leroux <jean-marie.leroux@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ScriptsManager
{
    /** @var Session */
    protected $minkSession;

    /**
     * @param Session $minkSession
     */
    public function __construct(Session $minkSession)
    {
        $this->minkSession = $minkSession;
    }

    /**
     * @return \WebDriver\Session
     */
    protected function getWebDriverSession()
    {
        $webDriver = $this->minkSession->getDriver();

        if (!$webDriver instanceof Selenium2Driver) {
            throw new \RuntimeException('Selenium driver expected.');
        }

        return $webDriver->getWebDriverSession();
    }

    /**
     * Execute javascript
     *
     * @param string $name
     *
     * @throws PendingException
     *
     * @return mixed
     */
    public function evaluateJsFile($name)
    {
        $args     = array_slice(func_get_args(), 1);
        $filepath = sprintf('%s/scripts/%s.js', __DIR__, $name);

        if (!file_exists($filepath)) {
            throw new PendingException(
                sprintf(
                    'The file could not be found, you can create it in path "%s"',
                    $filepath
                )
            );
        }

        $script = file_get_contents($filepath);

        $result = $this
            ->getWebDriverSession()
            ->execute(
                [
                    'script' => 'return ('.$script.').apply(null, arguments);',
                    'args'   => $args
                ]
            );

        return $result;
    }
}
