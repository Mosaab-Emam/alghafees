import { router } from "@inertiajs/react";
import React from "react";
import ButtonsBox from "../../ButtonsBox";
import ParagraphContent from "../../ParagraphContent";

const ContentBox = ({ className }) => {
    return (
        <div
            className={`${className} flex flex-col justify-center items-start gap-[30px]`}
        >
            <ParagraphContent>
                تفخر شركة صالح علي الغفيص للتقييم العقاري بفروعها المرخصة في
                مزاولة مهنة التقييم العقاري في كل من الرياض والقصيم ، حيث سعينا
                منذ وقت مبكر على التواصل مع الهيئة السعودية للمقيمين المعتمدين
                ايماناً منا بأهمية مهنة التقييم وتطويرها وتنظيمها ليكون العمل
                بالمهنة وفق األنظمة والمعايير الدولية للتقييم
            </ParagraphContent>

            <ButtonsBox
                gap="gap-4"
                flexDirection="xl:justify-start"
                btnWidth="md:w-[280px] "
                primaryBtnContent={"اتصل بنا"}
                primaryButtonOnClick={() => router.visit("/contact-us")}
                outlineBtnContent={"تقدم بطلبك الآن "}
                outLinButtonOnClick={() => router.visit("/request-evaluation")}
            />
        </div>
    );
};

export default ContentBox;
