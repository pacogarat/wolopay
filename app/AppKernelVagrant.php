<?php

require_once __DIR__.'/AppKernel.php';

class AppKernelVagrant extends AppKernel
{
    public function getCacheDir()
    {
        if (in_array($this->environment, array('dev', 'test'))) {

            if (!file_exists('/tmp/nvia/wolopay/cache')) {
                mkdir('/tmp/nvia/wolopay/cache', 0777, true);
            }

            return '/tmp/nvia/wolopay/cache/' . $this->environment;
        }

        return parent::getCacheDir();
    }

    public function getLogDir()
    {
        if (in_array($this->environment, array('dev', 'test'))) {

            if (!file_exists('/tmp/nvia/wolopay/logs')) {
                mkdir('/tmp/nvia/wolopay/logs', 0777, true);
            }
            return '/tmp/nvia/wolopay/logs';
        }

        return parent::getLogDir();
    }

}
