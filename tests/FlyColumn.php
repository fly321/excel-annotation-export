<?php

namespace Tests;

use Fly\ExcelAnnotationExport\Annotation\ExcelColumnAnnotation;

class FlyColumn
{
    /**
     * @ExcelColumnAnnotation(columnName="area", columnFieldMapping="地区", columnWidth=30)
     */
    public $area;
    /**
     * @ExcelColumnAnnotation(columnName="country", columnFieldMapping="国家", columnWidth=40)
     */
    public $country;
    /**
     * @ExcelColumnAnnotation(columnName="title", columnFieldMapping="标题", columnWidth=20)
     */
    public $title;
}