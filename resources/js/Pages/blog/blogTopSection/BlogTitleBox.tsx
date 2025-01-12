import { ParagraphContent, TextContent } from "../../../components";

export default function BlogTitleBox() {
    return (
        <div
            id="search-title"
            className="md:w-[600px] w-full flex flex-col  items-start gap-2"
        >
            <TextContent
                width={"w-full"}
                align="text-start"
                headLineClass="md:head-line-h2 head-line-h3"
            >
                دليلك للعقارات: اكتشف،{" "}
                <span className="text-primary-600">استثمر </span>، وازدهر
            </TextContent>

            <ParagraphContent>
                وجهتك الشاملة لكل ما يتعلق بالعقارات. هنا، نقدم نصائح
                واستراتيجيات، ونستعرض أحدث اتجاهات السوق لمساعدتك في اتخاذ
                قرارات استثمارية ناجحة. انضم إلينا لاستكشاف الفرص وتحقيق أهدافك
                العقارية!
            </ParagraphContent>
        </div>
    );
}
