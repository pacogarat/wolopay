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
        $__internal_3a80107d7c5fc9bdbf596db5e609e8f6916173035e5d2e4c794d4f9d872f53aa = $this->env->getExtension("native_profiler");
        $__internal_3a80107d7c5fc9bdbf596db5e609e8f6916173035e5d2e4c794d4f9d872f53aa->enter($__internal_3a80107d7c5fc9bdbf596db5e609e8f6916173035e5d2e4c794d4f9d872f53aa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_end.html.php"));

        // line 1
        echo "<?php if (!isset(\$render_rest) || \$render_rest): ?>
<?php echo \$view['form']->rest(\$form) ?>
<?php endif ?>
</form>
";
        
        $__internal_3a80107d7c5fc9bdbf596db5e609e8f6916173035e5d2e4c794d4f9d872f53aa->leave($__internal_3a80107d7c5fc9bdbf596db5e609e8f6916173035e5d2e4c794d4f9d872f53aa_prof);

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
