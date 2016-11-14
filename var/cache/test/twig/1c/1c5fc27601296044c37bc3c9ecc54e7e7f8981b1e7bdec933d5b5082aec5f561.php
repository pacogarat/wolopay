<?php

/* @Framework/Form/form_end.html.php */
class __TwigTemplate_6b95c8cc1564fd91b09915c86102b8da7636890c97b6cbc83ec70141b205bd17 extends Twig_Template
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
        $__internal_62663089c441c9188982ee62387316d5b88a575847bf9e9d85ebf4d58f834ea0 = $this->env->getExtension("native_profiler");
        $__internal_62663089c441c9188982ee62387316d5b88a575847bf9e9d85ebf4d58f834ea0->enter($__internal_62663089c441c9188982ee62387316d5b88a575847bf9e9d85ebf4d58f834ea0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_end.html.php"));

        // line 1
        echo "<?php if (!isset(\$render_rest) || \$render_rest): ?>
<?php echo \$view['form']->rest(\$form) ?>
<?php endif ?>
</form>
";
        
        $__internal_62663089c441c9188982ee62387316d5b88a575847bf9e9d85ebf4d58f834ea0->leave($__internal_62663089c441c9188982ee62387316d5b88a575847bf9e9d85ebf4d58f834ea0_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_end.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php if (!isset($render_rest) || $render_rest): ?>*/
/* <?php echo $view['form']->rest($form) ?>*/
/* <?php endif ?>*/
/* </form>*/
/* */
