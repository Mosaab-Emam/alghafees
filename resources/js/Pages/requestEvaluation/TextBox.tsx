import { ParagraphContent, TextContent } from "../../components";

const TextBox = () => {
    return (
        <section className="lg:w-[520px] md:w-96 flex flex-col items-start gap-8 md:mb-12">
            <div className=" flex flex-col items-start gap-4 self-stretch" />
            <TextContent width={"w-full"} align="text-right">
                اجعل قرارك مستنيرًا{" "}
                <span className="text-primary-600"> بتقييم احترافي </span>
                لعقاركم
            </TextContent>

            <ParagraphContent>
                هل تفكر في بيع أو شراء عقار؟ قم بملء طلب تقييم العقار الآن لتحصل
                على تقدير دقيق لقيمته. بتقديم معلومات بسيطة، يمكنك اتخاذ قرار
                مدروس استنادًا إلى بيانات موثوقة وتحليلات متعمقة. لا تفوت
                الفرصة؛ ابدأ اليوم!
            </ParagraphContent>
        </section>
    );
};

export default TextBox;
