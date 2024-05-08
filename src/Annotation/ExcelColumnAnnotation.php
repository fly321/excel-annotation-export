<?php

namespace Fly\ExcelAnnotationExport\Annotation;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class ExcelColumnAnnotation
{
    /**
     * @var string $columnName 字段名
     */
    public string $columnName;
    /**
     * @var int $columnWidth 列宽
     */
    public int $columnWidth;
    /**
     * @var string $columnFieldMapping 字段映射
     */
    public string $columnFieldMapping;

    /**
     * @var bool 是否居中
     */
    public bool $isCenter = true;

    /**
     * ExcelColumnAnnotation constructor.
     * @param string $columnName
     * @param string|null $columnFieldMapping
     * @param int $columnWidth
     */
    public function __construct(
        string $columnName,
        string $columnFieldMapping = null,
        int $columnWidth = 20,
        bool $isCenter = true
    ) {
        $this->columnName = $columnName;
        $this->columnWidth = $columnWidth;
        $this->isCenter = $isCenter;
        if (empty($columnFieldMapping)) {
            $this->columnFieldMapping = camelToSnake($columnName);
        } else {
            $this->columnFieldMapping = $columnFieldMapping;
        }
    }

}