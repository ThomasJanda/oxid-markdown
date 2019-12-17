<?php

$sMetadataVersion = '2.0';

$aModule = array(
    'id'           => 'rs-markdown',
    'title'        => '*RS Markdown',
    'description'  => 'Renders README.md files in the backend',
    'thumbnail'    => '',
    'version'      => '1.0',
    'author'       => '',
    'url'          => '',
    'email'        => '',
    'controllers' => array(
        'rs_markdown'      => rs\markdown\Application\Controller\Admin\rs_markdown::class,
    ),
    'templates' => array(
        'rs_markdown.tpl' => 'rs/markdown/views/admin/tpl/rs_markdown.tpl'
    )
);
