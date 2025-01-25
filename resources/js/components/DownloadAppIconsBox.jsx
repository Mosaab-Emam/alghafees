import { AppStoreIcon, GooglePlayIcon } from "../assets/icons";

const DownloadAppIconsBox = ({ iconWidth }) => {
    return (
        <div className="flex flex-row md:flex-col lg:flex-row items-start justify-center md:gap-4 gap-2 lg:mt-0 lg:mb-0 mt-4 ">
            <AppStoreIcon className={`${iconWidth} cursor-pointer`} />
            <GooglePlayIcon className={`${iconWidth} cursor-pointer`} />
        </div>
    );
};

export default DownloadAppIconsBox;
