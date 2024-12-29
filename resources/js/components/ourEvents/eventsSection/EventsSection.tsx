import React from "react";

import EventsVideo from "./EventsVideo";
import EventsImages from "./EventsImages";

const EventsSection = () => {
	return (
		<section className='flex md:flex-row flex-col-reverse justify-center items-center gap-5 md:mb-[65px] mb-[24px]'>
			<EventsImages />
			<EventsVideo />
		</section>
	);
};

export default EventsSection;
