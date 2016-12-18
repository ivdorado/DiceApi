<?php

namespace spec\MeadSteve\DiceApi;

use MeadSteve\DiceApi\BasicDice;
use MeadSteve\DiceApi\Dice;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UrlDiceGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(\MeadSteve\DiceApi\UrlDiceGenerator::class);
    }

    function it_returns_a_single_dice_from_a_url()
    {
        $this->diceFromUrlString("/d6/")->shouldBeLike([new BasicDice(6)]);
    }

    function it_returns_many_dice_from_a_url_separated_by_slashes()
    {
        $this->diceFromUrlString("/d6/d20")->shouldBeLike([new BasicDice(6), new BasicDice(20)]);
    }

    function it_returns_many_dice_from_a_single_piece_of_a_url()
    {
        $this->diceFromUrlString("/2d4")->shouldBeLike([new BasicDice(4), new BasicDice(4)]);
    }

    function it_returns_many_dice_and_single_dice_from_longer_urls()
    {
        $this->diceFromUrlString("/2d4/d6/2d20")->shouldBeLike([new BasicDice(4), new BasicDice(4), new BasicDice(6), new BasicDice(20), new BasicDice(20)]);
    }

    function it_throws_an_exception_for_anything_over_a_d_9000()
    {
        $this->shouldThrow(Dice\UncreatableDiceException::class)->duringDiceFromUrlString("/d9001");
    }

    function it_returns_a_special_singlepoint_dice_when_asked_for_a_d0()
    {
        $this->diceFromUrlString("/d0/")->shouldBeLike([new Dice\ZeropointDice()]);
    }

    function it_returns_a_steve_dice()
    {
        $this->diceFromUrlString("/dSTeVe/")->shouldBeLike([new Dice\SteveDice()]);
    }
}