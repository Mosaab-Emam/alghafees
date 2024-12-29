import React from "react";

import { ourEventsData } from "../../../data/ourEventsData";
import ShowMoreBtn from "../ShowMoreBtn";
import { useNavigate } from "react-router-dom";

const EventsImages = () => {
	const navigate = useNavigate();
	return (
		<div className='flex md:flex-col flex-row md:gap-5 gap-4 self-center '>
			{ourEventsData.map((item) => (
				<div key={item.id}>
					<div
						className='lg:w-[200px] xl:w-[285px] w-[172px] lg:h-[200px] xl:h-[249px] h-[150.274px] relative '
						style={{
							borderRadius: "50px 0px 0px 50px",
							background: `linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, #000 100%) , url(${item?.event_image})  lightgray 50% / cover no-repeat`,
						}}>
						<ShowMoreBtn
							onClick={() => navigate(`/events/${item.id}`)}
							position='right-0 top-0'
						/>
						<h4 className='md:block hidden lg:pt-[130px] xl:pt-[181px] pb-[24px] pr-[12px] pl-[26px] h-[24px] text-center  text-bg-01  head-line-h5'>
							{item.title}
						</h4>
					</div>
				</div>
			))}
		</div>
	);
};

export default EventsImages;
