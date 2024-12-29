import React, { useState } from "react";

import Border from "@/Components/Border";
import WebsiteLogo from "@/Components/WebsiteLogo";

// import MenuButton from "@/Components/mobileMenu/MenuButton";
// import MobileMenu from "@/Components/mobileMenu/MobileMenu";
import ButtonsBox from "./ButtonsBox";
import WebsiteLinks from "./WebsiteLinks";

const DesktopMenu = () => {
    // const navigate = useNavigate();
    const links = [
        { id: 1, name: "الرئيسية", to: "/" },
        { id: 2, name: "من نحن", to: "/about-us" },
        { id: 3, name: "خدماتنا", to: "/our-services" },
        { id: 4, name: "عملاؤنا", to: "/our-clients" },
        { id: 5, name: "الفعاليات", to: "/events" },
        { id: 6, name: "طلب تقييم ", to: "/request-evaluation" },
    ];
    return (
        <div className="w-full md:flex justify-between hidden">
            <WebsiteLinks links={links} />

            <ButtonsBox
                // outLinButtonOnClick={() => navigate("/track-your-request")}
                outLinButtonOnClick={() => console.log("track-your-request")}
                // primaryButtonOnClick={() => navigate("/join-us")}
                primaryButtonOnClick={() => console.log("join-us")}
                outlineBtnContent={"تتبع طلبك "}
                primaryBtnContent={"انضم إلينا"}
            />
        </div>
    );
};

const Navbar = () => {
    const [toggleMenu, setToggleMenu] = useState(false);
    const handleToggleMenu = () => {
        setToggleMenu(!toggleMenu);
    };
    return (
        <div className="container ">
            <nav className="flex justify-between items-end  md:gap-4 lg:gap-5 xl:gap-[2.3rem] 2xl:gap-[5rem] py-9 z-10 relative">
                <WebsiteLogo />
                <DesktopMenu />
                {/* <MobileMenu
                    toggleMobileMenu={toggleMenu}
                    onClickMenu={handleToggleMenu}
                />
                <MenuButton
                    onClickMenu={handleToggleMenu}
                    toggleMenu={toggleMenu}
                /> */}
            </nav>

            <Border />
        </div>
    );
};

export default Navbar;
