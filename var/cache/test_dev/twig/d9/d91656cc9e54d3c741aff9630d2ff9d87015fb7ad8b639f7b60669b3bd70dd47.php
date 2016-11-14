<?php

/* @Framework/Form/form_rows.html.php */
class __TwigTemplate_51da1f15ef1c85d9ae9d471b558ca63f6f816c3bec2da2929636f54b16fdee18 extends Twig_Template
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
        $__internal_c2d2272cf4b1dda8ab2c0ed8edacaf082f4f92ec939c4ec6fee8a11e2bfb51f4 = $this->env->getExtension("native_profiler");
        $__internal_c2d2272cf4b1dda8ab2c0ed8edacaf082f4f92ec939c4ec6fee8a11e2bfb51f4->enter($__internal_c2d2272cf4b1dda8ab2c0ed8edacaf082f4f92ec939c4ec6fee8a11e2bfb51f4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_rows.html.php"));

        // line 1
        echo "<?php foreach (\$form as \$child) : ?>
    <?php echo \$view['form']->row(\$child) ?>
<?php endforeach; ?>
";
        
        $__internal_c2d2272cf4b1dda8ab2c0ed8edacaf082f4f92ec939c4ec6fee8a11e2bfb51f4->leave($__internal_c2d2272cf4b1dda8ab2c0ed8edacaf082f4f92ec939c4ec6fee8a11e2bfb51f4_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_rows.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php foreach ($form as $child) : ?>*/
/*     <?php echo $view['form']->row($child) ?>*/
/* <?php endforeach; ?>*/
/* */
