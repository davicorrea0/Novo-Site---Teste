<?php
/**
 *  Minify html from WYSIWYG editors
 */
function minify_html($html)
{
   $search = [
    '/(\n|^)(\x20+|\t)/',
    '/(\n|^)\/\/(.*?)(\n|$)/',
    '/\n/',
    '/\<\!--.*?-->/',
    '/(\x20+|\t)/', # Delete multispace (Without \n)
    '/\>\s+\</', # strip whitespaces between tags
    '/(\"|\')\s+\>/', # strip whitespaces between quotation ("') and end tags
    '/=\s+(\"|\')/']; # strip whitespaces between = "'
   $replace = [
    "\n",
    "\n",
    " ",
    "",
    " ",
    "><",
    "$1>",
    "=$1"];
    $html = preg_replace($search,$replace,$html);
    return $html;
}

add_filter( 'the_content', 'minify_html',  1 );
add_filter( 'acf_the_content', 'minify_html',  1 );
