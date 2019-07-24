<?php
require_once('src/functions.php');

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
