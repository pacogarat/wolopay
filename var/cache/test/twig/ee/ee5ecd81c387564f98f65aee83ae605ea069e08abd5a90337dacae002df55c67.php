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
        $__internal_759c6d41f6a69a578ab6caad2eca553c878ea72d72a172a3e9f7aedebc4b4312 = $this->env->getExtension("native_profiler");
        $__internal_759c6d41f6a69a578ab6caad2eca553c878ea72d72a172a3e9f7aedebc4b4312->enter($__internal_759c6d41f6a69a578ab6caad2eca553c878ea72d72a172a3e9f7aedebc4b4312_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/button_widget.html.php"));

        // line 1
        echo "<?php if (!\$label) { \$label = isset(\$label_format)
    ? strtr(\$label_format, array('%name%' => \$name, '%id%' => \$id))
    : \$view['form']->humanize(\$name); } ?>
<button type=\"<?php echo isset(\$type) ? \$view->escape(\$type) : 'button' ?>\" <?php echo \$view['form']->block(\$form, 'button_attributes') ?>><?php echo \$view->escape(false !== \$translation_domain ? \$view['translator']->trans(\$label, array(), \$translation_domain) : \$label) ?></button>
";
        
        $__internal_759c6d41f6a69a578ab6caad2eca553c878ea72d72a172a3e9f7aedebc4b4312->leave($__internal_759c6d41f6a69a578ab6caad2eca553c878ea72d72a172a3e9f7aedebc4b4312_prof);

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
