import React from "react";

import TextContent from "../../TextContent";
import DownloadAppIconsBox from "../../DownloadAppIconsBox";

const DownloadApp = ({ className }) => {
	return (
		<div
			className={`${className} download_app_section flex flex-col md:gap-[26px] gap-4 items-center justify-center`}>
			<TextContent width='w-[272px]'>
				حمّل تطبيق <span className='text-primary-600'>الغفيص</span> الآن واستفد
				من خدماتنا العقارية أينما كنت
			</TextContent>
			<DownloadAppIconsBox iconWidth={"w-[120px] "} />
		</div>
	);
};

export default DownloadApp;
