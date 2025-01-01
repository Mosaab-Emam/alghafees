import React from "react";

const ArrowsButtons = ({ swiperRef, isEnd, isBeginning, position }) => {
	return (
		<div className={`flex gap-8 absolute ${position} z-10`}>
			<button
				className='next-button'
				onClick={() => swiperRef.current?.slideNext()}>
				<svg
					xmlns='http://www.w3.org/2000/svg'
					width='46'
					height='16'
					viewBox='0 0 46 16'
					fill='none'>
					<path
						d='M1 7C0.447715 7 0 7.44772 0 8C0 8.55228 0.447715 9 1 9V7ZM45.7071 8.70711C46.0976 8.31658 46.0976 7.68342 45.7071 7.29289L39.3431 0.928932C38.9526 0.538408 38.3195 0.538408 37.9289 0.928932C37.5384 1.31946 37.5384 1.95262 37.9289 2.34315L43.5858 8L37.9289 13.6569C37.5384 14.0474 37.5384 14.6805 37.9289 15.0711C38.3195 15.4616 38.9526 15.4616 39.3431 15.0711L45.7071 8.70711ZM1 9H45V7H1V9Z'
						fill={isEnd ? "#808282" : "#3F9AB2"}
					/>
				</svg>
			</button>
			<button
				className='prev-button'
				onClick={() => swiperRef.current?.slidePrev()}>
				<svg
					xmlns='http://www.w3.org/2000/svg'
					width='46'
					height='16'
					viewBox='0 0 46 16'
					fill='none'>
					<path
						d='M45 7C45.5523 7 46 7.44772 46 8C46 8.55228 45.5523 9 45 9V7ZM0.292892 8.70711C-0.0976295 8.31658 -0.0976295 7.68342 0.292892 7.29289L6.65685 0.928932C7.04738 0.538408 7.68054 0.538408 8.07107 0.928932C8.46159 1.31946 8.46159 1.95262 8.07107 2.34315L2.41422 8L8.07107 13.6569C8.46159 14.0474 8.46159 14.6805 8.07107 15.0711C7.68054 15.4616 7.04738 15.4616 6.65685 15.0711L0.292892 8.70711ZM45 9H1V7H45V9Z'
						fill={isBeginning ? "#808282" : "#3F9AB2"}
					/>
				</svg>
			</button>
		</div>
	);
};

export default ArrowsButtons;
