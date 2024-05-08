<?php

namespace Tests;

use Fly\ExcelAnnotationExport\Service\ExcelAnalysisService;
use ReflectionException;

class ExcelTest extends \PHPUnit\Framework\TestCase
{
    public function testExcel(): void
    {
        writeOrExportExcel(
            \Tests\FlyColumn::class,
            'fly_table',
            [
                ['country' => 'China', 'title' => 'Beijing', 'area' => 'Asia'],
                ['area' => 'Asia', 'country' => 'Japan', 'title' => 'Tokyo'],
                ['area' => 'Europe', 'country' => 'France', 'title' => 'Paris'],
            ],
            true, "fly_table.xlsx");
    }
}