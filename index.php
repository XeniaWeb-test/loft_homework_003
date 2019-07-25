<?php
require_once('src/functions.php');

echo '<pre>';

task1('data.xml');

$activity = [
    'science' => [
        'maths' => [
            'algebra',
            'geometry',
            'trigonometry'
        ],
        'chemistry' => [
            'organic',
            'inorganic'
        ],
        'physics' => 'physics',
        'biology' => 'biology'
    ],
    'art' => [
        'painting',
        'music',
        'theater',
        'sculpture'
    ],
    'politics' => [
        'external',
        'social'
    ]
];

task2_1($activity);

task3(80);

$link = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';
task4_1($link);
task4_2($link);

echo '</pre>';
