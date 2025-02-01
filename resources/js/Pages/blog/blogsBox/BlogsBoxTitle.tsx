import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { SectionTitle, TextContent } from "../../../components";

const BlogsBoxTitle = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section
            id="blogs-title-section"
            className="md:w-[510px] w-[360px] flex flex-col items-start gap-3 mb-[50px]"
        >
            <SectionTitle title={static_content["blog_small_title"]} />
            <TextContent
                width={"w-full"}
                align="text-start"
                headLineClass="md:head-line-h2 head-line-h3"
            >
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["blog_main_title"],
                    }}
                />
            </TextContent>
        </section>
    );
};

export default BlogsBoxTitle;
