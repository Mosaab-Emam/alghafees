import React from "react";
import { ParagraphContent, TextContent } from "../../xcomponents";

const TrackTextbox = () => {
    return (
        <section className="md:w-[528px] w-[312px] flex flex-col items-start gap-4">
            <TextContent
                headLineClass="md:head-line-h2 head-line-h3"
                align="text-right"
            >
                <>
                    تابع طلبك خطوة
                    <br /> بخطوة{" "}
                    <span className="text-primary-600"> بسهولة </span> وشفافية
                </>
            </TextContent>
            <ParagraphContent>
                ببساطة قم بإدخال كود الطلب الخاص بك لتتعرف على مرحلته الحالية
                وتتبع جميع التفاصيل حتى إتمامه بنجاح
            </ParagraphContent>
        </section>
    );
};

export default TrackTextbox;
