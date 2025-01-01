import React, { useRef } from "react";

import EventsSlideBox from "./EventsSlideBox";
import CustomPagination from "../../../../components/ourClients/sliderBox/CustomPagination";

const EventsSlider = () => {
	const swiperRef = useRef(null);
	return (
		<div className='relative'>
			{/* Swiper Component */}
			<EventsSlideBox swiperRef={swiperRef} />
			<CustomPagination position='md:!bottom-[-79px] md:!right-auto left-1/2 -translate-x-1/2 !-bottom-10' />
		</div>
	);
};

export default EventsSlider;
