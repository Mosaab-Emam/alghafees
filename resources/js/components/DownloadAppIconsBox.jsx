import React from "react";
import { AppStoreIcon, GooglePlayIcon } from "../assets/icons";

const DownloadAppIconsBox = ({ iconWidth }) => {
	return (
		<div className='flex items-start justify-center md:gap-4 gap-2 md:mt-0 md:mb-0 mt-4 '>
			<AppStoreIcon className={`${iconWidth} cursor-pointer`} />
			<GooglePlayIcon className={`${iconWidth} cursor-pointer`} />
		</div>
	);
};

export default DownloadAppIconsBox;
