import React, { useEffect } from "react";
import {
	PageTopSection,
	SalehNameEnglishShape,
	TrackRequestShape,
} from "../../components";

import TrackRequestForm from "./TrackRequestForm";

const TrackYourRequest = () => {
	useEffect(() => {
		window.scrollTo(0, 0);
	}, []);

	return (
		<>
			<PageTopSection title={"تتبع الطلب"} description={"تتبع مباشر"} />
			<section className='container md:mt-[211px] mt-[6rem] md:mb-[131px] mb-[6rem] relative'>
				<div className='inline-flex md:flex-row flex-col-reverse md:items-center md:content-start content-center items-start xl:gap-[144px] lg:gap-[60px] gap-8'>
					<TrackRequestForm />
					<TrackRequestShape />
				</div>

				<SalehNameEnglishShape
					position={
						"2xl:left-8 xl:-left-12 md:left-[-93px] left-[-120px]  md:top-0 top-[22rem] z-[1]"
					}
				/>
			</section>
		</>
	);
};

export default TrackYourRequest;
