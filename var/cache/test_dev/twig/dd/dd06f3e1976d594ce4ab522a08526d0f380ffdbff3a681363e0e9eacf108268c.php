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
        $__internal_b157baaab02a2ea4c616a935f5c7bfd1f00922f796ce8d6b3971e46036f5dbfe = $this->env->getExtension("native_profiler");
        $__internal_b157baaab02a2ea4c616a935f5c7bfd1f00922f796ce8d6b3971e46036f5dbfe->enter($__internal_b157baaab02a2ea4c616a935f5c7bfd1f00922f796ce8d6b3971e46036f5dbfe_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_errors.html.php"));

        // line 1
        echo "<?php if (count(\$errors) > 0): ?>
    <ul>
        <?php foreach (\$errors as \$error): ?>
            <li><?php echo \$error->getMessage() ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>
";
        
        $__internal_b157baaab02a2ea4c616a935f5c7bfd1f00922f796ce8d6b3971e46036f5dbfe->leave($__internal_b157baaab02a2ea4c616a935f5c7bfd1f00922f796ce8d6b3971e46036f5dbfe_prof);

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
