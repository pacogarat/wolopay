<?php

/* @Framework/Form/form_errors.html.php */
class __TwigTemplate_ca92d620a1f84562a81c67b1aa9862d1fb71fcfc14b92650f2e57eac36f52c78 extends Twig_Template
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
        $__internal_5b52bae7195da28de4fa0e17fc06d7c94e29cba3225dfa8b8ba9d8396fff9603 = $this->env->getExtension("native_profiler");
        $__internal_5b52bae7195da28de4fa0e17fc06d7c94e29cba3225dfa8b8ba9d8396fff9603->enter($__internal_5b52bae7195da28de4fa0e17fc06d7c94e29cba3225dfa8b8ba9d8396fff9603_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_errors.html.php"));

        // line 1
        echo "<?php if (count(\$errors) > 0): ?>
    <ul>
        <?php foreach (\$errors as \$error): ?>
            <li><?php echo \$error->getMessage() ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>
";
        
        $__internal_5b52bae7195da28de4fa0e17fc06d7c94e29cba3225dfa8b8ba9d8396fff9603->leave($__internal_5b52bae7195da28de4fa0e17fc06d7c94e29cba3225dfa8b8ba9d8396fff9603_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_errors.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php if (count($errors) > 0): ?>*/
/*     <ul>*/
/*         <?php foreach ($errors as $error): ?>*/
/*             <li><?php echo $error->getMessage() ?></li>*/
/*         <?php endforeach; ?>*/
/*     </ul>*/
/* <?php endif ?>*/
/* */
