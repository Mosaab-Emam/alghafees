import React, { useEffect, useState } from "react";
import { ourAchievementsData } from "../../data/ourServicesData";
import CountUp from "react-countup";

const OurAchievementsBox = () => {
	const [isVisible, setIsVisible] = useState(false);

	useEffect(() => {
		// Create intersection observer
		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						setIsVisible(true);
					}
				});
			},
			{ threshold: 0.1 }
		);

		// Get the element to observe
		const element = document.getElementById("achievements-section");
		if (element) {
			observer.observe(element);
		}

		return () => {
			if (element) {
				observer.unobserve(element);
			}
		};
	}, []);

	return (
		<section
			id='achievements-section'
			className='lg:w-[810px] xl:w-[910px] w-[360px] flex md:flex-nowrap flex-wrap content-center md:justify-between justify-center items-center mx-auto md:mb-[81.5px]  mb-8'>
			{ourAchievementsData?.map((item, index) => (
				<div
					className='w-[178px]  flex flex-col items-center gap-6 flex-shrink-0'
					key={item?.id}>
					<div
						className={`${
							index === 0
								? " w-[126px]"
								: index === 1
								? "w-[65px] text-right"
								: " w-[121px] text-right"
						} flex flex-col items-center gap-4`}>
						<div className='mx-auto'> {item.icon}</div>
						<div className='h-[49px] w-[102px] self-stretch '>
							<h5
								className={`flex items-center ${
									index === 0 ? "justify-center" : "justify-start"
								} text-white text-center text-[42px] font-medium leading-[58.8px] capitalize`}>
								{index === 0 ? (
									<span>M</span>
								) : index === 2 ? (
									<span>K</span>
								) : null}
								<CountUp
									start={0}
									end={isVisible ? parseInt(item.number) : 0}
									duration={2.5}
									separator=','
								/>
								<span>+</span>
							</h5>
						</div>

						<p
							className={`h-[18px] self-stretch text-primary-200 text-center text-base front-medium leading-[25.6px]`}>
							{item.title}
						</p>
					</div>

					<div className='mb-[18.5px]'>
						<svg
							xmlns='http://www.w3.org/2000/svg'
							width='178'
							height='2'
							viewBox='0 0 178 2'
							fill='none'>
							<path d='M0 1L178 1.00002' stroke='#FEFFFF' />
						</svg>
					</div>
				</div>
			))}
		</section>
	);
};

export default OurAchievementsBox;
