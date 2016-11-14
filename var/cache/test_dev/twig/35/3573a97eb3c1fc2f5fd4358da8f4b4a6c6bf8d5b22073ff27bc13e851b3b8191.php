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
        $__internal_b9c57958ca38d25f9a5b27be8bbace59772e901e8706441e98f901340b0a71a7 = $this->env->getExtension("native_profiler");
        $__internal_b9c57958ca38d25f9a5b27be8bbace59772e901e8706441e98f901340b0a71a7->enter($__internal_b9c57958ca38d25f9a5b27be8bbace59772e901e8706441e98f901340b0a71a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_enctype.html.php"));

        // line 1
        echo "<?php if (\$form->vars['multipart']): ?>enctype=\"multipart/form-data\"<?php endif ?>
";
        
        $__internal_b9c57958ca38d25f9a5b27be8bbace59772e901e8706441e98f901340b0a71a7->leave($__internal_b9c57958ca38d25f9a5b27be8bbace59772e901e8706441e98f901340b0a71a7_prof);

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
