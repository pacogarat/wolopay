<?php

/* @Framework/FormTable/form_row.html.php */
class __TwigTemplate_b0ee3050ed0f2ef831bea786babece6b56d43665aa829246e1ee1c0ce2619406 extends Twig_Template
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
        $__internal_398118a7a1dab008b989aea37f1718afeebeda0ef7dcfff7d0c67a39612a8030 = $this->env->getExtension("native_profiler");
        $__internal_398118a7a1dab008b989aea37f1718afeebeda0ef7dcfff7d0c67a39612a8030->enter($__internal_398118a7a1dab008b989aea37f1718afeebeda0ef7dcfff7d0c67a39612a8030_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/FormTable/form_row.html.php"));

        // line 1
        echo "<tr>
    <td>
        <?php echo \$view['form']->label(\$form) ?>
    </td>
    <td>
        <?php echo \$view['form']->errors(\$form) ?>
        <?php echo \$view['form']->widget(\$form) ?>
    </td>
</tr>
";
        
        $__internal_398118a7a1dab008b989aea37f1718afeebeda0ef7dcfff7d0c67a39612a8030->leave($__internal_398118a7a1dab008b989aea37f1718afeebeda0ef7dcfff7d0c67a39612a8030_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/FormTable/form_row.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <tr>*/
/*     <td>*/
/*         <?php echo $view['form']->label($form) ?>*/
/*     </td>*/
/*     <td>*/
/*         <?php echo $view['form']->errors($form) ?>*/
/*         <?php echo $view['form']->widget($form) ?>*/
/*     </td>*/
/* </tr>*/
/* */
