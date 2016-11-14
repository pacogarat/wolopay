<?php


namespace AppBundle\Twig;


/**
 * A twig extension that will add an "evaluate" filter, for dynamic evaluation.
 */
class EvaluateExtension extends \Twig_Extension
{
    /**
     * Attaches the innervars filter to the Twig Environment.
     *
     * @return array
     */
    public function getFilters( )
    {
        return [
            new \Twig_SimpleFilter(
                'evaluate',
                [$this, 'evaluateFilter'],
                [
                    'needs_environment' => true,
                    'needs_context' => true,
                    'is_safe' => [
                        'evaluate' => true
                    ]
                ]
            )
        ];
    }

    /**
     * This function will evaluate $string through the $environment, and return its results.
     *
     * @param \Twig_Environment $environment
     * @param array $context
     * @param string $string
     * @return string
     */
    public function evaluateFilter( \Twig_Environment $environment, $context, $string ) {
        $loader = $environment->getLoader( );

        $parsed = $this->parseString( $environment, $context, $string );

        $environment->setLoader( $loader );
        return $parsed;
    }

    /**
     * Sets the parser for the environment to Twig_Loader_String, and parsed the string $string.
     *
     * @param \Twig_Environment $environment
     * @param array $context
     * @param string $string
     * @return string
     */
    protected function parseString( \Twig_Environment $environment, $context, $string ) {
        $environment->setLoader( new \Twig_Loader_String( ) );
        return $environment->render( $string, $context );
    }

    /**
     * Returns the name of this extension.
     *
     * @return string
     */
    public function getName( ) {
        return 'app_evaluate';
    }
}