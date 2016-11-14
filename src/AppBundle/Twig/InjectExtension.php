<?php


namespace AppBundle\Twig;


class InjectExtension extends \Twig_Extension
{
    private $kernelRootDir;

    function __construct($kernelRootDir)
    {
        $this->kernelRootDir = $kernelRootDir;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('inject', array($this, 'injectFilter')),
        );
    }

    public function injectFilter($fileWeb, $escape = null, $removeBreakLines = false)
    {
        $file= $this->kernelRootDir.'/../web'.$fileWeb;

        if (!file_exists($file))
            throw new \Exception('file doesnt exist');

        $file = file_get_contents($file);

        if ($escape)
            $file = str_replace($escape, "\\".$escape, $file);

        if ($removeBreakLines)
            $file = trim(preg_replace('/\s+/', ' ', $file));

        return $file;
    }

    public function getName()
    {
        return 'app_inject';
    }
}