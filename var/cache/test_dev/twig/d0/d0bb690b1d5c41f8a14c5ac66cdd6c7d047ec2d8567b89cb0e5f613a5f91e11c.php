<?php

/* @Framework/FormTable/hidden_row.html.php */
class __TwigTemplate_9f0b7ab87db05f0e588b515d50d1d495e5fddc5a5b7853792a7637f51a54ef43 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_dde0824d43eb9a7da154b0aff5f60c796907e7ea285a482da631d5b14ca41daa = $this->env->getExtension("native_profiler");
        $__internal_dde0824d43eb9a7da154b0aff5f60c796907e7ea285a482da631d5b14ca41daa->enter($__internal_dde0824d43eb9a7da154b0aff5f60c796907e7ea285a482da631d5b14ca41daa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/FormTable/hidden_row.html.php"));

        // line 1
        echo "<tr style=\"display: none\">
    <td colspan=\"2\">
        <?php echo \$view['form']->widget(\$form) ?>
    </td>
</tr>
";
        
        $__internal_dde0824d43eb9a7da154b0aff5f60c796907e7ea285a482da631d5b14ca41daa->leave($__internal_dde0824d43eb9a7da154b0aff5f60c796907e7ea285a482da631d5b14ca41daa_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/FormTable/hidden_row.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <tr style="display: none">*/
/*     <td colspan="2">*/
/*         <?php echo $view['form']->widget($form) ?>*/
/*     </td>*/
/* </tr>*/
/* */
