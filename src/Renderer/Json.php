<?php

namespace MeadSteve\DiceApi\Renderer;

use MeadSteve\DiceApi\Dice;

class Json implements DiceRenderer
{

    public function renderDice(array $diceCollection)
    {
        $data = [
            "version" => "1.0",           
            "response" => [
                "outputSpeech" => [
                    "type"=> "PlainText",
                    "text"=> "Plain text string to speak",
                    "ssml"=> "<speak>SSML text string to speak</speak>",
                    "playBehavior"=> "REPLACE_ENQUEUED"      
                ],
                [
                    "card"=> [
                    "type"=> "Simple",
                    "title"=> "Horoscope",
                    "content"=> "Today will provide you a new learning opportunity.  Stick with it and the possibilities will be endless."
                  ]]
            ]
        ];
        return json_encode($data);
    }

    /**
     * @return string
     */
    public function contentType() : string
    {
        return "application/json";
    }

    public function urlPrefix(): string
    {
        return "json";
    }

    private function diceAsAssocArrays(array $diceCollection)
    {
        return array_map(function (Dice $dice) {
            return [
                "value" => $dice->roll(),
                "type"  => $dice->name()
            ];
        }, $diceCollection);
    }
}
