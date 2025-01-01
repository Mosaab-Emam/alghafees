import React from "react";
import MenuIcon from "./MenuIcon";

const MenuButton = ({ onClickMenu }) => {
	return (
		<button
			onClick={onClickMenu}
			className={` md:hidden flex w-[24px] h-[24px]  justify-center items-center`}>
			<MenuIcon />
		</button>
	);
};

export default MenuButton;
