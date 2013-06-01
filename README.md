z-mvc
=====

Z-MVC.The simple, no bells, no whistles, MVC PHP framework. Uses the awesome 
Twitter Bootstrap UI library.

Set up an nginx or apache2 configuration to get started! Here is a sample config
to help you get started:

Configuration for nginx, assuming you want to run it as 'local.zmvc.com'.
You must have PHP5, php-fpm, and nginx installed on your system for this to 
work.

nginx config
=====
```
server {
    listen 80;
    server_name local.zmvc.com;
    root /path/to/z-mvc/html;
    index index.php index.html;

    location ~* ^.+.(css|js|jpeg|jpg|gif|png|ico) {
        expires 30d;
    }
    location / {
        try_files $uri $uri/ /index.php$args;
    }
    location ~ .(php|phtml)$ {
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index /index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

        include /etc/nginx/fastcgi_params;
    }

}

server {
        listen 443;
        server_name local.zmvc.com;
        root /path/to/z-mvc/html;
        index /index.php;

        location ~* ^.+.(css|js|jpeg|jpg|gif|png|ico) {
            expires 30d;
        }

        location ~ .(php|phtml)$ {
                fastcgi_pass unix:/var/run/php5-fpm.sock;
                fastcgi_index /index.php;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

                include /etc/nginx/fastcgi_params;
        }


        ssl on;
        ssl_certificate /etc/ssl/certs/ssl-cert-snakeoil.pem;#cert.pem;
        ssl_certificate_key /etc/ssl/private/ssl-cert-snakeoil.key;#cert.key;

        ssl_session_timeout 5m;

        ssl_protocols SSLv3 TLSv1;
        ssl_ciphers ALL:!ADH:!EXPORT56:RC4+RSA:+HIGH:+MEDIUM:+LOW:+SSLv3:+EXP;
        ssl_prefer_server_ciphers on;
}
```


Here's an Apache2 configuration. Requires Apache2, PHP5, and the Apache2 mod_rewrite module ('rewrite') to be enabled.
Again, this is assuming you are running it under local.zrecore.com

apache2 (HTTP) conf
=====
```
<VirtualHost *:80>
        ServerName local.zrecore.com
        ServerAdmin webmaster@localhost
        ServerAlias local.zrecore.com

        DocumentRoot /path/to/z-mvc/html
        <Directory /path/to/z-mvc/html>
                Options Indexes FollowSymLinks
                AllowOverride All
                Order allow,deny
                allow from all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log

        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn

        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```


Once you've set up your nginx or apache2 config, remember to enable your config!

For nginx, you will need to make a symlink to your config file, and place the 
symlink inside of sites-enabled before running 'sudo service nginx restart'.

For apache2, you will simply need to run 'sudo a2ensite [your_config_file_name]'
then 'sudo service apache2 reload'

If you're running stuff off of your local machine, you will also need to add an 
alias to your /etc/hosts file. Simply add the following to the bottom:

```
127.0.0.1	local.z-mvc.com
```


Now, when you browse to local.z-mvc.com, you should be presented with a sample 
landing page.