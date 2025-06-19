import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import DownloadAppIconsBox from "../../DownloadAppIconsBox";

import FollowUsBox from "../../followUsBox/FollowUsBox";

const FooterDownloadApp = () => {
    const static_content = useContext(staticContext);
    const apps_links_visible =
        static_content["ios_app_link"] || static_content["android_app_link"];

    return (
        <div className="md:w-[213px] w-full flex flex-col items-start lg:gap-6 xl:gap-[39px] ">
            {apps_links_visible && (
                <>
                    <h6 className="head-line-h5 text-right text-Black-01 ">
                        حمل تطبيقنا الآن..
                    </h6>
                    <DownloadAppIconsBox iconWidth="w-[90.539px] h-[26.826px]" />
                </>
            )}
            <div className="flex gap-4">
                <tamara-widget
                    type="tamara-summary"
                    inline-variant="text"
                ></tamara-widget>
                <tamara-widget
                    type="tamara-summary"
                    inline-type="1"
                    inline-variant="text"
                ></tamara-widget>
            </div>
            <FollowUsBox />
        </div>
    );
};

export default FooterDownloadApp;
