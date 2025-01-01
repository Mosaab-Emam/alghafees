import React from "react";

import SocialItemBoxFrame from "./SocialItemBoxFrame";

const FollowUsBox = () => {
	return (
		<div className='flex flex-col items-start lg:gap-4 xl:gap-[20px] gap-4 lg:mt-6 xl:mt-0 mt-8'>
			<h6 className=' head-line-h5 text-right text-Black-01 '>
				تابعنا على مواقع التواصل..
			</h6>

			<div className='flex gap-3 items-start'>
				<SocialItemBoxFrame />
			</div>
		</div>
	);
};

export default FollowUsBox;
