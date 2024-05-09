<?php

namespace Fly\ExcelAnnotationExport\Annotation;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
class ExcelColumnAnnotation
{
    /**
     * @var string|null $columnName 字段名
     */
    public $columnName;
    /**
     * @var int|null $columnWidth 列宽
     */
    public $columnWidth;
    /**
     * @var string|null $columnFieldMapping 字段映射
     */
    public $columnFieldMapping;

    /**
     * @var string|null $horizontal 水平对齐方式
     */
    public $horizontal = 'center';

    /**
     * ExcelColumnAnnotation constructor.
     * @param array $array ['columnName' => '字段名', 'columnWidth' => '列宽', 'columnFieldMapping' => '字段映射', 'horizontal' => 'center']
     */
    public function __construct(array $array = [])
    {
        $this->columnName = $array["columnName"] ?? null;
        $this->columnWidth = $array['columnWidth'] ?? null;
        $this->horizontal = $array['horizontal'] ?? 'center';
        if (empty($array['columnFieldMapping'] ?? null)) {
            $this->columnFieldMapping = camelToSnake($this->columnName);
        } else {
            $this->columnFieldMapping = $array['columnFieldMapping'];
        }
    }

}