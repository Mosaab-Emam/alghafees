import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import DownloadAppIconsBox from "../../DownloadAppIconsBox";
import TextContent from "../../TextContent";

const DownloadApp = ({ className }) => {
    const static_content = useContext(staticContext);

    return (
        <div
            className={`${className} download_app_section flex flex-col md:gap-[26px] gap-4 items-center justify-center`}
        >
            <TextContent width="w-[272px]">
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["hero_download_box_text"],
                    }}
                />
            </TextContent>
            <DownloadAppIconsBox iconWidth={"w-[120px] "} />
        </div>
    );
};

export default DownloadApp;
