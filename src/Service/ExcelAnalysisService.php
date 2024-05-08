<?php

namespace Fly\ExcelAnnotationExport\Service;

use Fly\ExcelAnnotationExport\Annotation\ExcelColumnAnnotation;
use Fly\ExcelAnnotationExport\Annotation\ExcelShellAnnotation;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use ReflectionAttribute;
use ReflectionClass;

/**
 * @property Worksheet $sheet
 */
class ExcelAnalysisService
{
    /**
     * @var string $shellName
     */
    protected string $shellName;

    /**
     * @var ExcelColumnAnnotation[] $columnData
     */
    protected array $columnData = [];

    protected Spreadsheet $spreadsheet;

    /**
     * @var int $defaultWidth 默认列宽
     */
    protected int $defaultWidth = 40;
    /**
     * @var int $defaultHeight 默认行高
     */
    protected int $defaultHeight = 20;

    /**
     * @param string $class
     * @return self
     * @throws \ReflectionException
     */
    public function analysisColumn(string $class): self
    {
        $classReflection = new ReflectionClass($class);
        // 反射获取类的所有属性
        $properties = $classReflection->getProperties();
        foreach ($properties as $property) {
            // 获取属性的注解
            $attributes = $property->getAttributes(ExcelColumnAnnotation::class, ReflectionAttribute::IS_INSTANCEOF);
            foreach ($attributes as $attribute) {
                $this->columnData[$attribute->getArguments()["columnName"]] = new ExcelColumnAnnotation(...$attribute->getArguments());
            }
        }
        return $this;
    }

    /**
     * 初始化Excel
     * @return self
     */
    public function initExcel(): self
    {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
        $this->sheet->setTitle($this->shellName);
        $this->sheet->getDefaultColumnDimension()->setWidth($this->getDefaultWidth());
        $this->sheet->getDefaultRowDimension()->setRowHeight($this->getDefaultHeight());
        $columnIndex = 'A';
        $endColumnIndex = ord($columnIndex) + count($this->columnData) - 1;
        $this->sheet->getStyle('A1:'. chr($endColumnIndex) .'1')->getFont()->setBold(true);
        // 首行写入
        foreach ($this->columnData as $column => $columnAnnotation) {
            $this->sheet->setCellValue($columnIndex . '1', $columnAnnotation->columnFieldMapping);
            $this->sheet->getColumnDimension($columnIndex)->setWidth($columnAnnotation->columnWidth);
            $columnIndex++;
        }
        return $this;
    }

    /**
     * 写入数据
     * @param array $listData
     * @param bool $isFile
     * @param string $fileName
     * @return void
     */
    public function writeData(array $listData, bool $isFile = false, string $fileName = ''): void
    {
        $index = 2;
        foreach ($listData as $data) {
            $columnIndex = 'A';
            foreach ($this->columnData as $column => $columnAnnotation) {
                $this->sheet->setCellValue($columnIndex . $index, $data[$column]);
                $columnIndex++;
            }
            $index++;
        }
        if ($isFile) {
            $this->spreadsheet->getActiveSheet()->setTitle($this->shellName);
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->spreadsheet, 'Xlsx');
            $writer->save($fileName);
        } else {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }

    public function getDefaultHeight(): int
    {
        return $this->defaultHeight;
    }

    public function setDefaultHeight(int $defaultHeight): void
    {
        $this->defaultHeight = $defaultHeight;
    }

    public function getDefaultWidth(): int
    {
        return $this->defaultWidth;
    }

    public function setDefaultWidth(int $defaultWidth): self
    {
        $this->defaultWidth = $defaultWidth;
        return $this;
    }

    public function getColumnData(): array
    {
        return $this->columnData;
    }

    public function setColumnData(array $columnData): self
    {
        $this->columnData = $columnData;
        return $this;
    }

    public function getShellName(): string
    {
        return $this->shellName;
    }

    public function setShellName(string $shellName): self
    {
        $this->shellName = $shellName;
        return $this;
    }
}