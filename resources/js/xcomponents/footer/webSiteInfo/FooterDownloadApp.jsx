import React from "react";

import DownloadAppIconsBox from "../../DownloadAppIconsBox";

import FollowUsBox from "../../followUsBox/FollowUsBox";

const FooterDownloadApp = () => {
	return (
		<div className='md:w-[213px] w-full flex flex-col items-start lg:gap-6 xl:gap-[39px] '>
			<h6 className='head-line-h5 text-right text-Black-01 '>
				حمل تطبيقنا الآن..
			</h6>
			<DownloadAppIconsBox iconWidth='w-[90.539px] h-[26.826px]' />
			<FollowUsBox />
		</div>
	);
};

export default FooterDownloadApp;
