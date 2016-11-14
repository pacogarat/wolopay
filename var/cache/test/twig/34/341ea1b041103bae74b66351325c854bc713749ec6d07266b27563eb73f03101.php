<?php

/* @Framework/FormTable/form_widget_compound.html.php */
class __TwigTemplate_b6c9c07ea0c8bc445f1365fa8944d557aaa69256d35039c1ddea73f7e9971e5a extends Twig_Template
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
        $__internal_4af7a82c0a58e242f2447718662f72375a32ea55ce8c1744beb022edeacea3d6 = $this->env->getExtension("native_profiler");
        $__internal_4af7a82c0a58e242f2447718662f72375a32ea55ce8c1744beb022edeacea3d6->enter($__internal_4af7a82c0a58e242f2447718662f72375a32ea55ce8c1744beb022edeacea3d6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/FormTable/form_widget_compound.html.php"));

        // line 1
        echo "<table <?php echo \$view['form']->block(\$form, 'widget_container_attributes') ?>>
    <?php if (!\$form->parent && \$errors): ?>
    <tr>
        <td colspan=\"2\">
            <?php echo \$view['form']->errors(\$form) ?>
        </td>
    </tr>
    <?php endif ?>
    <?php echo \$view['form']->block(\$form, 'form_rows') ?>
    <?php echo \$view['form']->rest(\$form) ?>
</table>
";
        
        $__internal_4af7a82c0a58e242f2447718662f72375a32ea55ce8c1744beb022edeacea3d6->leave($__internal_4af7a82c0a58e242f2447718662f72375a32ea55ce8c1744beb022edeacea3d6_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/FormTable/form_widget_compound.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <table <?php echo $view['form']->block($form, 'widget_container_attributes') ?>>*/
/*     <?php if (!$form->parent && $errors): ?>*/
/*     <tr>*/
/*         <td colspan="2">*/
/*             <?php echo $view['form']->errors($form) ?>*/
/*         </td>*/
/*     </tr>*/
/*     <?php endif ?>*/
/*     <?php echo $view['form']->block($form, 'form_rows') ?>*/
/*     <?php echo $view['form']->rest($form) ?>*/
/* </table>*/
/* */
