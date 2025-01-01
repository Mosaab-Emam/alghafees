import React, { useEffect, useState } from "react";

const EventsSliderArrowsButtons = ({
	swiperRef,

	position,
}) => {
	const [isEnd, setIsEnd] = useState(false);
	const [isBeginning, setIsBeginning] = useState(true);

	useEffect(() => {
		const swiperInstance = swiperRef.current;

		if (swiperInstance) {
			swiperInstance.on("slideChange", () => {
				setIsEnd(swiperInstance.isEnd);
				setIsBeginning(swiperInstance.isBeginning);
			});

			// Initial state
			setIsEnd(swiperInstance.isEnd);
			setIsBeginning(swiperInstance.isBeginning);
		}

		return () => {
			if (swiperInstance) {
				swiperInstance.off("slideChange");
			}
		};
	}, [swiperRef]);

	return (
		<div className={`flex gap-8 absolute ${position} z-10`}>
			<button
				className={`group md:w-[50px] w-[48px] sm:h-[48px] lg:h-[46px] xl:h-[48px] flex items-center justify-center gap-[10px] rounded-bl-[8px] rounded-tr-[8px] events-next-btn next-button 
    ${
			isEnd
				? "bg-bg-01 border border-primary-600 hover:bg-primary-600 hover:border-primary-600"
				: "bg-primary-600 border border-primary-600 hover:bg-bg-01 hover:border-primary-600"
		} transition-colors duration-500 ease-in-out`}
				onClick={() => swiperRef.current?.slideNext()}>
				<svg
					xmlns='http://www.w3.org/2000/svg'
					width='30'
					height='30'
					viewBox='0 0 30 30'
					fill='none'>
					<path
						opacity='0.971'
						fillRule='evenodd'
						clipRule='evenodd'
						d='M18.3522 5.34014C18.7222 5.30403 19.0601 5.38851 19.3659 5.59356C22.2287 8.45629 25.0914 11.3191 27.9542 14.1818C28.2921 14.7074 28.2921 15.2331 27.9542 15.7587C25.0524 18.6793 22.1333 21.5796 19.197 24.4595C18.3345 24.8024 17.7244 24.549 17.3667 23.6993C17.2986 23.3396 17.3549 23.0017 17.5357 22.6856C19.6851 20.5361 21.8344 18.3868 23.9839 16.2373C16.9068 16.2186 9.82972 16.1998 2.75262 16.181C1.87678 15.922 1.56704 15.3495 1.8234 14.4634C2.00268 14.0591 2.31242 13.8244 2.75262 13.7594C9.82972 13.7407 16.9068 13.7219 23.9839 13.7031C21.8533 11.5725 19.7226 9.44183 17.592 7.31121C17.1432 6.37597 17.3967 5.71892 18.3522 5.34014Z'
						fill={isEnd ? "#0F819F" : "#FEFFFF"}
						className={`transition-colors duration-500 ease-in-out ${
							isEnd
								? "group-hover:fill-[#FEFFFF]"
								: "group-hover:fill-[#0F819F]"
						}`}
					/>
				</svg>
			</button>
			<button
				className={`group md:w-[50px] w-[48px] sm:h-[48px] lg:h-[46px] xl:h-[48px] flex items-center justify-center gap-[10px] rounded-bl-[8px] rounded-tr-[8px] events-prev-btn prev-button 
    ${
			isBeginning
				? "bg-bg-01 border border-primary-600 hover:bg-primary-600 hover:border-primary-600"
				: "bg-primary-600 border border-primary-600 hover:bg-bg-01 hover:border-primary-600"
		} transition-colors duration-500 ease-in-out`}
				onClick={() => swiperRef.current?.slidePrev()}>
				<svg
					xmlns='http://www.w3.org/2000/svg'
					width='30'
					height='30'
					viewBox='0 0 30 30'
					fill='none'>
					<path
						opacity='0.971'
						fillRule='evenodd'
						clipRule='evenodd'
						d='M11.6478 5.34014C11.2778 5.30403 10.9399 5.38851 10.6341 5.59356C7.77134 8.45629 4.90856 11.3191 2.04583 14.1818C1.70793 14.7074 1.70793 15.2331 2.04583 15.7587C4.94764 18.6793 7.86674 21.5796 10.803 24.4595C11.6655 24.8024 12.2756 24.549 12.6333 23.6993C12.7014 23.3396 12.6451 23.0017 12.4643 22.6856C10.3149 20.5361 8.16556 18.3868 6.01613 16.2373C13.0932 16.2186 20.1703 16.1998 27.2474 16.181C28.1232 15.922 28.433 15.3495 28.1766 14.4634C27.9973 14.0591 27.6876 13.8244 27.2474 13.7594C20.1703 13.7407 13.0932 13.7219 6.01613 13.7031C8.14675 11.5725 10.2774 9.44183 12.408 7.31121C12.8568 6.37597 12.6033 5.71892 11.6478 5.34014Z'
						fill={isBeginning ? "#0F819F" : "#FEFFFF"}
						className={`transition-colors duration-500 ease-in-out ${
							isBeginning
								? "group-hover:fill-[#FEFFFF]"
								: "group-hover:fill-[#0F819F]"
						}`}
					/>
				</svg>
			</button>
		</div>
	);
};

export default EventsSliderArrowsButtons;
