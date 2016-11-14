<?php


namespace AppBundle\Twig;


class InjectExternalContentExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('injectExternalContent', array($this, 'injectExternalContentFilter')),
        );
    }

    public function injectExternalContentFilter($fileWeb)
    {
        return $this->curl($fileWeb);
    }

    private function curl($fileWeb)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $fileWeb);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function getName()
    {
        return 'app_inject_external_content';
    }
}