import React, { useRef } from "react";
import EventsSliderBox from "./EventsSliderBox";
import EventsSliderArrowsButtons from "./EventsSliderArrowsButtons";

const EventsSlider = () => {
	const swiperRef = useRef(null);

	return (
		<div className='relative md:w-[747px] w-full md:mr-auto md:mb-[91px] mb-40'>
			<EventsSliderArrowsButtons
				position={
					"md:bottom-[6px] bottom-[-115px] md:-right-[22.5rem] md:left-auto left-1/2 -translate-x-1/2"
				}
				swiperRef={swiperRef}
			/>
			{/* Swiper Component */}
			<EventsSliderBox swiperRef={swiperRef} />
		</div>
	);
};

export default EventsSlider;
