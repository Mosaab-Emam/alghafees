import React from "react";
import LatestTopicImagBox from "./LatestTopicImagBox";
import RelatedSlidBox from "../../../relatedTopics/RelatedSlidBox";

const LatestTopics = () => {
	const swiperRef = React.useRef(null);
	return (
		<div className='flex flex-col items-start lg:gap-4 gap-8 self-stretch xl:mb-0 lg:mb-0 mb-8'>
			<h3 className='head-line-h3 text-right text-Black-01'>احدث المواضيع</h3>
			<LatestTopicImagBox className='md:flex flex-col gap-4  hidden' />
			<RelatedSlidBox swiperRef={swiperRef} className='md:hidden flex' />
		</div>
	);
};

export default LatestTopics;
