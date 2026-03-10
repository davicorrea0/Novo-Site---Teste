<?php
function my_custom_email_content_type()
{
    return 'text/html';
}
add_filter( 'wp_mail_content_type', 'my_custom_email_content_type' );
