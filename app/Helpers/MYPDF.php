<?php

namespace App\Helpers;

use setasign\Fpdi\Tcpdf\Fpdi;

class MYPDF extends Fpdi
{
    public static function generate($data)
    {

        $line_starts = 10;
        $page_width = 190;

        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pageCount = $pdf->setSourceFile(public_path('template.pdf'));
        $lg = array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        $pdf->SetFont('aealarabiya', '', 12, false);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($templateId, ['adjustPageSize' => true]);
            if ($pageNo == 1) {
                $pdf->setFontSize(36, 'B', '');
                $pdf->setY(105);
                $pdf->Cell(0, 0, 'عرض سعر', 0, 1, 'C', 0, '', 1);
                $pdf->setFontSize(24);
                $pdf->Cell(0, 0, 'اتعاب تقييم ' . $data['general_type'], 0, 1, 'C', 0, '', 1);
                $pdf->Cell(0, 0, 'مدينة ' . $data['city'], 0, 1, 'C', 0, '', 1);
                $pdf->Cell(0, 0, 'حي ' . $data['area'], 0, 1, 'C', 0, '', 1);
                $pdf->setY(200);
                $pdf->setFontSize(20);
                $pdf->Cell(0, 0, $data['serial'], 0, 1, 'C', 0, '', 1);
                $pdf->Cell(0, 0, \Carbon\Carbon::now()->toDateString(), 0, 1, 'C', 0, '', 1);
            } elseif ($pageNo == 2) {
                $pdf->setFontSize(12);
                $pdf->MultiCell(0.7*$page_width, 0, 'الموضوع: عرض سعر باتعاب التقييم', 0, 'R', 0, 0, 18, 35);
                $pdf->setFontSize(10);
                $pdf->MultiCell(50, 0, \Carbon\Carbon::now()->toDateString(), 0, 'L', 0, 1);
                $pdf->Ln(4);
                $pdf->setX($line_starts);
                $pdf->setFontSize(16);
                $pdf->MultiCell(0.7 * $page_width, 5, $data['title'] . '/' . $data['client_name'], 0, 'R', 0, 0);
                $pdf->setFontSize(10);
                $pdf->MultiCell(0, 5, 'المحترمون', 0, 'L', 0, 1);
                $pdf->setFontSize(10);
                $pdf->Cell(0, 10, 'السلام عليكم ورحمة الله وبركاته', 0, 2, 'R', 0, '', 1);
                $pdf->setFontSize(12);
                $txt = 'بناء علي طلبكم بخصوص تقديم عرض سعر اتعاب تقييم ' . $data['general_type'] . ' بمدينة ' . $data['city'] . ' وذلك لغرض ( ' . $data['purpose'] . ' ) نفيدكم باستعدادنا للقيام بأعمال التقييم وفقا للمعايير الدولية التقييم الدولية (IVS) لسنة (2022)، كما نود إبلاغكم بقيمة أتعاب الأعمال مفصلة كالتالي: ';
                $pdf->setX($line_starts);
                $pdf->MultiCell(0, 5, $txt . "\n", 0, 'R', 0, 2, $line_starts, '', true, 0, true);
                $header = array('التفاصيل', 'رقم الصك', 'اتعاب التقييم', 'الضريبة (15%)', 'المجموع');
                foreach ($data['groups'] as $index => $group) {
                    $data['groups'][$index]['tax'] = $group['price'] * 0.15;
                    $data['groups'][$index]['total'] = ($group['price'] * 0.15) +$group['price'];
                }
                $pdf->ColoredTable($header, $data['groups'], $line_starts);
                $pdf->Ln(20);
                $pdf->setFillColor(242, 242, 242);
                $pdf->setX($line_starts);
                $pdf->Cell($page_width / 2, 8, 'اجمالي القيمة + الضريبة كتابةً ', 'TLRB', 0, 'R', 1);
                $pdf->Cell($page_width / 2, 8, $data['price_in_words'], 'TLRB', 1, 'R', 1);
                $pdf->setFillColor(255, 255, 255);
                $html_txt = "<ul> <li>مدة الانجاز {$data['duration']} يوم عمل بعد استلام جميع المستندات الازمةلانجاز المهمة</li> <li>وعليه نرجو منكم تحويل قيمة اتعاب التقييم علي الحساب البنكي التالي: </li> </ul>";
                $pdf->setX($line_starts);
                $pdf->MultiCell($page_width, 20, $html_txt, 'TLRB', 'R', 1, ln: 1, ishtml: true, valign: 'M');
                $pdf->setX($line_starts);
                $pdf->SetFillColor(14, 128, 158);
                $pdf->setTextColor(255, 255, 255);
                $pdf->Cell(0.4 * $page_width, 8, 'اسم الحساب', 1, 0, 'C', 1);
                $pdf->Cell(0.2 * $page_width, 8, 'اسم البنك', 1, 0, 'C', 1);
                $pdf->Cell(0.4 * $page_width, 8, 'رقم الايبان', 1, 1, 'C', 1);
                $pdf->setX($line_starts);
                $pdf->setFillColor(255, 255, 255);
                $pdf->setTextColor(0, 0, 0);
                $path = public_path('bank.jpg');
                $pdf->MultiCell(0.4 * $page_width, 17, 'شركة صالح علي الغفيص للتقييم العقاري مهنية شركة شخص واحد', 1, 'C', 0, 0, valign: 'M');
                $pdf->writeHTMLCell(0.2 * $page_width, 17, null, null, '<img src="' . $path . '" />', 1, 0, false, false, 'C', true);
                $pdf->MultiCell(0.4 * $page_width, 17, 'SA2360100002694445569001', 1, 'C', 0, 0, valign: 'M');


            }
        }

        $pdf->Output(public_path($data['client_name'] . now()->toDateString() . '.pdf'), 'F');

        return response()->download(public_path($data['client_name'] . now()->toDateString() . '.pdf'))->deleteFileAfterSend(true);
    }
    public function ColoredTable($header, $data, $line_starts = 25): void
    {
        $this->Ln(5);
        // Colors, line width and bold font
        $this->SetFillColor(14, 128, 158);
        $this->SetTextColor(255);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        $this->setX($line_starts);
        // Header
        $w = array(55, 35, 35, 35, 30);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'R', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(242, 242, 242);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach ($data as $row) {
            $this->setX($line_starts);
            $this->Cell($w[0], 8, 'اجمالي اتعاب تقييم ' . $row['type'], 'LRB', 0, 'R', $fill);
            $this->Cell($w[1], 8, $row['number'], 'LRB', 0, 'R', $fill);
            $this->Cell($w[2], 8, $row['price'], 'LRB', 0, 'R', $fill);
            $this->Cell($w[3], 8, $row['tax'], 'LRB', 0, 'R', $fill);
            $this->Cell($w[4], 8, $row['total'], 'LRB', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $collection_data = collect($data);
        $this->setX($line_starts);
        $this->Cell(array_sum($w)-$w[4], 8, 'اجمالي الاتعاب بالضريبة رقماً ', 'TLRB', 0, 'R', $fill);
        $this->Cell($w[4], 8, $collection_data->sum('total') . 'ريال ', 'TLRB', 0, 'R', $fill);

    }

    public function writeJustify($text, $linechar)
    {
        $textexploded   =   explode(" ",$text);                   // create array of words
        $lettercount    =   mb_strlen($text,'UTF-8');                       // Get total number of characters of the whole text
        $linesnum       =   $lettercount / $linechar;                    // divide number of characters over sensitivity number "how many letters per line"
        $whole          =   floor($linesnum);                       // before decimal
        $fraction       =   $linesnum - $whole;                      // decimal
        $last           =   $fraction * $linechar;                   // estimate number of characters of last line
        $last           =   $last - 3;                                  // refining

        if (    $lettercount >= $linechar   ) {                     // Proceed of text characters are more than one line limit
            $total = 0;
            for ($x = count($textexploded); $total < $last; $x--) {   // Start at the end of the words array
                $total += mb_strlen($textexploded[$x-1],'UTF-8');    // Estimate at what array word last line starts
            }

            $slice_position = array_search($x, array_keys($textexploded));  // determine the slice position of the original text
            $a1 = array_slice($textexploded, 0, $slice_position, true);     // Slice the first lines
            $a2 = array_slice($textexploded, $slice_position, count($textexploded), true);  //slice the last line
            $a1 = implode(" ",$a1);                                         // recombine words
            $a2 = implode(" ",$a2);                                         // recombine words

            $this->MultiCell(190, 0, '       '.$a1, 0, 'J', 0, 1, '', '', false, 2, false, true, 0, 'M');
            $this->Cell(0, 6, $a2, 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        } else {
            $this->Cell(0, 6, $text, 0, 0, 'R', 0, '', 0, false, 'T', 'M');
        }
    }

    public function AddFont($family, $style = '', $fontfile = '', $subset = 'default')
    {
        return parent::AddFont($family, $style, $fontfile, $subset); // TODO: Change the autogenerated stub
    }
}
