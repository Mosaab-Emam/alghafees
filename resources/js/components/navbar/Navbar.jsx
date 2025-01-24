import React, { useState } from "react";

import WebsiteLogo from "../WebsiteLogo";

import Border from "../shapes/Border";

import DeskTopMenu from "./deskTopMenu/DeskTopMenu";
import MenuButton from "./mobileMenu/MenuButton";
import MobileMenu from "./mobileMenu/MobileMenu";

const Navbar = () => {
    const [toggleMenu, setToggleMenu] = useState(false);
    const handleToggleMenu = () => {
        setToggleMenu(!toggleMenu);
    };
    return (
        <div className="container ">
            <nav className="flex justify-between items-center md:items-end lg:gap-5 xl:gap-[2.3rem] 2xl:gap-[5rem] pt-4 pb-9 md:pt-9 z-10 relative ml-4">
                <WebsiteLogo />
                <DeskTopMenu />
                <MobileMenu
                    toggleMobileMenu={toggleMenu}
                    onClickMenu={handleToggleMenu}
                />
                <MenuButton
                    onClickMenu={handleToggleMenu}
                    toggleMenu={toggleMenu}
                />
            </nav>

            <Border />
        </div>
    );
};

export default Navbar;
