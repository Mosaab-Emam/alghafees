import React from "react";
import { Link } from "react-router-dom";

import { Logo } from "../assets/icons";

const WebsiteLogo = ({ className }) => {
	return (
		<>
			<Link className='2xl:pr-4' to='/'>
				<Logo className='h-[56px] w-[148px] lg:h-[60px] lg:w-[140px] xl:h-[88.548px] xl:w-[180px]' />
			</Link>
		</>
	);
};

export default WebsiteLogo;
