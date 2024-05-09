<?php

namespace Fly\ExcelAnnotationExport\Annotation;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class ExcelColumnAnnotation
{
    /**
     * @var string|null $columnName 字段名
     */
    public ?string $columnName;
    /**
     * @var int|null $columnWidth 列宽
     */
    public ?int $columnWidth;
    /**
     * @var string|null $columnFieldMapping 字段映射
     */
    public ?string $columnFieldMapping;

    /**
     * @var string|null $horizontal 水平对齐方式
     */
    public ?string $horizontal = 'center';

    /**
     * ExcelColumnAnnotation constructor.
     * @param string|null $columnName
     * @param string|null $columnFieldMapping
     * @param int|null $columnWidth
     * @param string|null $horizontal
     */
    public function __construct(
        ?string $columnName = null,
        ?string $columnFieldMapping = null,
        ?int $columnWidth = 20,
        ?string $horizontal = 'center'
    ) {
        $this->columnName = $columnName;
        $this->columnWidth = $columnWidth;
        $this->horizontal = $horizontal;
        if (empty($columnFieldMapping)) {
            $this->columnFieldMapping = camelToSnake($columnName);
        } else {
            $this->columnFieldMapping = $columnFieldMapping;
        }
    }

}