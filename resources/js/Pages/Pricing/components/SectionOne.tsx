import { BgImage } from "@/assets/images/our-services";
import { ParagraphContent } from "@/components";
import Container from "@/components/Container";
import { staticContext } from "@/utils/contexts";
import { Tag } from "lucide-react";
import { useContext } from "react";

const SectionOne = () => {
    const static_content = useContext<Record<string, string>>(staticContext);

    let items: { title: string }[];

    try {
        items = JSON.parse(static_content["hero_goals"]);
    } catch (error) {
        items = [];
    }

    return (
        <section className="md:mt-[211px] mt-[6rem] mb-[85px] relative">
            <Container>
                <div className="flex md:flex-row flex-col flex-wrap md:items-start items-center md:justify-between gap-8">
                    <div className="md:w-[305px] w-[360px] flex flex-col items-start md:gap-4 gap-0 self-center">
                        <h2 className="head-line-h2 text-right text-Black-01">
                            {static_content["hero_title"]}
                        </h2>
                        <ParagraphContent>
                            {static_content["hero_description"]}
                        </ParagraphContent>
                    </div>

                    <div className="relative lg:w-[478px] w-full md:w-1/2 md:h-full lg:h-[478px]">
                        <div
                            className="lg:w-[478px] w-full md:h-[478px] h-[292.127px] rounded-tl-[100px] rounded-br-[100px]"
                            style={{
                                background: `linear-gradient(0deg, rgba(0, 0, 0, 0.30) 0%, rgba(0, 0, 0, 0.30) 100%), url(${static_content["hero_image"]})  50% / cover no-repeat`,
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
                            {static_content["hero_goals_title"]}
                        </h3>
                        {items.map((item) => (
                            <div
                                key={item.title}
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
                                    {item.title}
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
