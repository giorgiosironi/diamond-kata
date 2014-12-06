<?php

class DiamondTest extends \PHPUnit_Framework_TestCase
{
    public function testASingleLetter()
    {
        $this->assertEquals("A\n", (new Diamond("A"))->__toString());
    }

    public function testTwoLetters()
    {
        $this->assertEquals(
              " A \n" 
            . "B B\n"
            . " A \n"
            , (new Diamond("B"))->__toString());
    }

    public function testThreeLetters()
    {
        $this->assertEquals(
              "  A  \n" 
            . " B B \n"
            . "C   C\n"
            . " B B \n"
            . "  A  \n" 
            , (new Diamond("C"))->__toString());
    }
}

class Diamond
{
    private $finalLetter;
    private $order;
    private $letters = [
        'A',
        'B',
        'C',
    ];
    
    public function __construct($finalLetter)
    {
        $this->finalLetter = $finalLetter;
        $this->order = array_search($finalLetter, $this->letters);
    }

    public function __toString()
    {
        $spaces = str_repeat(' ', $this->order);
        $lines = [];
        $lines[] = $spaces . $this->letters[0] . $spaces . "\n";
        if ($this->order == 1) {
            $lines[] = "{$this->letters[1]} {$this->letters[1]}\n";
        }
        if ($this->order == 2) {
            $lines[] = " {$this->letters[1]} {$this->letters[1]} \n";
            $lines[] = "{$this->letters[2]}   {$this->letters[2]}\n";
        }
        $size = $this->order * 2 + 1;
        for ($i = $this->order + 1; $i < $size; $i++) {
            $lines[$i] = $lines[$size - $i - 1];
        }
        return implode('', $lines);
    }
}
