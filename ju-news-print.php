<?php
/*
Plugin Name: Custom News Print
Description: From wp single post another single page template for single post
Version: 1.0
Author: Al Mamun - asifulmamun
Author URI: https://asifulmamun.info.bd

*/



class Custom_Post_URL {
    
    public function __construct() {
        add_filter('query_vars', array($this, 'custom_post_url_query_vars'));
        add_action('init', array($this, 'custom_post_url_rewrite_rule'));
        add_action('template_redirect', array($this, 'custom_post_url_template_redirect'));
    }
    
    public function custom_post_url_query_vars($query_vars) {
        $query_vars[] = 'post';
        return $query_vars;
    }
    
    public function custom_post_url_rewrite_rule() {
        add_rewrite_rule('^print$', 'index.php?post=1', 'top');
    }
    
    public function custom_post_url_template_redirect() {
        $custom_post_id = get_query_var('post');
        if ($custom_post_id) {
            include(plugin_dir_path(__FILE__) . 'custom-template.php');
            exit;
        }
    }
}

new Custom_Post_URL();
