import Address from "./Address/Address";
import FooterDownloadApp from "./FooterDownloadApp";
import FooterLogo from "./FooterLogo";
import LineBetweenItems from "./LineBetweenItems";

const WebSiteInfo = () => {
    return (
        <>
            <div className="xl:container 2xl:px-8  xl:mx-auto px-4 sm:px-6 md:px-8 lg:px-20 xl:px-4 md:mb-[80px] mb-4 relative z-10">
                <div className="flex md:flex-row flex-col lg:justify-start xl:justify-between lg:gap-6 xl:gap-0 gap-6 md:items-end items-start  ">
                    <FooterLogo />
                    <LineBetweenItems />
                    <Address />
                    <LineBetweenItems />
                    <FooterDownloadApp />
                </div>
            </div>
        </>
    );
};

export default WebSiteInfo;
