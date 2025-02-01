import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { ParagraphContent, TextContent } from "../../components";

const TextBox = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section className="lg:w-[520px] md:w-96 flex flex-col items-start gap-8 md:mb-12">
            <div className=" flex flex-col items-start gap-4 self-stretch" />
            <TextContent width={"w-full"} align="text-right">
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["evaluation_title"],
                    }}
                />
            </TextContent>

            <ParagraphContent>
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["evaluation_description"],
                    }}
                />
            </ParagraphContent>
        </section>
    );
};

export default TextBox;
