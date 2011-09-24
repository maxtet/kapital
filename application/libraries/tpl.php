<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of tpl
 *
 * @author Big_Shark
 */
class Tpl
{

    var $template = 'default';
    var $dir = 'templates';
    var $layout = 'main';
    var $CI = '';
    var $name = 'content';
    var $vars = array();
    var $layout_vars = array();
    var $charset = 'utf-8';

    function Tpl($config)
    {
        $this->CI = & get_instance();
        $this->initialize($config);
    }

    function initialize($config=NULL)
    {
        if (!is_array($config))
        {
            $this->CI->config->load('tpl', TRUE);
            $config = $this->CI->config->item('tpl');
        }
        foreach ($config as $key => $value)
        {
            if (isset($this->$key))
                $this->$key = $value;
        }
    }

    function set_layout($layout = "main")
    {
        $this->layout = $layout;
    }

    function set_template($template = "default")
    {
        $this->template = $template;
    }

    function set($varName, $value)
    {
        $this->vars[$varName] = $value;
    }

    function set_global($varName, $value)
    {
        $this->layout_vars[$varName] = $value;
    }

    function block($view, $array=array(), $echo=TRUE)
    {
        return $this->CI->load->view($this->dir."/".$this->template."/blocks/".$view, $array, $echo);
    }

    function view($view, $array=array(), $echo=FALSE)
    {
        if (is_array($array) and $array)
            $array = array_merge_recursive($this->vars, $array);
        else
            $array=$this->vars;
        $this->CI->output->set_header("Content-type: text/html; charset=".$this->charset);
        $this->layout_vars[$this->name] = $this->CI->load->view($this->dir."/".$this->template."/".$view, $array, true);
        return $this->CI->load->view($this->dir."/".$this->template."/layout/".$this->layout, $this->layout_vars, $echo);
    }

}

