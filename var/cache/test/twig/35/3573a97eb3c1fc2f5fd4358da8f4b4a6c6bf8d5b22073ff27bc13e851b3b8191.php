<?php

/* @Framework/Form/form_enctype.html.php */
class __TwigTemplate_9dc44667242687c10463c04747b253abf33e2d7b3bebdb9e9afe15ca340eb68b extends Twig_Template
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
        $__internal_189d4358f05144ef2c26f4be15b7109cccbbd15ff0d925bd6422804379d56a3d = $this->env->getExtension("native_profiler");
        $__internal_189d4358f05144ef2c26f4be15b7109cccbbd15ff0d925bd6422804379d56a3d->enter($__internal_189d4358f05144ef2c26f4be15b7109cccbbd15ff0d925bd6422804379d56a3d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_enctype.html.php"));

        // line 1
        echo "<?php if (\$form->vars['multipart']): ?>enctype=\"multipart/form-data\"<?php endif ?>
";
        
        $__internal_189d4358f05144ef2c26f4be15b7109cccbbd15ff0d925bd6422804379d56a3d->leave($__internal_189d4358f05144ef2c26f4be15b7109cccbbd15ff0d925bd6422804379d56a3d_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_enctype.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php if ($form->vars['multipart']): ?>enctype="multipart/form-data"<?php endif ?>*/
/* */
