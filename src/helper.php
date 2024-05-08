<?php

// 英文转_
use Fly\ExcelAnnotationExport\Service\ExcelAnalysisService;

if (function_exists('camelToSnake') === false) {
    function camelToSnake($str): string
    {
        return strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $str));
    }
}

// 写入excel
if (function_exists('writeOrExport') === false) {
    /**
     *
     * @param string $className 类名
     * @param string $shellName shell名称
     * @param array $listData 数据
     * @param bool $isFile 是否写入文件
     * @param string $filename 文件名
     * @return void
     */
    function writeOrExportExcel(
        string $className,
        string $shellName,
        array $listData = [],
        bool $isFile = true,
        string $filename = 'excel.xlsx'
    ): void
    {
        $excelAnalysisService = new ExcelAnalysisService();
        try {
            $excelAnalysisService->analysisColumn($className)
                ->setShellName($shellName)
                ->initExcel()
                ->writeData($listData, $isFile, $filename);
        } catch (ReflectionException $e) {
            throw new RuntimeException($e->getMessage());
        }
        unset($excelAnalysisService);
    }
}
