<?php

$subdomain = current(explode('.', $_SERVER['HTTP_HOST']));
if ($subdomain == 'dev' || $subdomain == 'marketvibor') {
    $subdomain = '';
} else {
    $subdomain = $subdomain.'.';
} ?>

<html>
    <head></head>
    <body>
        <pre style="word-wrap: break-word; white-space: pre-wrap;">
            User-agent: *
            Disallow: /backend/
            Disallow: /common/
            Disallow: /*index.php$
            Disallow: /user/
            Disallow: /admin/
            Disallow: /*?q=
            Disallow: /*personal
            Sitemap: https://<?= $subdomain ?>marketvibor.ru/sitemap.xml

            #User-agent: Google
            #Sitemap: https://<?= $subdomain ?>marketvibor.ru/video-sitemap.xml

            User-agent: Yandex
            Disallow: /backend/
            Disallow: /common/
            Disallow: /*index.php$
            Disallow: /user/
            Disallow: /admin/
            Disallow: /*?q=
            Disallow: /*personal
            Host: https://<?= $subdomain ?>MarketVibor.ru
            Sitemap: htps://<?= $subdomain ?>marketvibor.ru/sitemap.xml

            User-agent: AhrefsBot
            Disallow: /
        </pre>
    </body>
</html>

