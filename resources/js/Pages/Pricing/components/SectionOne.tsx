import { BgImage } from "@/assets/images/our-services";
import { ParagraphContent } from "@/components";
import Container from "@/components/Container";
import { Tag } from "lucide-react";
import SectionOneImage from "../assets/section-one-bg.png";

const SectionOne = () => {
    const items = [
        "التقييم لغرض البيع أو الشراء",
        "التقييم لغرض الرهن والتمويل",
        "التقييم للأغراض المحاسبية",
        "التقييم للأغراض التجارية",
    ];

    return (
        <section className="md:mt-[211px] mt-[6rem] mb-[85px] relative">
            <Container>
                <div className="flex md:flex-row flex-col flex-wrap md:items-start items-center md:justify-between gap-8">
                    <div className="md:w-[305px] w-[360px] flex flex-col items-start md:gap-4 gap-0 self-center">
                        <h2 className="head-line-h2 text-right text-Black-01">
                            أسعار خدمة التقييم العقاري
                        </h2>
                        <ParagraphContent>
                            نُقدّم تقييمًا دقيقًا ومعتمدًا لجميع أنواع العقارات
                            في مختلف مدن المملكة، سواء بغرض البيع أو الشراء أو
                            أي إجراء رسمي آخر.
                        </ParagraphContent>
                    </div>

                    <div className="relative lg:w-[478px] w-full md:w-1/2 md:h-full lg:h-[478px]">
                        <div
                            className="lg:w-[478px] w-full md:h-[478px] h-[292.127px] rounded-tl-[100px] rounded-br-[100px]"
                            style={{
                                background: `linear-gradient(0deg, rgba(0, 0, 0, 0.30) 0%, rgba(0, 0, 0, 0.30) 100%), url(${SectionOneImage})  50% / cover no-repeat`,
                            }}
                        />

                        <div
                            className="lg:w-[478px] w-full lg:h-[478px] h-full absolute md:top-4 top-3 left-4  z-[-1] rounded-tl-[100px] rounded-br-[100px]"
                            style={{
                                background: `url(${BgImage})  50% / cover no-repeat`,
                            }}
                        />
                    </div>

                    <div className="md:w-[340px] w-[360px] self-center">
                        <h3 className="head-line-h3 text-Black-01 flex items-center mb-4">
                            <Tag
                                color="white"
                                fill="#0F819F"
                                className="ml-2 rotate-90"
                                size={40}
                            />
                            أغراض التقييم العقاري
                        </h3>
                        {items.map((item) => (
                            <div
                                key={item}
                                className="border-2 border-primary-600 rounded-br-full rounded-tl-full flex mb-4"
                            >
                                <div className="bg-primary-600 py-2 px-7 rounded-br-full rounded-tl-full">
                                    <Tag
                                        color="#0F819F"
                                        fill="white"
                                        className="rotate-90"
                                        size={32}
                                    />
                                </div>
                                <h5 className="head-line-h5 text-Black-01 flex items-center pl-4 pr-2">
                                    {item}
                                </h5>
                            </div>
                        ))}
                    </div>
                </div>
            </Container>
        </section>
    );
};

export default SectionOne;
