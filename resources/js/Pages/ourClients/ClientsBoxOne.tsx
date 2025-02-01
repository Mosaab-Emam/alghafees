import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import {
    BgGlassFilterShape,
    ParagraphContent,
    TextContent,
} from "../../components";

const ClientsBoxOne = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <div className="flex lg:flex-row flex-col lg:gap-[220px] gap-4 relative md:mb-12 mb-8">
            <TextContent
                width={"lg:w-[492px] w-full md:w-4/5"}
                align="text-right"
            >
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["main_title"],
                    }}
                />
            </TextContent>
            <div className="lg:w-[492px] w-full lg:mt-[190.5px] mt:mb-[70px] mt-8">
                <ParagraphContent>
                    <span
                        dangerouslySetInnerHTML={{
                            __html: static_content["main_description"],
                        }}
                    />
                </ParagraphContent>
            </div>
            <BgGlassFilterShape position="-right-[22rem] -bottom-[5rem]" />
        </div>
    );
};

export default ClientsBoxOne;
