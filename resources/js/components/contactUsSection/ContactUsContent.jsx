import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import SectionTitle from "../SectionTitle";
import TextContent from "../TextContent";

const ContactUsContent = ({
    showPriceOffer,
    contactUsContentPosition = "mt-[132px] mb-0",
}) => {
    const static_content = useContext(staticContext);

    return showPriceOffer ? (
        <TextContent textColor={"text-Black-01"}>
            <span
                dangerouslySetInnerHTML={{
                    __html:
                        static_content["contact_us_main_title"] ||
                        static_content["title"],
                }}
            />
        </TextContent>
    ) : (
        <div
            className={`${contactUsContentPosition} flex flex-col items-start lg:mb-[92px] lg:mt-[364px] gap-4 self-stretch`}
        >
            <SectionTitle
                textColor={"text-primary-600"}
                title={static_content["contact_us_small_top_title"]}
            />
            <TextContent textColor={"text-Black-01"}>
                <span
                    className="block w-64"
                    dangerouslySetInnerHTML={{
                        __html: static_content["contact_us_main_title"],
                    }}
                />
            </TextContent>
        </div>
    );
};

export default ContactUsContent;
