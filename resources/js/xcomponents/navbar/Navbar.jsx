import React, { useState } from "react";

import WebsiteLogo from "../WebsiteLogo";

import Border from "../shapes/Border";

import DeskTopMenu from "./deskTopMenu/DeskTopMenu";
import MobileMenu from "./mobileMenu/MobileMenu";
import MenuButton from "./mobileMenu/MenuButton";

const Navbar = () => {
	const [toggleMenu, setToggleMenu] = useState(false);
	const handleToggleMenu = () => {
		setToggleMenu(!toggleMenu);
	};
	return (
		<div className='container '>
			<nav className='flex justify-between items-end  md:gap-4 lg:gap-5 xl:gap-[2.3rem] 2xl:gap-[5rem] py-9 z-10 relative'>
				<WebsiteLogo />
				<DeskTopMenu />
				<MobileMenu
					toggleMobileMenu={toggleMenu}
					onClickMenu={handleToggleMenu}
				/>
				<MenuButton onClickMenu={handleToggleMenu} toggleMenu={toggleMenu} />
			</nav>

			<Border />
		</div>
	);
};

export default Navbar;
