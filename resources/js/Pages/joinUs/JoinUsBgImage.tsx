import React from "react";
import { JoinUsBg } from "../../assets/images/join-us";

const JoinUsBgImage = () => {
	return (
		<div className='relative xl:-top-[17.5rem] lg:-top-[13.5rem] -top-[95px] right-0 md:-right-24'>
			<div
				className='xl:w-[757px] lg:w-[657px] w-[312px] xl:h-[703px] lg:h-[503px] h-[355px] '
				style={{
					background: `url(${JoinUsBg}) lightgray 50% / cover no-repeat`,
				}}></div>
		</div>
	);
};

export default JoinUsBgImage;
