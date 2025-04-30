import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import DownloadAppIconsBox from "../../DownloadAppIconsBox";
import TextContent from "../../TextContent";

const DownloadApp = ({ className }) => {
    const static_content = useContext(staticContext);
    const visible =
        !!static_content["ios_app_link"] &&
        !!static_content["android_app_link"];

    return (
        <>
            {!visible ? (
                <></>
            ) : (
                <div
                    className={`${className} damn2 download_app_section flex flex-col md:gap-[26px] gap-4 items-center justify-center`}
                >
                    <TextContent width="w-[272px]">
                        thanks
                        <span
                            dangerouslySetInnerHTML={{
                                __html: static_content[
                                    "hero_download_box_text"
                                ],
                            }}
                        />
                    </TextContent>
                    <DownloadAppIconsBox iconWidth={"w-[120px] "} />
                </div>
            )}
        </>
    );
};

export default DownloadApp;
