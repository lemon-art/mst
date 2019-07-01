<?php

$subdomain = current(explode('.', $_SERVER['HTTP_HOST']));
if ($subdomain == 'dev' || $subdomain == 'marketvibor') {
    $subdomain = '';
} else {
    $subdomain = $subdomain.'.';
} ?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style id="xml-viewer-style">
            div.header {
                border-bottom: 2px solid black;
                padding-bottom: 5px;
                margin: 10px;
            }

            div.collapsible &gt; div.hidden {
                                     display:none;
                                 }

            .pretty-print {
                margin-top: 1em;
                margin-left: 20px;
                font-family: monospace;
                font-size: 13px;
            }

            #webkit-xml-viewer-source-xml {
                display: none;
            }

            .collapsible-content {
                margin-left: 1em;
            }
            .comment {
                white-space: pre;
            }

            .button {
                -webkit-user-select: none;
                cursor: pointer;
                display: inline-block;
                margin-left: -10px;
                width: 10px;
                background-repeat: no-repeat;
                background-position: left top;
                vertical-align: bottom;
            }

            .collapse-button {
                background: url("data:image/svg+xml,&lt;svg xmlns='http://www.w3.org/2000/svg' fill='%23909090' width='10' height='10'&gt;&lt;path d='M0 0 L8 0 L4 7 Z'/&gt;&lt;/svg&gt;");
                height: 10px;
            }

            .expand-button {
                background: url("data:image/svg+xml,&lt;svg xmlns='http://www.w3.org/2000/svg' fill='%23909090' width='10' height='10'&gt;&lt;path d='M0 0 L0 8 L7 4 Z'/&gt;&lt;/svg&gt;");
                height: 10px;
            }
        </style>
    </head>
    <body><div id="webkit-xml-viewer-source-xml">
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/</loc>
                <lastmod>2019-06-13T11:19:05+01:00</lastmod>
                <priority>1.0</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/services/credit/</loc>
                <lastmod>2019-06-13T11:19:07+01:00</lastmod>
                <priority>0.9</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/services/ipoteka/</loc>
                <lastmod>2019-06-13T11:19:39+01:00</lastmod>
                <priority>0.9</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/services/deposit/</loc>
                <lastmod>2019-06-13T11:19:11+01:00</lastmod>
                <priority>0.9</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/services/credit-cards/</loc>
                <lastmod>2019-06-13T11:19:16+01:00</lastmod>
                <priority>0.9</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/services/debet-cards/</loc>
                <lastmod>2019-06-13T11:19:15+01:00</lastmod>
                <priority>0.9</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/services/credit-auto/</loc>
                <lastmod>2019-06-13T11:19:18+01:00</lastmod>
                <priority>0.9</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/services/rko/</loc>
                <lastmod>2019-06-13T11:19:16+01:00</lastmod>
                <priority>0.9</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/specoffers/</loc>
                <lastmod>2019-06-13T11:19:17+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/karty-dlya-snyatiya-nalichnyh-zagranicej-besplatno/</loc>
                <lastmod>2019-06-13T11:19:28+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/skol-ko-deneg-ty-tratish/</loc>
                <lastmod>2019-06-13T11:19:28+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/-chernaya-pyatnica-a-ne-obmanyvayut-li-nas/</loc>
                <lastmod>2019-06-13T11:19:29+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/karty-s-milyami-dlya-puteshestvennikov/</loc>
                <lastmod>2019-06-13T11:19:29+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/refinansirovanie-ip-pochemu-banki-otkazyvayut/</loc>
                <lastmod>2019-06-13T11:19:29+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/den-gi-v-kredit/</loc>
                <lastmod>2019-06-13T11:19:30+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/kreditnaya-karta-tvoj-pravil-nyj-vybor/</loc>
                <lastmod>2019-06-13T11:19:30+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/zajmy-i-kreditnye-linii-s-zalogovoj-garantiej/</loc>
                <lastmod>2019-06-13T11:19:30+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/den-gi-v-nizhnem-novgorode/</loc>
                <lastmod>2019-06-13T11:19:31+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/kak-zaregistrirovat-kreditnuyu-kartu/</loc>
                <lastmod>2019-06-13T11:19:31+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/komissiya-po-kreditu-kotoraya-ostavlyaet-zaemshikov-bez-deneg-/</loc>
                <lastmod>2019-06-13T11:19:32+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/articles/kak-vzyat-kredit-dlya-malogo-biznesa-bez-zaloga-i-poruchitelej/</loc>
                <lastmod>2019-06-13T11:19:32+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/contacts/</loc>
                <lastmod>2019-06-13T11:19:32+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/about/</loc>
                <lastmod>2019-06-13T11:19:32+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/terms_of_cooperation/</loc>
                <lastmod>2019-06-13T11:19:33+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/terms_of_banks/</loc>
                <lastmod>2019-06-13T11:19:33+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/rules/</loc>
                <lastmod>2019-06-13T11:19:34+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/policy/</loc>
                <lastmod>2019-06-13T11:19:34+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/qiwi/</loc>
                <lastmod>2019-06-13T11:19:38+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/akbars/</loc>
                <lastmod>2019-06-13T11:19:38+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/tochka-bank/</loc>
                <lastmod>2019-06-13T11:19:38+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/absolute/</loc>
                <lastmod>2019-06-13T11:19:38+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/Delobank/</loc>
                <lastmod>2019-06-13T11:19:39+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/raiffeisen/</loc>
                <lastmod>2019-06-13T11:19:39+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/vostbank/</loc>
                <lastmod>2019-06-13T11:19:40+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/skb-bank/</loc>
                <lastmod>2019-06-13T11:19:40+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/banks/alfabank/</loc>
                <lastmod>2019-06-13T11:20:02+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/reviews/4/</loc>
                <lastmod>2019-06-13T11:19:40+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/reviews/5/</loc>
                <lastmod>2019-06-13T11:19:41+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/reviews/6/</loc>
                <lastmod>2019-06-13T11:19:41+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/reviews/7/</loc>
                <lastmod>2019-06-13T11:19:41+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/reviews/8/</loc>
                <lastmod>2019-06-13T11:19:42+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/reviews/9/</loc>
                <lastmod>2019-06-13T11:19:42+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/reviews/10/</loc>
                <lastmod>2019-06-13T11:19:42+01:00</lastmod>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/specoffers/credit/</loc>
                <lastmod>2019-06-13T11:19:43+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/specoffers/credit-cards/</loc>
                <lastmod>2019-06-13T11:19:43+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/specoffers/debet-cards/</loc>
                <lastmod>2019-06-13T11:19:43+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/specoffers/credit-auto/</loc>
                <lastmod>2019-06-13T11:19:44+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/specoffers/ipoteka/</loc>
                <lastmod>2019-06-13T11:19:44+01:00</lastmod>
                <priority>0.8</priority>
            </url>
            <url>
                <loc>https://<?= $subdomain ?>marketvibor.ru/specoffers/deposit/</loc>
                <lastmod>2019-06-13T11:19:44+01:00</lastmod>
                <priority>0.8</priority>
            </url>
        </urlset>
    </body>
</html>
