import { ParagraphContent, TextContent } from "../../components";

const TrackTextbox = () => {
    return (
        <section className="lg:w-[528px] w-full flex flex-col items-start gap-4">
            <TextContent
                headLineClass="md:head-line-h2 head-line-h3"
                align="text-right"
                width="w-full"
            >
                <>
                    تابع طلبك خطوة بخطوة{" "}
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
