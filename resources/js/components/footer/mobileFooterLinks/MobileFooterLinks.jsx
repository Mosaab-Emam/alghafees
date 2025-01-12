import React from "react";
import WebsiteMobileFooterLink from "./WebsiteMobileFooterLink";

const MobileFooterLinks = ({ links }) => {
	return (
		<div className='md:hidden flex py-[5px] px-0 justify-between content-center flex-wrap items-center w-[312px]  bg-bg-01 border border-Gray-scale-01'>
			{links.map((link) => (
				<WebsiteMobileFooterLink key={link.id} to={link.to}>
					{link.name}
				</WebsiteMobileFooterLink>
			))}
		</div>
	);
};

export default MobileFooterLinks;
