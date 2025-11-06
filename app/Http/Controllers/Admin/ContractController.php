<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use \App\Helpers\ArabicDate;
use \App\Models\Category;

class ContractController extends Controller
{
    // Primary color #0F819F - RGB values for TCPDF
    private const PRIMARY_COLOR_R = 15;
    private const PRIMARY_COLOR_G = 129;
    private const PRIMARY_COLOR_B = 159;

    public function index()
    {
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


        if ($contract->signature != null && !str_starts_with($contract->signature, 'data'))
            return response()
                ->download(public_path($contract->signature))
                ->deleteFileAfterSend(false);

        $pdf = new \App\Helpers\MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pageCount = $pdf->setSourceFile(storage_path('pdf-templates/new-contract-template.pdf'));
        $lg = array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);

        // Register Hacen Tunisia font (TCPDF_FONTS::addTTFfont converts TTF to TCPDF format)
        $hacenTunisiaFont = \TCPDF_FONTS::addTTFfont(public_path('fonts/hacen-tunisia-regular.ttf'), 'TrueTypeUnicode', '', 96);

        // $pdf->SetFont('aealarabiya', '', 12, false);
        $pdf->SetFont($hacenTunisiaFont, '', 12, false);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

            if ($pageNo == 1) {
                // Old contract template
                // $pdf->setY(25);
                // $pdf->setFontSize(14);
                // $pdf->Cell(0, 0, 'عقد رقم: ' . $contract->token, 0, 1, 'C', 0, '', 1);

                // Contract Token
                $pdf->setY(26);
                $pdf->setX(24);
                $pdf->setFont('', 'B', 9); // Set bold font with Hacen Tunisia font family (regular)
                $pdf->SetTextColor(self::PRIMARY_COLOR_R, self::PRIMARY_COLOR_G, self::PRIMARY_COLOR_B);
                $pdf->Cell(0, 0, $contract->token, 0, 1, 'C', 0, '', 1);
                $pdf->SetFont('', '', 12); // Reset font to normal for subsequent output
                $pdf->SetTextColor(0, 0, 0); // Reset text color to black for subsequent output

                // Old contract template
                // $pdf->setY(45);
                // $pdf->setX(20);
                // $pdf->setFontSize(13);
                // $date_line = 'حرر هذا العقد بالرياض في '
                //     . ArabicDate::dayName($contract->contract_date)
                //     . ': '
                //     . $contract->contract_date
                //     . 'م'
                //     . ' الموافق: '
                //     . \GeniusTS\HijriDate\Hijri::convertToHijri($contract->contract_date)->format('Y-m-d')
                //     . 'هـ'
                //     . ' بين كل من:';
                // $pdf->Cell(0, 0, $date_line, 0, 1, 'R', 0, '', 1);

                // Contract Arabic Day Name
                $pdf->setY(34.5);
                $pdf->setX(19);
                $pdf->setFontSize(10);
                $pdf->Cell(0, 0, ArabicDate::dayName($contract->contract_date), 0, 1, 'C', 0, '', 1);

                // Contract Gregorian Date
                $pdf->setY(34.5);
                $pdf->setX(66);
                $pdf->SetTextColor(self::PRIMARY_COLOR_R, self::PRIMARY_COLOR_G, self::PRIMARY_COLOR_B);
                $pdf->Cell(0, 0, \Carbon\Carbon::parse($contract->contract_date)->format('d/m/Y'), 0, 1, 'C', 0, '', 1);

                // Contract Hijri Date
                $pdf->setY(34.5);
                $pdf->setX(129);
                $pdf->Cell(0, 0, \GeniusTS\HijriDate\Hijri::convertToHijri($contract->contract_date)->format('d/m/Y') . 'هـ', 0, 1, 'C', 0, '', 1);
                $pdf->SetTextColor(0, 0, 0); // Reset text color to black for subsequent output

                // Client Name
                $pdf->setFontSize(12);
                $pdf->setY(136.25);
                $pdf->setX(65);
                $pdf->Cell(0, 0, $contract->client_name, 0, 1, 'R', 0, '', 1);

                // Client ID Number
                $pdf->setY(145.25);
                $pdf->setX(65);
                $pdf->Cell(0, 0, $contract->id_number, 0, 1, 'R', 0, '', 1);

                // Client Address
                $pdf->setY(153.25);
                $pdf->setX(65);
                $pdf->Cell(0, 0, $contract->client_address, 0, 1, 'R', 0, '', 1);

                // Client Phone Numbers
                $pdf->setY(162.5);
                $pdf->setX(65);
                $pdf->Cell(0, 0, $contract->phone_numbers, 0, 1, 'R', 0, '', 1);

                // Client Email
                $pdf->setY(171.5);
                $pdf->setX(65);
                $pdf->Cell(0, 0, $contract->email, 0, 1, 'R', 0, '', 1);

                // Client Representative Name
                $pdf->setY(179.5);
                $pdf->setX(65);
                $pdf->Cell(0, 0, $contract->representative_name, 0, 1, 'R', 0, '', 1);

                // Old contract template
                // $purpose_line_1 = "لما كان الطرف الأول حاصلاً على ترخيص مزاولة مهنة التقييم وفقاً لأحكام نظام المقيمين المعتمدين الصادر";
                // $pdf->setY(220);
                // $pdf->setX(18);
                // $pdf->setFontSize(14);
                // $pdf->Cell(0, 0, $purpose_line_1, 0, 1, 'R', 0, '', 1);

                // $purpose_line_2 = "بالمرسوم الملكي رقم (م/ 43) وتاريخ: 09/07/1433هـ وتعديلاته، ولحاجة الطرف الثاني، لتقييم أصوله من قبل";
                // $pdf->setY(225);
                // $pdf->setX(18);
                // $pdf->setFontSize(14);
                // $pdf->Cell(0, 0, $purpose_line_2, 0, 1, 'R', 0, '', 1);

                // $purpose_line_3 = "مقيم معتمد لغرض (" . $contract->purpose . ") عليه فقد التقت إرادتا الطرفين وكل منهما بالحالة المعتبرة شرعاً";
                // $pdf->setY(230);
                // $pdf->setX(18);
                // $pdf->setFontSize(14);
                // $pdf->Cell(0, 0, $purpose_line_3, 0, 1, 'R', 0, '', 1);

                // $purpose_line_4 = "والأهلية الصالحة للإبرام والتصرف والصفة المعتد بها نظاماً على إبرام هذا العقد وذلك بالشروط الآتية:";
                // $pdf->setY(235);
                // $pdf->setX(18);
                // $pdf->setFontSize(14);
                // $pdf->Cell(0, 0, $purpose_line_4, 0, 1, 'R', 0, '', 1);

                // Purpose 1
                $pdf->setY(215.5);
                $pdf->setX(88);
                $pdf->setFontSize(10);
                $pdf->SetTextColor(self::PRIMARY_COLOR_R, self::PRIMARY_COLOR_G, self::PRIMARY_COLOR_B);
                $pdf->Cell(0, 0, $contract->purpose, 0, 1, 'C', 0, '', 1);
                $pdf->SetTextColor(0, 0, 0); // Reset text color to black for subsequent output
            }
            if ($pageNo == 2) {
                // Old contract template
                // $pdf->setY(186);
                // $pdf->setX(20);
                // $pdf->setFontSize(14);
                // $pdf->Cell(
                //     0,
                //     0,
                //     'بناءً على طلب الطرف الثاني فان الغرض من معرفة القيمة السوقية للعقار محل التقييم هو (' . $contract->purpose . ').',
                //     0,
                //     1,
                //     'R',
                //     0,
                //     '',
                //     1
                // );

                // Purpose 2
                $pdf->setY(227.5);
                $pdf->setX(67);
                $pdf->setFontSize(10);
                $pdf->SetTextColor(self::PRIMARY_COLOR_R, self::PRIMARY_COLOR_G, self::PRIMARY_COLOR_B);
                $pdf->Cell(0, 0, $contract->purpose . '.', 0, 1, 'C', 0, '', 1);
                $pdf->SetTextColor(0, 0, 0); // Reset text color to black for subsequent output

                // Old contract template
                // $pdf->setY(212);
                // $pdf->setX(67);
                // $pdf->setFontSize(12);
                // $category = Category::where('slug', $contract->type)->orWhere('id', $contract->type)->first();
                // $pdf->Cell(
                //     0,
                //     0,
                //     'العقار عبارة عن ' . $category->title . ' بمساحة: (' . $contract->area . 'متر مربع)',
                //     0,
                //     1,
                //     'R',
                //     0,
                //     '',
                //     1
                // );

                // Property Type
                $pdf->setY(245);
                $pdf->setX(33.5);
                $pdf->setFontSize(10);
                // The type accessor in Contract model handles backward compatibility
                // It returns the category title for old IDs or the text value for new records
                $pdf->Cell(0, 0, $contract->type, 0, 1, 'R', 0, '', 1);


                // Old contract template
                // $pdf->setY(220);
                // $pdf->setX(67);
                // $pdf->Cell(
                //     0,
                //     0,
                //     'يقع العقار بـ: ' . $contract->property_address,
                //     0,
                //     1,
                //     'R',
                //     0,
                //     '',
                //     1
                // );

                // $pdf->setY(228);
                // $pdf->setX(67);
                // $pdf->Cell(
                //     0,
                //     0,
                //     'رقم (' . $contract->deed_number . ') بتاريخ: ' . $contract->deed_issue_date,
                //     0,
                //     1,
                //     'R',
                //     0,
                //     '',
                //     1
                // );
            }
            if ($pageNo == 3) {
                // Time in Days
                $pdf->setY(25);
                $pdf->setX(127);
                $pdf->setFontSize(12);
                $pdf->SetTextColor(self::PRIMARY_COLOR_R, self::PRIMARY_COLOR_G, self::PRIMARY_COLOR_B);
                $pdf->Cell(0, 0, $contract->time_in_days, 0, 1, 'C', 0, '', 1);

                // Total Cost
                $pdf->setY(49);
                $pdf->setX(45);
                $pdf->SetTextColor(self::PRIMARY_COLOR_R, self::PRIMARY_COLOR_G, self::PRIMARY_COLOR_B);
                $pdf->setFontSize(11);
                $pdf->Cell(0, 0, $contract->total_cost . ' ريال', 0, 1, 'R', 0, '', 1);

                // Total Cost in Words
                $pdf->setY(57.5);
                $pdf->setX(46.5);
                $pdf->Cell(0, 0, $contract->total_cost_in_words, 0, 1, 'R', 0, '', 1);
                $pdf->SetTextColor(0, 0, 0); // Reset text color to black for subsequent output

                // Old contract template
                //     $pdf->setY(35);
                //     $pdf->setX(100);
                //     $pdf->Cell(0, 0, $contract->number_of_assets, 0, 1, 'R', 0, '', 1);

                //     $pdf->setY(35);
                //     $pdf->setX(125);
                //     $pdf->Cell(0, 0, $contract->cost_per_asset, 0, 1, 'R', 0, '', 1);

                //     $pdf->setY(35);
                //     $pdf->setX(165);
                //     $pdf->Cell(0, 0, round($contract->number_of_assets * $contract->cost_per_asset), 0, 1, 'R', 0, '', 1);

                //     $pdf->setY(43);
                //     $pdf->setX(165);
                //     $pdf->Cell(0, 0, $contract->tax, 0, 1, 'R', 0, '', 1);

                //     $pdf->setY(51);
                //     $pdf->setX(165);
                //     $pdf->Cell(0, 0, $contract->total_cost, 0, 1, 'R', 0, '', 1);

                //     $pdf->setY(59);
                //     $pdf->setX(125);
                //     $pdf->Cell(0, 0, $contract->total_cost_in_words, 0, 1, 'R', 0, '', 1);
            }
            if ($pageNo == 5) {
                // Old contract template
                // $pdf->setY(241);
                // $pdf->setX(124);
                // $pdf->Cell(0, 0, $contract->client_name, 0, 1, 'R', 0, '', 1);

                // $pdf->setY(250);
                // $pdf->setX(124);
                // $pdf->Cell(0, 0, explode(" ", $contract->contract_date)[0], 0, 1, 'R', 0, '', 1);

                $pdf->SetTextColor(self::PRIMARY_COLOR_R, self::PRIMARY_COLOR_G, self::PRIMARY_COLOR_B);
                $pdf->setY(105);
                $pdf->setX(109);
                $pdf->Cell(0, 0, $contract->client_name, 0, 1, 'R', 0, '', 1);

                $pdf->setY(157);
                $pdf->setX(109);
                $pdf->Cell(0, 0, \Carbon\Carbon::parse($contract->contract_date)->format('d/m/Y'), 0, 1, 'R', 0, '', 1);

                $pdf->setY(157);
                $pdf->setX(42);
                $pdf->Cell(0, 0, \Carbon\Carbon::parse($contract->contract_date)->format('d/m/Y'), 0, 1, 'R', 0, '', 1);
                $pdf->SetTextColor(0, 0, 0); // Reset text color to black for subsequent output

                if ($contract->signature != null) {
                    $dataPieces = explode(',', $contract->signature);
                    $encodedImg = $dataPieces[1];
                    $decodedImg = base64_decode($encodedImg);
                    //  Check if image was properly decoded
                    if ($decodedImg !== false) {
                        $name = 'signature-' . now()->toDateString() . '.png';
                        if (file_put_contents($name, $decodedImg) !== false) {
                            $pdf->Image($name, 100, 118, 32, 32, 'png');
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
