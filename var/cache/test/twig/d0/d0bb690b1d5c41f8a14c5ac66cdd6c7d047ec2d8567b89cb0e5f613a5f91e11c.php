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
        $__internal_74e137d4ed06a31ac614c61db269eae9df95152dd2d22c6e6c27226dad8cb638 = $this->env->getExtension("native_profiler");
        $__internal_74e137d4ed06a31ac614c61db269eae9df95152dd2d22c6e6c27226dad8cb638->enter($__internal_74e137d4ed06a31ac614c61db269eae9df95152dd2d22c6e6c27226dad8cb638_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/FormTable/hidden_row.html.php"));

        // line 1
        echo "<tr style=\"display: none\">
    <td colspan=\"2\">
        <?php echo \$view['form']->widget(\$form) ?>
    </td>
</tr>
";
        
        $__internal_74e137d4ed06a31ac614c61db269eae9df95152dd2d22c6e6c27226dad8cb638->leave($__internal_74e137d4ed06a31ac614c61db269eae9df95152dd2d22c6e6c27226dad8cb638_prof);

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
