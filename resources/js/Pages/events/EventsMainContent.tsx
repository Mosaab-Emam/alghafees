import React, { useEffect } from "react";
import EventInfoCard from "./EventInfoCard";
import EventsSlider from "./eventsSlider/EventsSlider";
import { SalehNameEnglishShape } from "../../components";
import EventDescriptionBox from "./EventDescriptionBox";

const EventsMainContent = () => {
	useEffect(() => {
		window.scrollTo(0, 0);
	}, []);

	return (
		<section className='container md:mt-[211px] mt-[6rem] mb-8 relative'>
			<div className='flex md:flex-row flex-col xl:gap-0 lg:gap-6 gap-8 items-center '>
				<EventInfoCard />
				<EventsSlider />
			</div>
			<SalehNameEnglishShape position={"right-[-95px] top-[160px]"} />

			<EventDescriptionBox />
		</section>
	);
};

export default EventsMainContent;
