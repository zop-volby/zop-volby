<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Http\Controllers\VoterController;

class SecondFactorTest extends TestCase
{
    public function test_normalize_regular_number(): void
    {
        $normalized = VoterController::normalize_second_factor('1234');
        $this->assertSame('00001234', $normalized);        
    }

    public function test_normalize_long_number(): void
    {
        $normalized = VoterController::normalize_second_factor('1233456789');
        $this->assertSame('1233456789', $normalized);        
    }

    public function test_fail_normalization_of_non_numeric_input(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        VoterController::normalize_second_factor('abcd');
    }
}
