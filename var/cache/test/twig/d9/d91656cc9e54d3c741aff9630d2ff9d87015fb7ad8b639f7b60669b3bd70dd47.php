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
        $__internal_ff3becaee48fb234d5ed8dc63077315f659197da22f8bd1d1bbf3d43d65f61bc = $this->env->getExtension("native_profiler");
        $__internal_ff3becaee48fb234d5ed8dc63077315f659197da22f8bd1d1bbf3d43d65f61bc->enter($__internal_ff3becaee48fb234d5ed8dc63077315f659197da22f8bd1d1bbf3d43d65f61bc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_rows.html.php"));

        // line 1
        echo "<?php foreach (\$form as \$child) : ?>
    <?php echo \$view['form']->row(\$child) ?>
<?php endforeach; ?>
";
        
        $__internal_ff3becaee48fb234d5ed8dc63077315f659197da22f8bd1d1bbf3d43d65f61bc->leave($__internal_ff3becaee48fb234d5ed8dc63077315f659197da22f8bd1d1bbf3d43d65f61bc_prof);

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
