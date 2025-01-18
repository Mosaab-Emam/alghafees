import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import SectionTitle from "../SectionTitle";
import TextContent from "../TextContent";

const TopSection = () => {
    const static_content = useContext(staticContext);

    return (
        <div className="md:w-[420px] w-full flex flex-col items-center gap-[14px] mx-auto  mb-[50px]">
            <SectionTitle
                textColor="text-bg-02"
                type="tow-line_as_image"
                title={static_content["services_events_small_top_title"]}
            />
            <TextContent
                align="text-center"
                width="md:w-[420px] w-[312px]"
                textColor="text-bg-02"
            >
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["services_events_main_title"],
                    }}
                />
            </TextContent>
        </div>
    );
};

export default TopSection;
