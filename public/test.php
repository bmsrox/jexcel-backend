<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$post = json_decode (file_get_contents('php://input'), true);

try {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $header = array_reduce ($post['columns'], function($acc, $item){
        array_push ($acc, $item['title']);
        return $acc;
    }, []);

    array_unshift ($post['data'], $header);

    $sheet->fromArray ($post['data']);

    //applying styles
//    foreach ($post['style'] as $cell => $item) {
//        $sheet->getStyle($cell)->applyFromArray([
//            'font' => [
//                'bold' => true,
//            ],
//            'alignment' => [
//                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
//            ],
//        ]);
//    }

    $writer = new Xlsx($spreadsheet);
    $writer->save('test.xlsx');

    echo json_encode ([
        'success' => true,
        'data' => $post['data']
    ]);
} catch (\Exception $error) {
    echo json_encode ([
        'error' => $error->getMessage ()
    ]);
}

exit;