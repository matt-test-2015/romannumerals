<?php

use Symfony\Component\HttpFoundation\JsonResponse;

require_once __DIR__ . '/../vendor/autoload.php';

$app       = new Silex\Application();
$generator = new Matt\RomanNumerals\Generator();

$app->get(
    '/integers/{id}',
    function ($id) use ($generator) {
        try {
            $id           = (int)$id;
            $romanNumeral = $generator->generate($id);

            return new JsonResponse(
                [
                    'data'  => [
                        'type'       => 'integers',
                        'id'         => $id,
                        'attributes' => [
                            'roman_numeral' => $romanNumeral
                        ]
                    ],
                    'links' => [
                        'self' => '/integers/' . $id
                    ]
                ],
                JsonResponse::HTTP_OK
            );
        } catch (OutOfRangeException $e) {
            return new JsonResponse(
                [
                    'errors' => [
                        ['detail' => $e->getMessage()]
                    ]
                ],
                JsonResponse::HTTP_NOT_FOUND
            );
        }
    }
);

$app->get(
    '/romannumerals/{id}',
    function ($id) use ($generator) {
        $integer = $generator->parse($id);

        return new JsonResponse(
            [
                'data'  => [
                    'type'       => 'romannumerals',
                    'id'         => $id,
                    'attributes' => [
                        'integer' => $integer
                    ]
                ],
                'links' => [
                    'self' => '/romannumerals/' . $id
                ]
            ],
            JsonResponse::HTTP_OK
        );
    }
);

$app->run();