<?php

/* ::base.html.twig */
class __TwigTemplate_a9863a3fdbdd843da1caa8e69f9a5ebe extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts_libs' => array($this, 'block_javascripts_libs'),
            'body' => array($this, 'block_body'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 9
        echo "        ";
        $this->displayBlock('javascripts_libs', $context, $blocks);
        // line 15
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 18
        $this->displayBlock('body', $context, $blocks);
        // line 23
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 26
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "            <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/boutique/css/gestionStock_main.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
        ";
    }

    // line 9
    public function block_javascripts_libs($context, array $blocks = array())
    {
        // line 10
        echo "            <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/boutique/js/libs/jquery-1.8.2.min.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/boutique/js/libs/jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/boutique/js/libs/jquery.forms.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/boutique/js/bundles/gestionStock_main.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    // line 18
    public function block_body($context, array $blocks = array())
    {
        // line 19
        echo "            <div id=\"banner\">";
        $this->env->loadTemplate("::_banner.html.twig")->display($context);
        echo "</div>
            <div id=\"body_content\">";
        // line 20
        $this->displayBlock('content', $context, $blocks);
        echo "</div>
            <div id=\"side_links\">";
        // line 21
        $this->env->loadTemplate("::_side_links.html.twig")->display($context);
        echo "</div>
        ";
    }

    // line 20
    public function block_content($context, array $blocks = array())
    {
    }

    // line 23
    public function block_javascripts($context, array $blocks = array())
    {
        // line 24
        echo "            <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/boutique/js/bundles/main.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 24,  119 => 23,  114 => 20,  108 => 21,  104 => 20,  99 => 19,  96 => 18,  90 => 13,  86 => 12,  82 => 11,  77 => 10,  64 => 6,  58 => 5,  47 => 18,  40 => 15,  37 => 9,  35 => 6,  25 => 1,  65 => 14,  61 => 13,  57 => 12,  52 => 26,  49 => 23,  44 => 8,  38 => 5,  33 => 4,  30 => 3,  112 => 51,  102 => 44,  95 => 40,  88 => 36,  81 => 32,  74 => 9,  67 => 7,  60 => 20,  53 => 16,  46 => 12,  36 => 7,  31 => 5,  28 => 3,);
    }
}
