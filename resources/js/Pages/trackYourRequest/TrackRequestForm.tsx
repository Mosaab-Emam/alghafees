import React from "react";
import TrackInput from "./TrackInput";
import TrackTextbox from "./TrackTextbox";

const TrackRequestForm = () => {
	return (
		<section className='xl:w-[692px] lg:w-[592px] w-[312px] flex flex-col items-start xl:gap-16 lg:gap-8 gap-8'>
			<TrackTextbox />
			<TrackInput />
		</section>
	);
};

export default TrackRequestForm;
