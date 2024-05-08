<?php

namespace Fly\ExcelAnnotationExport\Annotation;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ExcelShellAnnotation
{
    /**
     * @var string $shellName shell名称
     */
    public string $shellName;

    /**
     * @param string $shellName shell名称
     */
    public function __construct(string $shellName){
        $this->shellName = $shellName;
    }
}