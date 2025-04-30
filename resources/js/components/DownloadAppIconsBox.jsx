import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { AppStoreIcon, GooglePlayIcon } from "../assets/icons";

const DownloadAppIconsBox = ({ iconWidth }) => {
    const static_content = useContext(staticContext);

    return (
        <div className="flex flex-row md:flex-col lg:flex-row items-start justify-center md:gap-4 gap-2 lg:mt-0 lg:mb-0 mt-4 ">
            {static_content["ios_app_link"] && (
                <a
                    href={static_content["ios_app_link"]}
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <AppStoreIcon className={`${iconWidth} cursor-pointer`} />
                </a>
            )}
            {static_content["android_app_link"] && (
                <a
                    href={static_content["android_app_link"]}
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <GooglePlayIcon className={`${iconWidth} cursor-pointer`} />
                </a>
            )}
        </div>
    );
};

export default DownloadAppIconsBox;
