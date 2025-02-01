import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { ParagraphContent, TextContent } from "../../components";

const TrackTextbox = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section className="lg:w-[528px] w-full flex flex-col items-start gap-4">
            <TextContent
                headLineClass="md:head-line-h2 head-line-h3"
                align="text-right"
                width="w-full"
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
    );
};

export default TrackTextbox;
