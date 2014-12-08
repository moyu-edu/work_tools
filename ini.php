<?php
$template = <<<EOF
<VirtualHost *:80>
        DocumentRoot /Users/ericzheng/jumei/eric_&/jumei_web_eric_51441
        ServerName   zw@.com 
        ServerAlias  www.zw@.com bj.zw@.com mall.zw@.com pop.zw@.com search.zw@.com beauty.zw@.com scp.zw@.com
         <Directory /Users/ericzheng/jumei/eric_51441/jumei_web_eric_51441>
                Options Indexes FollowSymlinks
                Allow from All
                RewriteEngine on
                RewriteCond %{REQUEST_FILENAME} !-l
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteRule (.*) index.php?_rp_=$1 [QSA,L]
        </Directory>
 </VirtualHost>


 <VirtualHost *:80>
      DocumentRoot /Users/ericzheng/jumei/eric_&/jumei_static_files
      ServerName zw@static.com
      ##ServerAlias zw@static.com
          <Directory /Users/ericzheng/jumei/eric_&/jumei_static_files>
              Allow from all
          </Directory>
 </VirtualHost>
EOF;

$patterns = array();
$patterns[0] = '/@/';
$patterns[1] = '/&/';
$replacement = array();
$replacement[0] = '1';
$replacement[1] = '545845';
echo preg_replace($patterns,$replacement,$template);
