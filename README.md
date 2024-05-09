# excel-annotation-export [excel注解导出]

> PHP版本要求 >= 8.0
>
> 仅支持PHP8注解方式

## 安装
```shell
composer require fly321/excel-annotation-export
````

## 使用方式

```php
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
```

```php
writeOrExportExcel(
            \Tests\FlyColumn::class,
            'fly_table',
            [
                ['country' => 'China', 'title' => 'Beijing', 'area' => 'Asia'],
                ['area' => 'Asia', 'country' => 'Japan', 'title' => 'Tokyo'],
                ['area' => 'Europe', 'country' => 'France', 'title' => 'Paris'],
            ],
            true, "fly_table.xlsx");
```