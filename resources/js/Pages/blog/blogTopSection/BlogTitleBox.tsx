import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { ParagraphContent, TextContent } from "../../../components";

export default function BlogTitleBox() {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <div
            id="search-title"
            className="lg:w-[600px] w-full flex flex-col items-start gap-2"
        >
            <TextContent
                width={"w-full"}
                align="text-start"
                headLineClass="md:head-line-h2 head-line-h3"
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
        </div>
    );
}
