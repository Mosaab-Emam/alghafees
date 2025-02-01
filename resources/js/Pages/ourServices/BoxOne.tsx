import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { ParagraphContent, TextContent } from "../../components";

const BoxOne = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section className="md:w-[430px] w-[312px] md:mx-auto flex flex-col justify-center items-center gap-[14px] mb-[50px]">
            <TextContent
                width={"md:w-[405px] w-[312px]"}
                align="md:text-center text-start"
            >
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["main_title"],
                    }}
                />
            </TextContent>

            <ParagraphContent>
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["main_description"],
                    }}
                />
            </ParagraphContent>
        </section>
    );
};

export default BoxOne;
