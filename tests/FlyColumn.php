<?php

namespace Tests;

use Fly\ExcelAnnotationExport\Annotation\ExcelColumnAnnotation;

class FlyColumn
{
    #[ExcelColumnAnnotation(columnWidth: 20, columnName: 'area', columnFieldMapping: '地区')]
    public string $area;
    #[ExcelColumnAnnotation(columnName: 'country', columnFieldMapping: '国家', columnWidth: 30)]
    public string $country;
    #[ExcelColumnAnnotation(columnName: 'title', columnFieldMapping: '标题', columnWidth: 40)]
    public string $title;
}