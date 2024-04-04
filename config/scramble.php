<?php

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    /*
     * Your API path. By default, all routes starting with this path will be added to the docs.
     * If you need to change this behavior, you can add your custom routes resolver using `Scramble::routes()`.
     */
    'api_path' => 'v1',

    /*
     * Your API domain. By default, app domain is used. This is also a part of the default API routes
     * matcher, so when implementing your own, make sure you use this config if needed.
     */
    'api_domain' => null,

    /**
     * The path where your OpenAPI specification will be exported.
     */
    'export_path' => 'api.json',

    /*
     * Define the theme of the documentation.
     * Available options are `light` and `dark`.
     */
    'theme' => 'light',

    'info' => [
        /*
         * API version.
         */
        'version' => env('API_VERSION', '0.0.1'),

        /*
         * Description rendered on the home page of the API documentation (`/docs/api`).
         */
        'description' => "### 📧 API de Verificação de E-mail\n\n A API de Verificação de E-mail é projetada para validar endereços de e-mail em tempo real, oferecendo
        uma solução rápida para identificar e corrigir erros comuns em endereços de e-mail fornecidos pelos usuários.\n\n Esta API verifica a sintaxe do e-mail,
        a existência do domínio e sugere correções para domínios digitados incorretamente, garantindo que os e-mails sejam válidos antes de serem
        usados em campanhas de marketing, cadastros de usuários, ou qualquer outro caso de uso onde endereços de e-mail precisam ser confirmados.
        \n\n 🌐 Funcionalidades\n\n `Validação de Sintaxe` \n\n Verifica se o formato do endereço de e-mail está correto conforme as regras padrão para endereços de e-mail.
        \n\n `Sugestão de Domínio` \n\n Para e-mails com domínios potencialmente errados, a API sugere o domínio mais provável, ajudando a corrigir erros de digitação (por exemplo, 'gamil.com' seria sugerido como 'gmail.com').
        \n\n 🧰 Fácil Integração \n\n Integração ágil e facilitada para diversas linguagens

        ",
    ],

    /*
     * Customize Stoplight Elements UI
     */
    'ui' => [
        /*
         * Hide the `Try It` feature. Enabled by default.
         */
        'hide_try_it' => false,

        /*
         * URL to an image that displays as a small square logo next to the title, above the table of contents.
         */
        'logo' => env('APP_URL').'/images/only-logo.png',

        /*
         * Use to fetch the credential policy for the Try It feature. Options are: omit, include (default), and same-origin
         */
        'try_it_credentials_policy' => 'omit',
    ],

    /*
     * The list of servers of the API. By default, when `null`, server URL will be created from
     * `scramble.api_path` and `scramble.api_domain` config variables. When providing an array, you
     * will need to specify the local server URL manually (if needed).
     *
     * Example of non-default config (final URLs are generated using Laravel `url` helper):
     *
     * ```php
     * 'servers' => [
     *     'Live' => 'api',
     *     'Prod' => 'https://scramble.dedoc.co/api',
     * ],
     * ```
     */
    'servers' => null,

    'middleware' => [
        'web',
        RestrictedDocsAccess::class,
    ],

    'extensions' => [],
];
