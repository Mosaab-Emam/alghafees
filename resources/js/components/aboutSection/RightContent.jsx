import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import ParagraphContent from "../ParagraphContent";
import SectionTitle from "../SectionTitle";
import TextContent from "../TextContent";

const RightContent = () => {
    const static_content = useContext(staticContext);

    return (
        <section className="flex flex-col md:mt-[80px] -mt-[190px] items-start gap-4 w-full  lg:w-[290px] xl:w-[285px] ">
            <SectionTitle title={static_content["about_small_top_title"]} />
            <TextContent>
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["about_main_title"],
                    }}
                />
            </TextContent>

            <ParagraphContent>
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["about_description"],
                    }}
                />
            </ParagraphContent>
        </section>
    );
};

export default RightContent;
