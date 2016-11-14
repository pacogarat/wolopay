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
        $__internal_f2a5f3ced1f3f29c6f5e4ccf7164a866e8f9bcb91e9ff85617e138e8c177f7cf = $this->env->getExtension("native_profiler");
        $__internal_f2a5f3ced1f3f29c6f5e4ccf7164a866e8f9bcb91e9ff85617e138e8c177f7cf->enter($__internal_f2a5f3ced1f3f29c6f5e4ccf7164a866e8f9bcb91e9ff85617e138e8c177f7cf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/FormTable/form_row.html.php"));

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
        
        $__internal_f2a5f3ced1f3f29c6f5e4ccf7164a866e8f9bcb91e9ff85617e138e8c177f7cf->leave($__internal_f2a5f3ced1f3f29c6f5e4ccf7164a866e8f9bcb91e9ff85617e138e8c177f7cf_prof);

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
