import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { ParagraphContent, TextContent } from "../../components";

const JoinUsTextBox = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section className="lg:absolute lg:-bottom-[25rem] 2xl:w-[1300px] xl:w-[1200px] lg:w-[1024px] w-full xl:h-[608px] lg:h-[408px] h-[974px] md:mt-0 -mt-16 glass-effect rounded-bl-[100px] border-[3px] border-primary-300 z-index-9">
            <section className="md:w-full xl:w-[430px] 2xl:w-[470px] w-full flex flex-col items-start gap-4 xl:mt-[173px] lg:mt-[80px] xl:mb-[174px] lg:mb-[80px] mb-8 xl:mr-[50px] lg:mr-8 lg:p-4 p-6">
                <TextContent
                    headLineClass="md:head-line-h2 head-line-h3"
                    align="text-right"
                >
                    <span
                        dangerouslySetInnerHTML={{
                            __html: static_content["title"],
                        }}
                    />
                </TextContent>
                <ParagraphContent>
                    <span
                        dangerouslySetInnerHTML={{
                            __html: static_content["description"],
                        }}
                    />
                </ParagraphContent>
            </section>
        </section>
    );
};

export default JoinUsTextBox;
