<?php

/* @Framework/Form/form_rest.html.php */
class __TwigTemplate_b8210a7a52db570e6c222899e19373b347f2f3946d4f04aa847bd286cd841714 extends Twig_Template
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
        $__internal_6784c85b210dd702f0267edd2d21e85a36bc9e0cae2fc828b0f6a77e2714df67 = $this->env->getExtension("native_profiler");
        $__internal_6784c85b210dd702f0267edd2d21e85a36bc9e0cae2fc828b0f6a77e2714df67->enter($__internal_6784c85b210dd702f0267edd2d21e85a36bc9e0cae2fc828b0f6a77e2714df67_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_rest.html.php"));

        // line 1
        echo "<?php foreach (\$form as \$child): ?>
    <?php if (!\$child->isRendered()): ?>
        <?php echo \$view['form']->row(\$child) ?>
    <?php endif; ?>
<?php endforeach; ?>
";
        
        $__internal_6784c85b210dd702f0267edd2d21e85a36bc9e0cae2fc828b0f6a77e2714df67->leave($__internal_6784c85b210dd702f0267edd2d21e85a36bc9e0cae2fc828b0f6a77e2714df67_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_rest.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php foreach ($form as $child): ?>*/
/*     <?php if (!$child->isRendered()): ?>*/
/*         <?php echo $view['form']->row($child) ?>*/
/*     <?php endif; ?>*/
/* <?php endforeach; ?>*/
/* */
