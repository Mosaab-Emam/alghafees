import React from "react";
import { EventDescriptionSvg } from "../../assets/images/our-events";
import { ParagraphContent } from "../../xcomponents";

const EventDescriptionBox = () => {
    return (
        <section className="flex md:flex-row flex-col-reverse items-start md:gap-[51px] gap-8">
            <div className=" inline-flex flex-col items-start p-[50px] gap-[10px] rounded-tl-[100px] rounded-br-[100px] border-[5px] border-primary-600 bg-bg-01 mb-[43px]">
                <div className="flex flex-col items-start  gap-[14px]">
                    <h4 className="head-line-h4 text-right text-Black-01">
                        الوصف
                    </h4>

                    <ParagraphContent>
                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء
                        لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص
                        أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم
                        استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ
                        -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي،
                        هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص
                        مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات
                        الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص،
                        وإذا قمت بإدخال "lorem ipsum" في أي محرك بحث ستظهر
                        العديد من المواقع الحديثة العهد في نتائج البحث. على مدى
                        السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم،
                        أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض
                        العبارات الفكاهية إليها.
                    </ParagraphContent>
                </div>
            </div>

            <div className="md:w-[284px] w-[134px] md:h-auto h-[134px] flex flex-col items-center md:self-auto self-center">
                <EventDescriptionSvg className="md:w-[284px] w-[134px]  md:h-auto h-[134px] " />
            </div>
        </section>
    );
};

export default EventDescriptionBox;
