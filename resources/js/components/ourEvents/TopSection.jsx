import React from "react";
import SectionTitle from "../SectionTitle";
import TextContent from "../TextContent";

const TopSection = () => {
	return (
		<div className='md:w-[420px] w-full flex flex-col items-center gap-[14px] mx-auto  mb-[50px]'>
			<SectionTitle
				textColor='text-bg-02'
				type='tow-line_as_image'
				title={"الاحداث و الفعاليات"}
			/>
			<TextContent
				align='text-center'
				width='md:w-[420px] w-[312px]'
				textColor='text-bg-02'>
				كن جزءًا من أحداثنا وفعالياتنا واستفد من فرص لا تُفوّت
			</TextContent>
		</div>
	);
};

export default TopSection;
