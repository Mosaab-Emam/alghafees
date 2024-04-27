<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use \App\Helpers\ArabicDate;
use \App\Models\Category;

class ContractController extends Controller
{
    public function index()
    {
        $recipient = auth()->user();
        \Filament\Notifications\Notification::make()
            ->title('Saved successfully')
            ->sendToDatabase($recipient);

        return view('admin.contracts.index');
    }

    public function create()
    {
        return view('admin.contracts.create');
    }

    public function signaturePad(string $token)
    {
        $contract = Contract::where('token', $token)->first();
        if ($contract == null)
            abort(404);

        return view('admin.contracts.sign', compact('contract'));
    }

    public function sign(string $token)
    {
        $contract = Contract::where('token', $token)->first();
        $contract->signature = request()->signature;
        $contract->save();
        return redirect('download-contract/' . $contract->token);
    }

    public function downloadContract(string $token)
    {
        $contract = Contract::where('token', $token)->first();

        if ($contract == null)
            abort(404);

        $pdf = new \App\Helpers\MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pageCount = $pdf->setSourceFile(storage_path('pdf-templates/contract-template.pdf'));
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
                $pdf->setY(25);
                $pdf->setFontSize(14);
                $pdf->Cell(0, 0, 'عقد رقم: ' . $contract->token, 0, 1, 'C', 0, '', 1);

                $pdf->setY(45);
                $pdf->setX(20);
                $pdf->setFontSize(13);
                $date_line = 'حرر هذا العقد بالرياض في '
                    . ArabicDate::dayName($contract->contract_date)
                    . ': '
                    . $contract->contract_date
                    . 'م'
                    . ' الموافق: '
                    . \GeniusTS\HijriDate\Hijri::convertToHijri($contract->contract_date)->format('Y-m-d')
                    . 'هـ'
                    . ' بين كل من:';
                $pdf->Cell(0, 0, $date_line, 0, 1, 'R', 0, '', 1);

                $pdf->setFontSize(12);
                $pdf->setY(154);
                $pdf->setX(67);
                $pdf->Cell(0, 0, $contract->client_name, 0, 1, 'R', 0, '', 1);

                $pdf->setY(162);
                $pdf->setX(67);
                $pdf->Cell(0, 0, $contract->id_number, 0, 1, 'R', 0, '', 1);

                $pdf->setY(170);
                $pdf->setX(67);
                $pdf->Cell(0, 0, $contract->client_address, 0, 1, 'R', 0, '', 1);

                $pdf->setY(178);
                $pdf->setX(67);
                $pdf->Cell(0, 0, $contract->phone_numbers, 0, 1, 'R', 0, '', 1);

                $pdf->setY(186);
                $pdf->setX(67);
                $pdf->Cell(0, 0, $contract->email, 0, 1, 'R', 0, '', 1);

                $pdf->setY(194);
                $pdf->setX(67);
                $pdf->Cell(0, 0, $contract->representative_name, 0, 1, 'R', 0, '', 1);

                $purpose_line_1 = "لما كان الطرف الأول حاصلاً على ترخيص مزاولة مهنة التقييم وفقاً لأحكام نظام المقيمين المعتمدين الصادر";
                $pdf->setY(220);
                $pdf->setX(18);
                $pdf->setFontSize(14);
                $pdf->Cell(0, 0, $purpose_line_1, 0, 1, 'R', 0, '', 1);

                $purpose_line_2 = "بالمرسوم الملكي رقم (م/ 43) وتاريخ: 09/07/1433هـ وتعديلاته، ولحاجة الطرف الثاني، لتقييم أصوله من قبل";
                $pdf->setY(225);
                $pdf->setX(18);
                $pdf->setFontSize(14);
                $pdf->Cell(0, 0, $purpose_line_2, 0, 1, 'R', 0, '', 1);

                $purpose_line_3 = "مقيم معتمد لغرض (" . $contract->purpose . ") عليه فقد التقت إرادتا الطرفين وكل منهما بالحالة المعتبرة شرعاً";
                $pdf->setY(230);
                $pdf->setX(18);
                $pdf->setFontSize(14);
                $pdf->Cell(0, 0, $purpose_line_3, 0, 1, 'R', 0, '', 1);

                $purpose_line_4 = "والأهلية الصالحة للإبرام والتصرف والصفة المعتد بها نظاماً على إبرام هذا العقد وذلك بالشروط الآتية:";
                $pdf->setY(235);
                $pdf->setX(18);
                $pdf->setFontSize(14);
                $pdf->Cell(0, 0, $purpose_line_4, 0, 1, 'R', 0, '', 1);
            }
            if ($pageNo == 2) {
                $pdf->setY(186);
                $pdf->setX(20);
                $pdf->setFontSize(14);
                $pdf->Cell(
                    0,
                    0,
                    'بناءً على طلب الطرف الثاني فان الغرض من معرفة القيمة السوقية للعقار محل التقييم هو (' . $contract->purpose . ').',
                    0,
                    1,
                    'R',
                    0,
                    '',
                    1
                );

                $pdf->setY(212);
                $pdf->setX(67);
                $pdf->setFontSize(12);
                $category = Category::where('slug', $contract->type)->orWhere('id', $contract->type)->first();
                $pdf->Cell(
                    0,
                    0,
                    'العقار عبارة عن ' . $category->title . ' بمساحة: (' . $contract->area . 'متر مربع)',
                    0,
                    1,
                    'R',
                    0,
                    '',
                    1
                );

                $pdf->setY(220);
                $pdf->setX(67);
                $pdf->Cell(
                    0,
                    0,
                    'يقع العقار بـ: ' . $contract->property_address,
                    0,
                    1,
                    'R',
                    0,
                    '',
                    1
                );

                $pdf->setY(228);
                $pdf->setX(67);
                $pdf->Cell(
                    0,
                    0,
                    'رقم (' . $contract->deed_number . ') بتاريخ: ' . $contract->deed_issue_date,
                    0,
                    1,
                    'R',
                    0,
                    '',
                    1
                );
            }
            if ($pageNo == 3) {
                $pdf->setY(35);
                $pdf->setX(100);
                $pdf->Cell(0, 0, $contract->number_of_assets, 0, 1, 'R', 0, '', 1);

                $pdf->setY(35);
                $pdf->setX(125);
                $pdf->Cell(0, 0, $contract->cost_per_asset, 0, 1, 'R', 0, '', 1);

                $pdf->setY(35);
                $pdf->setX(165);
                $pdf->Cell(0, 0, round($contract->number_of_assets * $contract->cost_per_asset), 0, 1, 'R', 0, '', 1);

                $pdf->setY(43);
                $pdf->setX(165);
                $pdf->Cell(0, 0, $contract->tax, 0, 1, 'R', 0, '', 1);

                $pdf->setY(51);
                $pdf->setX(165);
                $pdf->Cell(0, 0, $contract->total_cost, 0, 1, 'R', 0, '', 1);

                $pdf->setY(59);
                $pdf->setX(125);
                $pdf->Cell(0, 0, $contract->total_cost_in_words, 0, 1, 'R', 0, '', 1);
            }
            if ($pageNo == 4) {
                $pdf->setY(241);
                $pdf->setX(124);
                $pdf->Cell(0, 0, $contract->client_name, 0, 1, 'R', 0, '', 1);

                $pdf->setY(250);
                $pdf->setX(124);
                $pdf->Cell(0, 0, explode(" ", $contract->contract_date)[0], 0, 1, 'R', 0, '', 1);

                $pdf->setY(250);
                $pdf->setX(45);
                $pdf->Cell(0, 0, explode(" ", $contract->contract_date)[0], 0, 1, 'R', 0, '', 1);

                if ($contract->signature != null) {
                    $dataPieces = explode(',', $contract->signature);
                    $encodedImg = $dataPieces[1];
                    $decodedImg = base64_decode($encodedImg);
                    //  Check if image was properly decoded
                    if ($decodedImg !== false) {
                        $name = 'signature-' . now()->toDateString() . '.png';
                        if (file_put_contents($name, $decodedImg) !== false) {
                            $pdf->Image($name, 80, 256, 16, 16, 'png');
                            unlink($name);
                        }
                    }
                }
            }
        }

        $pdf->Output(public_path('contract-' . $contract->token . '.pdf'), 'F');
        return response()->download(public_path('contract-' . $contract->token . '.pdf'))->deleteFileAfterSend(true);
    }
}
