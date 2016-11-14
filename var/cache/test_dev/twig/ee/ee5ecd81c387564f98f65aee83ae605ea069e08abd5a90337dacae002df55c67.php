<?php

/* @Framework/Form/button_widget.html.php */
class __TwigTemplate_162575e50b72b3210c14708def5f4eaf92983ebb3bd5b387b51027e646d30efa extends Twig_Template
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
        $__internal_a95b08be2f5c159f6f45128ba914b73d86edda8582936261055e4bc93005f18f = $this->env->getExtension("native_profiler");
        $__internal_a95b08be2f5c159f6f45128ba914b73d86edda8582936261055e4bc93005f18f->enter($__internal_a95b08be2f5c159f6f45128ba914b73d86edda8582936261055e4bc93005f18f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/button_widget.html.php"));

        // line 1
        echo "<?php if (!\$label) { \$label = isset(\$label_format)
    ? strtr(\$label_format, array('%name%' => \$name, '%id%' => \$id))
    : \$view['form']->humanize(\$name); } ?>
<button type=\"<?php echo isset(\$type) ? \$view->escape(\$type) : 'button' ?>\" <?php echo \$view['form']->block(\$form, 'button_attributes') ?>><?php echo \$view->escape(false !== \$translation_domain ? \$view['translator']->trans(\$label, array(), \$translation_domain) : \$label) ?></button>
";
        
        $__internal_a95b08be2f5c159f6f45128ba914b73d86edda8582936261055e4bc93005f18f->leave($__internal_a95b08be2f5c159f6f45128ba914b73d86edda8582936261055e4bc93005f18f_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/button_widget.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php if (!$label) { $label = isset($label_format)*/
/*     ? strtr($label_format, array('%name%' => $name, '%id%' => $id))*/
/*     : $view['form']->humanize($name); } ?>*/
/* <button type="<?php echo isset($type) ? $view->escape($type) : 'button' ?>" <?php echo $view['form']->block($form, 'button_attributes') ?>><?php echo $view->escape(false !== $translation_domain ? $view['translator']->trans($label, array(), $translation_domain) : $label) ?></button>*/
/* */
