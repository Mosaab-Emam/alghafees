<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>استكمال إجراءات التدريب</title>
    <style>
        @media only screen and (max-width: 600px) {
            .email-outer { padding: 16px 8px !important; }
            .email-content { padding: 24px 20px !important; }
            .email-title { font-size: 26px !important; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#f3f9fa;color:#26292a;font-family:Tahoma,Arial,sans-serif;">
    <div style="display:none;font-size:1px;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;">إجابة جديدة على نموذج استكمال إجراءات التدريب.</div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" dir="rtl" style="background-color:#f3f9fa;">
        <tr>
            <td align="center" class="email-outer" style="padding:36px 16px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:640px;">
                    <tr>
                        <td style="padding:0 12px 20px;text-align:right;color:#0f819f;font-size:15px;line-height:1.8;font-weight:bold;">شركة صالح علي الغفيص<br><span style="font-size:12px;color:#51656a;font-weight:normal;">للتقييم العقاري</span></td>
                    </tr>
                    <tr>
                        <td class="email-content" bgcolor="#0f819f" style="padding:32px 36px;border-radius:32px 0 0 0;color:#feffff;text-align:right;">
                            <p style="margin:0 0 10px;font-size:13px;line-height:1.8;color:#e7f2f5;">نموذج التدريب · إجابة جديدة</p>
                            <h1 class="email-title" style="margin:0;font-size:30px;line-height:1.6;font-weight:bold;">استكمال إجراءات التدريب</h1>
                            <p style="margin:14px 0 0;font-size:13px;line-height:1.8;color:#e7f2f5;">تاريخ الإرسال: <span dir="ltr" style="display:inline-block;">{{ $submittedAt }}</span> (توقيت الرياض)</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="email-content" bgcolor="#feffff" style="padding:32px 36px;border:1px solid #cfe6ec;border-top:0;text-align:right;">
                            <h2 style="margin:0 0 20px;color:#26292a;font-size:20px;line-height:1.6;">البيانات الشخصية</h2>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f3f9fa;">
                                <tr><td style="padding:18px 20px 6px;font-size:12px;color:#51656a;">الاسم الكامل</td></tr>
                                <tr><td style="padding:0 20px 18px;font-size:20px;line-height:1.7;color:#26292a;word-break:break-word;">{{ $answers['name'] }}</td></tr>
                                <tr><td style="padding:16px 20px 6px;border-top:1px solid #cfe6ec;font-size:12px;color:#51656a;">البريد الإلكتروني</td></tr>
                                <tr><td style="padding:0 20px 18px;font-size:16px;line-height:1.7;word-break:break-all;"><a href="mailto:{{ $answers['email'] }}" dir="ltr" style="display:inline-block;color:#0f819f;text-decoration:underline;">{{ $answers['email'] }}</a></td></tr>
                                <tr><td style="padding:16px 20px 6px;border-top:1px solid #cfe6ec;font-size:12px;color:#51656a;">رقم الجوال</td></tr>
                                <tr><td style="padding:0 20px 18px;font-size:16px;line-height:1.7;"><a href="tel:{{ $answers['phone'] }}" dir="ltr" style="display:inline-block;color:#0f819f;text-decoration:underline;">{{ $answers['phone'] }}</a></td></tr>
                            </table>

                            <h2 style="margin:32px 0 8px;color:#26292a;font-size:20px;line-height:1.6;">معلومات التدريب</h2>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                @foreach ($questions as $key => $question)
                                    <tr>
                                        <td style="padding:20px 0;border-bottom:1px solid #cfe6ec;">
                                            <p style="margin:0 0 10px;color:#51656a;font-size:14px;line-height:1.9;">{{ ['١', '٢', '٣', '٤'][$loop->index] }}. {{ $question['label'] }}</p>
                                            <p style="margin:0;color:#0f819f;font-size:17px;line-height:1.8;font-weight:bold;">{{ $question['options'][$answers[$key]] }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <p style="margin:24px 0 0;color:#51656a;font-size:13px;line-height:1.9;">للتواصل مع المتقدم، يمكنك الرد مباشرةً على هذا البريد الإلكتروني.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#e7f2f5" style="padding:18px 24px;border-radius:0 0 32px 0;text-align:center;color:#51656a;font-size:12px;line-height:1.9;">تحتوي هذه الرسالة على بيانات شخصية مخصصة لفريق إجراءات التدريب.</td>
                    </tr>
                    <tr>
                        <td style="padding:22px 12px 0;text-align:center;color:#51656a;font-size:12px;line-height:1.8;">شركة صالح علي الغفيص للتقييم العقاري</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
