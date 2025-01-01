import React from "react";
import {
    BgGlassFilterShape,
    ParagraphContent,
    TextContent,
} from "../../xcomponents";

const ClientsBoxOne = () => {
    return (
        <div className="flex md:flex-row flex-col md:gap-[220px] gap-4 relative md:mb-12 mb-8">
            <TextContent width={"md:w-[492px] w-[312px]"} align="text-right">
                استمع إلى عملائنا كيف ساعدناهم في تحقيق{" "}
                <span className="text-primary-600">أهدافهم العقارية</span> بنجاح
                واحترافية
            </TextContent>
            <div className="md:w-[492px] w-[312px] md:mt-[190.5px] mt:mb-[70px] mt-8">
                <ParagraphContent>
                    نحن فخورون بعملائنا الراضين الذين يشاركوننا تجاربهم
                    الإيجابية. نؤمن أن أفضل دليل على جودة خدماتنا هو رضا عملائنا
                    وثقتهم بنا. اكتشف ما يقوله عملاؤنا عن الاستشارات العقارية
                    التي نقدمها، وكيف ساعدناهم في تحقيق أهدافهم العقارية بطريقة
                    سلسة وموثوقة. انضم إلى مجموعة عملائنا السعداء وكن جزءًا من
                    رحلتنا المتميزة
                </ParagraphContent>
            </div>
            <BgGlassFilterShape position="-right-[22rem] -bottom-[5rem]" />
        </div>
    );
};

export default ClientsBoxOne;
